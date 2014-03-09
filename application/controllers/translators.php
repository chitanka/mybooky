<?php

class Translators_Controller extends Base_Controller {

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
	 * View all of the translators.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$translators = Translator::all();

		$this->layout->title   = 'Translators';
		$this->layout->content = View::make('translators.index')->with('translators', $translators);
	}

	/**
	 * Show the form to create a new translator.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Translator';
		$this->layout->content = View::make('translators.create');
	}

	/**
	 * Create a new translator.
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
			$translator = new Translator;

			$translator->name = Input::get('name');
			$translator->nickname = Input::get('nickname');
			$translator->note = Input::get('note');

			$translator->save();

			Session::flash('message', 'Added translator #'.$translator->id);

			return Redirect::to('translators');
		}

		else
		{
			return Redirect::to('translators/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific translator.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$translator = Translator::find($id);

		if(is_null($translator))
		{
			return Redirect::to('translators');
		}

		$this->layout->title   = 'Viewing Translator #'.$id;
		$this->layout->content = View::make('translators.view')->with('translator', $translator);
	}

	/**
	 * Show the form to edit a specific translator.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$translator = Translator::find($id);

		if(is_null($translator))
		{
			return Redirect::to('translators');
		}

		$this->layout->title   = 'Editing Translator';
		$this->layout->content = View::make('translators.edit')->with('translator', $translator);
	}

	/**
	 * Edit a specific translator.
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
			$translator = Translator::find($id);

			if(is_null($translator))
			{
				return Redirect::to('translators');
			}

			$translator->name = Input::get('name');
			$translator->nickname = Input::get('nickname');
			$translator->note = Input::get('note');

			$translator->save();

			Session::flash('message', 'Updated translator #'.$translator->id);

			return Redirect::to('translators');
		}

		else
		{
			return Redirect::to('translators/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific translator.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$translator = Translator::find($id);

		if( ! is_null($translator))
		{
			$translator->delete();

			Session::flash('message', 'Deleted translator #'.$translator->id);
		}

		return Redirect::to('translators');
	}
}