<?php

class Compilers_Controller extends Base_Controller {

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
	 * View all of the compilers.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$compilers = Compiler::all();

		$this->layout->title   = 'Compilers';
		$this->layout->content = View::make('compilers.index')->with('compilers', $compilers);
	}

	/**
	 * Show the form to create a new compiler.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Compiler';
		$this->layout->content = View::make('compilers.create');
	}

	/**
	 * Create a new compiler.
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
			$compiler = new Compiler;

			$compiler->name = Input::get('name');
			$compiler->nickname = Input::get('nickname');
			$compiler->note = Input::get('note');

			$compiler->save();

			Session::flash('message', 'Added compiler #'.$compiler->id);

			return Redirect::to('compilers');
		}

		else
		{
			return Redirect::to('compilers/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific compiler.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$compiler = Compiler::find($id);

		if(is_null($compiler))
		{
			return Redirect::to('compilers');
		}

		$this->layout->title   = 'Viewing Compiler #'.$id;
		$this->layout->content = View::make('compilers.view')->with('compiler', $compiler);
	}

	/**
	 * Show the form to edit a specific compiler.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$compiler = Compiler::find($id);

		if(is_null($compiler))
		{
			return Redirect::to('compilers');
		}

		$this->layout->title   = 'Editing Compiler';
		$this->layout->content = View::make('compilers.edit')->with('compiler', $compiler);
	}

	/**
	 * Edit a specific compiler.
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
			$compiler = Compiler::find($id);

			if(is_null($compiler))
			{
				return Redirect::to('compilers');
			}

			$compiler->name = Input::get('name');
			$compiler->nickname = Input::get('nickname');
			$compiler->note = Input::get('note');

			$compiler->save();

			Session::flash('message', 'Updated compiler #'.$compiler->id);

			return Redirect::to('compilers');
		}

		else
		{
			return Redirect::to('compilers/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific compiler.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$compiler = Compiler::find($id);

		if( ! is_null($compiler))
		{
			$compiler->delete();

			Session::flash('message', 'Deleted compiler #'.$compiler->id);
		}

		return Redirect::to('compilers');
	}
}