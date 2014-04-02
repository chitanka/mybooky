<?php
namespace Application\Services;

use Laravel\Lang;
use Laravel\View;
use Laravel\Validator;

class ObjectManager {

	protected $model;
	protected $controller;

	public function __construct($model, $controller = null) {
		$this->model = $model;
		$this->controller = $controller ?: strtolower($this->model).'s';
	}

	public function controllerName() {
		return $this->controller;
	}

	public function findObject($id) {
		return $this->query()/*->with($this->withRelations)*/->find($id);
	}

	public function createObject($requestParams) {
		$validation = Validator::make($requestParams, $this->formFieldValidators());
		if ($validation->fails()) {
			throw new ValidationException($validation->errors);
		}
		$object = new $this->model;

		$relations = array();
		foreach ($this->fieldNames() as $field) {
			if (!array_key_exists($field, $requestParams)) {
				continue;
			}
			$value = $requestParams[$field];
			if (is_array($value)) {
				$relations[$field] = $value;
			} else {
				$object->$field = $value;
			}
		}
		if ($object->id) {
			// make an UPDATE, not an INSERT
			$object->exists = true;
		} else {
			// the ID, even if empty, causes the object to be inserted twice in the database
			unset($object->id);
		}
		// the relations can be saved only if the object has an ID
		$object->save();
		$object->fill($relations);
		$object->save();

		return $object;
	}

	public function updateObject($id, $requestParams) {
		$validation = Validator::make($requestParams, $this->formFieldValidators());
		if ($validation->fails()) {
			throw new ValidationException($validation->errors);
		}
		$object = $this->findObject($id);
		if ($object === null) {
			throw new NotFoundException();
		}

		foreach ($this->fieldNames() as $field) {
			if (array_key_exists($field, $requestParams)) {
				$object->$field = $requestParams[$field];
			}
		}
		$object->save();

		return $object;
	}

	public function deleteObject($id) {
		$object = $this->findObject($id);
		if ($object === null) {
			throw new NotFoundException();
		}
		$object->delete();

		return $object;
	}

	public function title($action, $args = array()) {
		return Lang::line("admin.{$this->controller}_title_{$action}", $args);
	}

	public function message($action, $args = array()) {
		return Lang::line("admin.{$this->controller}_message_{$action}", $args);
	}

	public function content($action, array $requestParams = array()) {
		$customView = "{$this->controller}.$action";
		$view = View::exists($customView) ? $customView : "crud.$action";
		return View::make($view)->with($this->view_params($action, $requestParams));
	}

	protected function query() {
		return new $this->model();
	}

	protected function formFields() {
		return $this->config('fields');
	}

	protected function fieldNames() {
		$names = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			$names[] = is_numeric($field) ? $fieldOptions : $field;
		}
		return $names;
	}

	protected function fieldsForIndex() {
		$names = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			if (is_numeric($field)) {
				$field = $fieldOptions;
				$fieldOptions = array();
			}
			if (!isset($fieldOptions['index'])) {
				$fieldOptions['index'] = true;
			}
			if (!isset($fieldOptions['view_link'])) {
				$fieldOptions['view_link'] = false;
			}
			$names[$field] = $fieldOptions;
		}
		return $names;
	}

	protected function fieldsForForm() {
		$options = array();
		$query = $this->query();
		foreach ($this->formFields() as $field => $fieldOptions) {
			if (is_numeric($field)) {
				$field = $fieldOptions;
				$fieldOptions = array();
			}
			if (method_exists($query, $field)) {
				$relation = $query->$field();
				switch (get_class($relation)) {
					case 'Laravel\Database\Eloquent\Relationships\Has_Many':
					case 'Laravel\Database\Eloquent\Relationships\Has_Many_And_Belongs_To':
					case 'Laravel\Database\Eloquent\Relationships\Belongs_To':
						$fieldOptions['type'] = 'select';
						$fieldOptions['multiple'] = strpos(get_class($relation), 'Has_Many') !== false;
						$choices = $relation->model->listsKeyValue();
						$fieldOptions['choices'] = ($fieldOptions['multiple'] ? array() : array('')) + $choices;
						break;
				}
			}
			if (!isset($fieldOptions['type'])) {
				$fieldOptions['type'] = 'text';
			}
			if (!isset($fieldOptions['label'])) {
				$fieldOptions['label'] = $field;
			}
			if (!isset($fieldOptions['name'])) {
				$fieldOptions['name'] = $field;
			}
			foreach (array('create', 'edit') as $action) {
				if (!isset($fieldOptions[$action])) {
					$fieldOptions[$action] = true;
				}
			}
			$options[$field] = $fieldOptions;
		}
		return $options;
	}

	protected function formFieldValidators() {
		$validators = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			if (isset($fieldOptions['validators'])) {
				$validators[$field] = array_map('trim', explode(',', $fieldOptions['validators']));
			}
		}
		return $validators;
	}

	protected function view_params($action, $requestParams) {
		switch ($action) {
			case 'index': return $this->view_params_index($requestParams);
			case 'create': return $this->view_params_create($requestParams);
			case 'edit': return $this->view_params_edit($requestParams['object'], $requestParams);
			case 'view': return $this->view_params_view($requestParams['object'], $requestParams);
		}
	}

	protected function view_params_index($requestParams = null) {
		$objects = $this->query()/*->with($this->withRelations)*/
			->ordered_query()->paginate($this->config('pagination'));
		// echo "<pre>"; print_r($objects);
		return array(
			'objects' => $objects->results,
			'fields' => $this->fieldsForIndex(),
			'key' => $this->controller,
			'pagination' => \MyBooky::BS3Pagination($objects->links()),
		);
	}

	public function view_params_create($requestParams = null) {
		return array(
			'fields' => $this->fieldsForForm(),
			'key' => $this->controller,
			'query' => $this->query(),
		);
	}

	public function view_params_edit($object, $requestParams = null) {
		return array(
			'object' => $object,
		) + $this->view_params_create($requestParams);
	}

	protected function view_params_view($object, $requestParams = null) {
		return array(
			'object' => $object,
			'key' => $this->controller,
			'fields' => $this->fieldNames(),
		);
	}

	protected function config($itemName = null) {
		$result = $this->fullConfig($this->model);
		if ($itemName == null)
		{
			return $result;
		}
		else
		{
			return $result[$itemName];
		}
	}

	private $fullConfig;
	protected function fullConfig($model = null) {
		if (!isset($this->fullConfig)) {
			$this->fullConfig = \Laravel\Config::file(null, 'crud');
		}
		return $model ? $this->fullConfig[$model] : $this->fullConfig;
	}

}
