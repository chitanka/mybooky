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

	protected $formFields = array();
	protected $relations = array();

	/**
	 * View all objects.
	 */
	public function get_index() {
		$controllerName = $this->controllerName();
		$this->layout->title = Lang::line("admin.title_{$controllerName}_index");
		$customView = "$controllerName.index";
		$view = View::exists($customView) ? $customView : 'crud.index';
		$this->layout->content = View::make($view)->with($this->view_params_index());
	}

	protected function view_params_index() {
		$objects = $this->query()->with($this->withRelations)->get();
		return array(
			'objects' => $objects,
			$this->plural => $objects, // just a backup till everything is converted to base CRUD
			'fields' => $this->formFieldNames(),
			'key' => $this->controllerName(),
		);
	}

	protected function query_index() {
		throw new Exception(sprintf("Override method %s in %s", __FUNCTION__, get_class($this)));
	}

	/**
	 * Show the form to create a new object.
	 */
	public function get_create() {
		$controllerName = $this->controllerName();
		$this->layout->title = Lang::line("admin.title_{$controllerName}_create");
		$params = call_user_func_array(array($this, 'view_params_create'), func_get_args());
		$customView = "$controllerName.create";
		$view = View::exists($customView) ? $customView : 'crud.create';
		$this->layout->content = View::make($view)->with($params);
	}

	protected function query() {
		return new $this->model();
	}

	protected function view_params_create() {
		return array(
			'fields' => $this->formFieldNames(),
			'key' => $this->controllerName(),
		);
	}

	protected function formFields() {
		return $this->formFields;
	}

	protected function formFieldNames() {
		return array_keys($this->formFields());
	}

	protected function formFieldValidators() {
		$validators = array();
		foreach ($this->formFields() as $field => $fieldOptions) {
			$validators[$field] = array_map('trim', explode(',', $fieldOptions[0]));
		}
		return $validators;
	}

	protected function relations() {
		return $this->relations;
	}

	/**
	 * Create a new object.
	 *
	 * @return Response
	 */
	public function post_create() {
		$validation = Validator::make(Input::all(), $this->formFieldValidators());

		$controllerName = $this->controllerName();
		if ($validation->valid()) {
			$object = new $this->model;

			foreach ($this->formFieldNames() as $field) {
				$object->$field = Input::get($field);
			}
			$object->save();
			foreach ($this->relations() as $relation) {
				$object->$relation()->sync(Input::get($relation));
			}
			$object->save();

			Session::flash('message', Lang::line("admin.message_{$controllerName}_created", array('name' => $object)));

			return Redirect::to($controllerName);
		}

		return Redirect::to("$controllerName/create")
			->with_errors($validation->errors)
			->with_input();
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

		$this->layout->title = Lang::line("admin.title_{$controllerName}_view", array('name' => $object));
		$customView = "$controllerName.view";
		$view = View::exists($customView) ? $customView : 'crud.view';
		$this->layout->content = View::make($view)->with(array(
			$this->single => $object
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

		$this->layout->title = Lang::line("admin.title_{$controllerName}_edit", array('name' => $object));
		$this->layout->content = View::make("$controllerName.edit")->with(array(
			$this->single => $object,
		) + $this->view_params_create());
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
		if ($validation->valid()) {
			$object = $this->query()->find($id);

			if ($object === null) {
				return Redirect::to($controllerName);
			}

			foreach ($this->formFieldNames() as $field) {
				$object->$field = Input::get($field);
			}
			foreach ($this->relations() as $relation) {
				$object->$relation()->sync(Input::get($relation));
			}
			$object->save();

			Session::flash('message', Lang::line("admin.message_{$controllerName}_edited", array('name' => $object)));

			return Redirect::to($controllerName);
		}

		return Redirect::to("$controllerName/edit/$id")
			->with_errors($validation->errors)
			->with_input();
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

			Session::flash('message', Lang::line("admin.message_{$controllerName}_deleted", array('name' => $object)));
		}

		return Redirect::to($controllerName);
	}

	protected function controllerName() {
		list($controllerName) = explode('_', strtolower(get_class($this)));
		return $controllerName;
	}
}
