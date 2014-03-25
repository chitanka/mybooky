<?php
namespace Application\Services;

use Laravel\Lang;
use Laravel\View;

class CrudGenerator {

	protected $model;
	protected $controller;

	public function __construct($model, $controller = null) {
		$this->model = $model;
		$this->controller = $controller ?: $this->model.'s';
	}

	public function controllerName() {
		return $this->controller;
	}

	public function query() {
		return new $this->model();
	}

	public function findObject($id) {
		return $this->query()/*->with($this->withRelations)*/->find($id);
	}

	public function formFields() {
		return $this->config()['fields'];
	}

	public function fieldNames() {
		$names = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			$names[] = is_numeric($field) ? $fieldOptions : $field;
		}
		return $names;
	}

	public function fieldsForIndex() {
		$names = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			if (is_numeric($field)) {
				$field = $fieldOptions;
				$fieldOptions = array();
			}
			if (!isset($fieldOptions['index'])) {
				$fieldOptions['index'] = true;
			}
			$names[$field] = $fieldOptions;
		}
		return $names;
	}

	public function fieldsForForm() {
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
			foreach (array('create', 'edit') as $action) {
				if (!isset($fieldOptions[$action])) {
					$fieldOptions[$action] = true;
				}
			}
			$options[$field] = $fieldOptions;
		}
		return $options;
	}

	public function formFieldValidators() {
		$validators = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			if (isset($fieldOptions['validators'])) {
				$validators[$field] = array_map('trim', explode(',', $fieldOptions['validators']));
			}
		}
		return $validators;
	}

	public function title($action, $args = array()) {
		return Lang::line("admin.{$this->controller}_title_{$action}", $args);
	}

	public function message($action, $args = array()) {
		return Lang::line("admin.{$this->controller}_message_{$action}", $args);
	}

	public function content($action, array $requestArgs = array()) {
		$customView = "{$this->controller}.$action";
		$view = View::exists($customView) ? $customView : "crud.$action";
		return View::make($view)->with($this->view_params($action, $requestArgs));
	}

	public function view_params($action, $requestArgs) {
		switch ($action) {
			case 'index': return $this->view_params_index($requestArgs);
			case 'create': return $this->view_params_create($requestArgs);
			case 'edit': return $this->view_params_edit($requestArgs);
			case 'view': return $this->view_params_view($requestArgs);
		}
	}

	public function view_params_index($requestArgs) {
		$objects = $this->query()/*->with($this->withRelations)*/
			->ordered_query()->paginate($this->config()['pagination']);
		return array(
			'objects' => $objects->results,
			'fields' => $this->fieldsForIndex(),
			'key' => $this->controller,
			'pagination' => \MyBooky::BS3Pagination($objects->links()),
		);
	}

	public function view_params_create($requestArgs) {
		return array(
			'fields' => $this->fieldsForForm(),
			'key' => $this->controller,
			'query' => $this->query(),
		);
	}

	public function view_params_edit($requestArgs) {
		return array(
			'object' => $requestArgs['object'],
		) + $this->view_params_create($requestArgs);
	}

	public function view_params_view($requestArgs) {
		return array(
			'object' => $requestArgs['object'],
			'key' => $this->controller,
			'fields' => $this->fieldNames(),
		);
	}

	public function config() {
		return $this->fullConfig($this->model);
	}

	private $fullConfig;
	protected function fullConfig($model = null) {
		if (!isset($this->fullConfig)) {
			$this->fullConfig = \Laravel\Config::file(null, 'crud');
		}
		return $model ? $this->fullConfig[$model] : $this->fullConfig;
	}

}
