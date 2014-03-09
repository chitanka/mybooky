<?php

class Sequences_Controller extends Base_Controller {

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
	 * View all of the sequences.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$sequences = Sequence::all();

		$this->layout->title   = 'Sequences';
		$this->layout->content = View::make('sequences.index')->with('sequences', $sequences);
	}

	/**
	 * Show the form to create a new sequence.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Sequence';
		$this->layout->content = View::make('sequences.create');
	}

	/**
	 * Create a new sequence.
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
			$sequence = new Sequence;

			$sequence->name = Input::get('name');

			$sequence->save();

			Session::flash('message', 'Added sequence #'.$sequence->id);

			return Redirect::to('sequences');
		}

		else
		{
			return Redirect::to('sequences/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific sequence.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$sequence = Sequence::find($id);

		if(is_null($sequence))
		{
			return Redirect::to('sequences');
		}

		$this->layout->title   = 'Viewing Sequence #'.$id;
		$this->layout->content = View::make('sequences.view')->with('sequence', $sequence);
	}

	/**
	 * Show the form to edit a specific sequence.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$sequence = Sequence::find($id);

		if(is_null($sequence))
		{
			return Redirect::to('sequences');
		}

		$this->layout->title   = 'Editing Sequence';
		$this->layout->content = View::make('sequences.edit')->with('sequence', $sequence);
	}

	/**
	 * Edit a specific sequence.
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
			$sequence = Sequence::find($id);

			if(is_null($sequence))
			{
				return Redirect::to('sequences');
			}

			$sequence->name = Input::get('name');

			$sequence->save();

			Session::flash('message', 'Updated sequence #'.$sequence->id);

			return Redirect::to('sequences');
		}

		else
		{
			return Redirect::to('sequences/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific sequence.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$sequence = Sequence::find($id);

		if( ! is_null($sequence))
		{
			$sequence->delete();

			Session::flash('message', 'Deleted sequence #'.$sequence->id);
		}

		return Redirect::to('sequences');
	}
}