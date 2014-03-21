<?php

class Crud_Controller extends Base_Controller {

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.admin';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/** Override in children controllers */
	protected $formFields = array();
	/** Override in children controllers */
	protected $relations = array();

	/**
	 * View all objects.
	 */
	public function get_index() {
		$controllerName = $this->controllerName();
		$this->layout->title = Lang::line("admin.{$controllerName}_title_index");
		$customView = "$controllerName.index";
		$view = View::exists($customView) ? $customView : 'crud.index';
		$this->layout->content = View::make($view)->with($this->view_params_index());
	}

	/**
	 * Show the form to create a new object.
	 */
	public function get_create() {
		$controllerName = $this->controllerName();
		$this->layout->title = Lang::line("admin.{$controllerName}_title_create");
		$params = call_user_func_array(array($this, 'view_params_create'), func_get_args());
		$customView = "$controllerName.create";
		$view = View::exists($customView) ? $customView : 'crud.create';
		$this->layout->content = View::make($view)->with($params);
	}

	/**
	 * Create a new object.
	 *
	 * @return Response
	 */
	public function post_create() {
		$validation = Validator::make(Input::all(), $this->formFieldValidators());

		$controllerName = $this->controllerName();
		if ($validation->fails()) {
			return Redirect::to("$controllerName/create")
				->with_errors($validation->errors)
				->with_input();
		}
		$object = new $this->model;

		$relations = array();
		foreach ($this->formFieldNames() as $field) {
			$value = Input::get($field);
			if (is_array($value)) {
				$relations[$field] = $value;
			} else {
				$object->$field = $value;
			}
		}
		$object->save();
		$object->fill($relations);
		$object->save();

		Session::flash('message', Lang::line("admin.{$controllerName}_message_created", array('name' => $object)));

		return Redirect::to($controllerName);
	}

	/**
	 * View a specific object.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id) {
		$object = $this->query()->with($this->withRelations)->find($id);

		$controllerName = $this->controllerName();
		if ($object === null) {
			return Redirect::to($controllerName);
		}

		$this->layout->title = Lang::line("admin.{$controllerName}_title_view", array('name' => $object));
		$customView = "$controllerName.view";
		$view = View::exists($customView) ? $customView : 'crud.view';
		$this->layout->content = View::make($view)->with(array(
			'object' => $object,
			'key' => $this->controllerName(),
			'fields' => $this->formFieldNames(),
		));
	}

	/**
	 * Show the form to edit a specific object.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id) {
		$object = $this->query()->find($id);

		$controllerName = $this->controllerName();
		if ($object === null) {
			return Redirect::to($controllerName);
		}
		$this->layout->title = Lang::line("admin.{$controllerName}_title_edit", array('name' => $object));
		$customView = "$controllerName.edit";
		$view = View::exists($customView) ? $customView : 'crud.edit';
		$this->layout->content = View::make($view)->with(array(
			'object' => $object,
		) + $this->view_params_edit());
	}

	/**
	 * Edit a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id) {
		$validation = Validator::make(Input::all(), $this->formFieldValidators());

		$controllerName = $this->controllerName();
		if ($validation->fails()) {
			return Redirect::to("$controllerName/edit/$id")
				->with_errors($validation->errors)
				->with_input();
		}
		$object = $this->query()->find($id);

		if ($object === null) {
			return Redirect::to($controllerName);
		}

		foreach ($this->formFieldNames() as $field) {
			$object->$field = Input::get($field);
		}
		$object->save();

		Session::flash('message', Lang::line("admin.{$controllerName}_message_edited", array('name' => $object)));

		return Redirect::to($controllerName);
	}

	/**
	 * Delete a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id) {
		$object = $this->query()->find($id);

		$controllerName = $this->controllerName();
		if ($object !== null) {
			$object->delete();

			Session::flash('message', Lang::line("admin.{$controllerName}_message_deleted", array('name' => $object)));
		}
		return Redirect::to($controllerName);
	}

	protected function query_index() {
		throw new Exception(sprintf("Override method %s in %s", __FUNCTION__, get_class($this)));
	}

	protected function query() {
		return new $this->model();
	}

	protected function view_params_index() {
		$objects = $this->query()->with($this->withRelations)->get();
		return array(
			'objects' => $objects,
			'fields' => $this->formFieldNames(),
			'key' => $this->controllerName(),
		);
	}

	protected function view_params_create() {
		return array(
			'fields' => $this->formFieldOptions(),
			'key' => $this->controllerName(),
			'query' => $this->query(),
		);
	}

	protected function view_params_edit() {
		return $this->view_params_create();
	}

	protected function formFields() {
		return $this->formFields;
	}

	protected function formFieldNames() {
		$names = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			$names[] = is_numeric($field) ? $fieldOptions : $field;
		}
		return $names;
	}

	protected function formFieldOptions() {
		$options = array();
		$query = $this->query();
		foreach ($this->formFields() as $field => $fieldOptions) {
			if (is_numeric($field)) {
				$field = $fieldOptions;
				$fieldOptions = array();
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
			$options[$field] = $fieldOptions;
		}
		return $options;
	}

	protected function formFieldValidators() {
		$validators = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			$rawValidators = isset($fieldOptions['validators']) ? $fieldOptions['validators'] : $fieldOptions[0];
			$validators[$field] = array_map('trim', explode(',', $rawValidators));
		}
		return $validators;
	}

	protected function relations() {
		return $this->relations;
	}

	protected function controllerName() {
		list($controllerName) = explode('_', strtolower(get_class($this)));
		return $controllerName;
	}
}
