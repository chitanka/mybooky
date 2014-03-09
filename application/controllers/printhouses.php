<?php

class Printhouses_Controller extends Base_Controller {

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
	 * View all of the printhouses.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$printhouses = Printhouse::all();

		$this->layout->title   = 'Printhouses';
		$this->layout->content = View::make('printhouses.index')->with('printhouses', $printhouses);
	}

	/**
	 * Show the form to create a new printhouse.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Printhouse';
		$this->layout->content = View::make('printhouses.create');
	}

	/**
	 * Create a new printhouse.
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
			$printhouse = new Printhouse;

			$printhouse->name = Input::get('name');

			$printhouse->save();

			Session::flash('message', 'Added printhouse #'.$printhouse->id);

			return Redirect::to('printhouses');
		}

		else
		{
			return Redirect::to('printhouses/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific printhouse.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$printhouse = Printhouse::find($id);

		if(is_null($printhouse))
		{
			return Redirect::to('printhouses');
		}

		$this->layout->title   = 'Viewing Printhouse #'.$id;
		$this->layout->content = View::make('printhouses.view')->with('printhouse', $printhouse);
	}

	/**
	 * Show the form to edit a specific printhouse.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$printhouse = Printhouse::find($id);

		if(is_null($printhouse))
		{
			return Redirect::to('printhouses');
		}

		$this->layout->title   = 'Editing Printhouse';
		$this->layout->content = View::make('printhouses.edit')->with('printhouse', $printhouse);
	}

	/**
	 * Edit a specific printhouse.
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
			$printhouse = Printhouse::find($id);

			if(is_null($printhouse))
			{
				return Redirect::to('printhouses');
			}

			$printhouse->name = Input::get('name');

			$printhouse->save();

			Session::flash('message', 'Updated printhouse #'.$printhouse->id);

			return Redirect::to('printhouses');
		}

		else
		{
			return Redirect::to('printhouses/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific printhouse.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$printhouse = Printhouse::find($id);

		if( ! is_null($printhouse))
		{
			$printhouse->delete();

			Session::flash('message', 'Deleted printhouse #'.$printhouse->id);
		}

		return Redirect::to('printhouses');
	}
}