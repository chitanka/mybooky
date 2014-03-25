<?php

use Laravel\Redirect;
use Laravel\Session;
use Application\Services\CrudGenerator;
use Application\Services\ValidationException;
use Application\Services\NotFoundException;

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
		try {
			$object = $generator->createObject(Input::all());
		} catch (ValidationException $ex) {
			return $this->redirectToInvalidForm("{$generator->controllerName()}/create", $ex->getErrors());
		}
		$this->setFlashMessage($generator->message('created', array('name' => $object)));

		return $this->redirectToIndex();
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
			return $this->redirectToIndex();
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
			return $this->redirectToIndex();
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
		try {
			$object = $generator->updateObject($id, Input::all());
		} catch (ValidationException $ex) {
			return $this->redirectToInvalidForm("{$generator->controllerName()}/edit/$id", $ex->getErrors());
		} catch (NotFoundException $ex) {
			return $this->redirectToIndex();
		}
		$this->setFlashMessage($generator->message('edited', array('name' => $object)));

		return $this->redirectToIndex();
	}

	/**
	 * Delete a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id) {
		$generator = $this->generator();
		try {
			$object = $generator->deleteObject($id);
		} catch (NotFoundException $ex) {
			return $this->redirectToIndex();
		}
		$this->setFlashMessage($generator->message('deleted', array('name' => $object)));

		return $this->redirectToIndex();
	}

	protected function redirectToInvalidForm($route, $errors) {
		return Redirect::to($route)->with_errors($errors)->with_input();
	}

	protected function redirectToIndex() {
		return Redirect::to($this->generator()->controllerName());
	}

	protected function setFlashMessage($message) {
		Session::flash('message', $message);
	}

	private $generator;
	/** @return CrudGenerator */
	protected function generator() {
		return $this->generator ?: $this->generator = $this->newGenerator($this->model, $this->controllerName());
	}

	protected function newGenerator($model, $controller) {
		return new CrudGenerator($model, $controller);
	}

	protected function controllerName() {
		list($controllerName) = explode('_', strtolower(get_class($this)));
		return $controllerName;
	}

}
