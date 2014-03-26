<?php

use Laravel\Redirect;
use Laravel\Session;
use Application\Services\ObjectManager;
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
		$manager = $this->manager();
		$this->layout->title = $manager->title('index');
		$this->layout->content = $manager->content('index');
	}

	/**
	 * Show the form to create a new object.
	 */
	public function get_create() {
		$manager = $this->manager();
		$this->layout->title = $manager->title('create');
		$this->layout->content = $manager->content('create', func_get_args());
	}

	/**
	 * Create a new object.
	 *
	 * @return Response
	 */
	public function post_create() {
		$manager = $this->manager();
		try {
			$object = $manager->createObject(Input::all());
		} catch (ValidationException $ex) {
			return $this->redirectToInvalidForm("{$manager->controllerName()}/create", $ex->getErrors());
		}
		$this->setFlashMessage($manager->message('created', array('name' => $object)));

		return $this->redirectToIndex();
	}

	/**
	 * View a specific object.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id) {
		$manager = $this->manager();
		$object = $manager->findObject($id);
		if ($object === null) {
			return $this->redirectToIndex();
		}
		$this->layout->title = $manager->title('view', array('name' => $object));
		$this->layout->content = $manager->content('view', array('object' => $object));
	}

	/**
	 * Show the form to edit a specific object.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id) {
		$manager = $this->manager();
		$object = $manager->findObject($id);
		if ($object === null) {
			return $this->redirectToIndex();
		}
		$this->layout->title = $manager->title('edit', array('name' => $object));
		$this->layout->content = $manager->content('edit', array('object' => $object));
	}

	/**
	 * Edit a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id) {
		$manager = $this->manager();
		try {
			$object = $manager->updateObject($id, Input::all());
		} catch (ValidationException $ex) {
			return $this->redirectToInvalidForm("{$manager->controllerName()}/edit/$id", $ex->getErrors());
		} catch (NotFoundException $ex) {
			return $this->redirectToIndex();
		}
		$this->setFlashMessage($manager->message('edited', array('name' => $object)));

		return $this->redirectToIndex();
	}

	/**
	 * Delete a specific object.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id) {
		$manager = $this->manager();
		try {
			$object = $manager->deleteObject($id);
		} catch (NotFoundException $ex) {
			return $this->redirectToIndex();
		}
		$this->setFlashMessage($manager->message('deleted', array('name' => $object)));

		return $this->redirectToIndex();
	}

	protected function redirectToInvalidForm($route, $errors) {
		return Redirect::to($route)->with_errors($errors)->with_input();
	}

	protected function redirectToIndex() {
		return Redirect::to($this->manager()->controllerName());
	}

	protected function setFlashMessage($message) {
		Session::flash('message', $message);
	}

	private $manager;
	/** @return ObjectManager */
	protected function manager() {
		return $this->manager ?: $this->manager = $this->newManager();
	}

	protected function newManager() {
		return new ObjectManager($this->model, $this->controllerName());
	}

	protected function controllerName() {
		list($controllerName) = explode('_', strtolower(get_class($this)));
		return $controllerName;
	}

}
