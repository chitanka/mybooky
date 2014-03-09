<?php

class Authors_Controller extends Base_Controller {

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
	 * View all of the authors.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$authors = Author::all();

		$this->layout->title   = 'Authors';
		$this->layout->content = View::make('authors.index')->with('authors', $authors);
	}

	/**
	 * Show the form to create a new author.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Author';
		$this->layout->content = View::make('authors.create');
	}

	/**
	 * Create a new author.
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
			$author = new Author;

			$author->name = Input::get('name');
			$author->nickname = Input::get('nickname');
			$author->note = Input::get('note');

			$author->save();

			Session::flash('message', 'Added author #'.$author->id);

			return Redirect::to('authors');
		}

		else
		{
			return Redirect::to('authors/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific author.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$author = Author::find($id);

		if(is_null($author))
		{
			return Redirect::to('authors');
		}

		$this->layout->title   = 'Viewing Author #'.$id;
		$this->layout->content = View::make('authors.view')->with('author', $author);
	}

	/**
	 * Show the form to edit a specific author.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$author = Author::find($id);

		if(is_null($author))
		{
			return Redirect::to('authors');
		}

		$this->layout->title   = 'Editing Author';
		$this->layout->content = View::make('authors.edit')->with('author', $author);
	}

	/**
	 * Edit a specific author.
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
			$author = Author::find($id);

			if(is_null($author))
			{
				return Redirect::to('authors');
			}

			$author->name = Input::get('name');
			$author->nickname = Input::get('nickname');
			$author->note = Input::get('note');

			$author->save();

			Session::flash('message', 'Updated author #'.$author->id);

			return Redirect::to('authors');
		}

		else
		{
			return Redirect::to('authors/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific author.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$author = Author::find($id);

		if( ! is_null($author))
		{
			$author->delete();

			Session::flash('message', 'Deleted author #'.$author->id);
		}

		return Redirect::to('authors');
	}
}