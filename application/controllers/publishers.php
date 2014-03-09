<?php

class Publishers_Controller extends Base_Controller {

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.scaffold';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * View all of the publishers.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$publishers = Publisher::all();

		$this->layout->title   = 'Publishers';
		$this->layout->content = View::make('publishers.index')->with('publishers', $publishers);
	}

	/**
	 * Show the form to create a new publisher.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Publisher';
		$this->layout->content = View::make('publishers.create');
	}

	/**
	 * Create a new publisher.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:100'),
		));

		if($validation->valid())
		{
			$publisher = new Publisher;

			$publisher->name = Input::get('name');

			$publisher->save();

			Session::flash('message', 'Added publisher #'.$publisher->id);

			return Redirect::to('publishers');
		}

		else
		{
			return Redirect::to('publishers/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific publisher.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$publisher = Publisher::find($id);

		if(is_null($publisher))
		{
			return Redirect::to('publishers');
		}

		$this->layout->title   = 'Viewing Publisher #'.$id;
		$this->layout->content = View::make('publishers.view')->with('publisher', $publisher);
	}

	/**
	 * Show the form to edit a specific publisher.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$publisher = Publisher::find($id);

		if(is_null($publisher))
		{
			return Redirect::to('publishers');
		}

		$this->layout->title   = 'Editing Publisher';
		$this->layout->content = View::make('publishers.edit')->with('publisher', $publisher);
	}

	/**
	 * Edit a specific publisher.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:100'),
		));

		if($validation->valid())
		{
			$publisher = Publisher::find($id);

			if(is_null($publisher))
			{
				return Redirect::to('publishers');
			}

			$publisher->name = Input::get('name');

			$publisher->save();

			Session::flash('message', 'Updated publisher #'.$publisher->id);

			return Redirect::to('publishers');
		}

		else
		{
			return Redirect::to('publishers/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific publisher.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$publisher = Publisher::find($id);

		if( ! is_null($publisher))
		{
			$publisher->delete();

			Session::flash('message', 'Deleted publisher #'.$publisher->id);
		}

		return Redirect::to('publishers');
	}
}