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
	protected $model = 'Model';

	/**
	 * View all objects.
	 */
	public function get_index() {
		$generator = $this->generator();
		$this->layout->title = $generator->title('index');
		$this->layout->content = $generator->content('index');
	}

	/**
	 * Show the form to create a new object.
	 */
	public function get_create() {
		$generator = $this->generator();
		$this->layout->title = $generator->title('create');
		$this->layout->content = $generator->content('create', func_get_args());
	}

	/**
	 * Create a new object.
	 *
	 * @return Response
	 */
	public function post_create() {
		$generator = $this->generator();
		$validation = Validator::make(Input::all(), $generator->formFieldValidators());
		if ($validation->fails()) {
			return $this->redirectToInvalidForm("{$generator->controllerName()}/create", $validation);
		}
		$object = new $this->model;

		$relations = array();
		foreach ($generator->fieldNames() as $field) {
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

		Session::flash('message', $generator->message('created', array('name' => $object)));

		return Redirect::to($generator->controllerName());
	}

	/**
	 * View a specific object.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id) {
		$generator = $this->generator();

		$object = $generator->findObject($id);
		if ($object === null) {
			return Redirect::to($generator->controllerName());
		}
		$this->layout->title = $generator->title('view', array('name' => $object));
		$this->layout->content = $generator->content('view', array('object' => $object));
	}

	/**
	 * Show the form to edit a specific object.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id) {
		$generator = $this->generator();

		$object = $generator->findObject($id);
		if ($object === null) {
			return Redirect::to($generator->controllerName());
		}
		$this->layout->title = $generator->title('edit', array('name' => $object));
		$this->layout->content = $generator->content('edit', array('object' => $object));
	}

	/**
	 * Edit a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id) {
		$generator = $this->generator();

		$validation = Validator::make(Input::all(), $generator->formFieldValidators());
		if ($validation->fails()) {
			return $this->redirectToInvalidForm("{$generator->controllerName()}/edit/$id", $validation);
		}
		$object = $generator->findObject($id);
		if ($object === null) {
			return Redirect::to($generator->controllerName());
		}

		foreach ($generator->fieldNames() as $field) {
			$object->$field = Input::get($field);
		}
		$object->save();

		Session::flash('message', $generator->message('edited', array('name' => $object)));

		return Redirect::to($generator->controllerName());
	}

	/**
	 * Delete a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id) {
		$generator = $this->generator();

		$object = $generator->findObject($id);
		if ($object !== null) {
			$object->delete();
			Session::flash('message', $generator->message('deleted', array('name' => $object)));
		}
		return Redirect::to($generator->controllerName());
	}

	protected function redirectToInvalidForm($route, $validation) {
		return Redirect::to($route)
			->with_errors($validation->errors)
			->with_input();
	}

	private $generator;
	/** @return Application\Services\CrudGenerator */
	protected function generator() {
		return $this->generator ?: $this->generator = $this->newGenerator($this->model, $this->controllerName());
	}

	protected function newGenerator($model, $controller) {
		return new Application\Services\CrudGenerator($model, $controller);
	}

	protected function controllerName() {
		list($controllerName) = explode('_', strtolower(get_class($this)));
		return $controllerName;
	}

}
