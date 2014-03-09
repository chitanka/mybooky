<?php

class Languages_Controller extends Base_Controller {

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
	 * View all of the languages.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$languages = Language::all();

		$this->layout->title   = 'Languages';
		$this->layout->content = View::make('languages.index')->with('languages', $languages);
	}

	/**
	 * Show the form to create a new language.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Language';
		$this->layout->content = View::make('languages.create');
	}

	/**
	 * Create a new language.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:30'),
		));

		if($validation->valid())
		{
			$language = new Language;

			$language->name = Input::get('name');

			$language->save();

			Session::flash('message', 'Added language #'.$language->id);

			return Redirect::to('languages');
		}

		else
		{
			return Redirect::to('languages/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific language.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$language = Language::find($id);

		if(is_null($language))
		{
			return Redirect::to('languages');
		}

		$this->layout->title   = 'Viewing Language #'.$id;
		$this->layout->content = View::make('languages.view')->with('language', $language);
	}

	/**
	 * Show the form to edit a specific language.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$language = Language::find($id);

		if(is_null($language))
		{
			return Redirect::to('languages');
		}

		$this->layout->title   = 'Editing Language';
		$this->layout->content = View::make('languages.edit')->with('language', $language);
	}

	/**
	 * Edit a specific language.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:30'),
		));

		if($validation->valid())
		{
			$language = Language::find($id);

			if(is_null($language))
			{
				return Redirect::to('languages');
			}

			$language->name = Input::get('name');

			$language->save();

			Session::flash('message', 'Updated language #'.$language->id);

			return Redirect::to('languages');
		}

		else
		{
			return Redirect::to('languages/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific language.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$language = Language::find($id);

		if( ! is_null($language))
		{
			$language->delete();

			Session::flash('message', 'Deleted language #'.$language->id);
		}

		return Redirect::to('languages');
	}
}