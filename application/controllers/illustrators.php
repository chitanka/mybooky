<?php

class Illustrators_Controller extends Base_Controller {

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
	 * View all of the illustrators.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$illustrators = Illustrator::all();

		$this->layout->title   = 'Illustrators';
		$this->layout->content = View::make('illustrators.index')->with('illustrators', $illustrators);
	}

	/**
	 * Show the form to create a new illustrator.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Illustrator';
		$this->layout->content = View::make('illustrators.create');
	}

	/**
	 * Create a new illustrator.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:100'),
			'nickname' => array('required', 'max:50'),
			'note' => array('required', 'max:200'),
		));

		if($validation->valid())
		{
			$illustrator = new Illustrator;

			$illustrator->name = Input::get('name');
			$illustrator->nickname = Input::get('nickname');
			$illustrator->note = Input::get('note');

			$illustrator->save();

			Session::flash('message', 'Added illustrator #'.$illustrator->id);

			return Redirect::to('illustrators');
		}

		else
		{
			return Redirect::to('illustrators/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific illustrator.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$illustrator = Illustrator::find($id);

		if(is_null($illustrator))
		{
			return Redirect::to('illustrators');
		}

		$this->layout->title   = 'Viewing Illustrator #'.$id;
		$this->layout->content = View::make('illustrators.view')->with('illustrator', $illustrator);
	}

	/**
	 * Show the form to edit a specific illustrator.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$illustrator = Illustrator::find($id);

		if(is_null($illustrator))
		{
			return Redirect::to('illustrators');
		}

		$this->layout->title   = 'Editing Illustrator';
		$this->layout->content = View::make('illustrators.edit')->with('illustrator', $illustrator);
	}

	/**
	 * Edit a specific illustrator.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:100'),
			'nickname' => array('required', 'max:50'),
			'note' => array('required', 'max:200'),
		));

		if($validation->valid())
		{
			$illustrator = Illustrator::find($id);

			if(is_null($illustrator))
			{
				return Redirect::to('illustrators');
			}

			$illustrator->name = Input::get('name');
			$illustrator->nickname = Input::get('nickname');
			$illustrator->note = Input::get('note');

			$illustrator->save();

			Session::flash('message', 'Updated illustrator #'.$illustrator->id);

			return Redirect::to('illustrators');
		}

		else
		{
			return Redirect::to('illustrators/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific illustrator.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$illustrator = Illustrator::find($id);

		if( ! is_null($illustrator))
		{
			$illustrator->delete();

			Session::flash('message', 'Deleted illustrator #'.$illustrator->id);
		}

		return Redirect::to('illustrators');
	}
}