<?php

class Themes_Controller extends Base_Controller {

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
	 * View all of the themes.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$themes = Theme::all();

		$this->layout->title   = 'Themes';
		$this->layout->content = View::make('themes.index')->with('themes', $themes);
	}

	/**
	 * Show the form to create a new theme.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Theme';
		$this->layout->content = View::make('themes.create');
	}

	/**
	 * Create a new theme.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:50'),
		));

		if($validation->valid())
		{
			$theme = new Theme;

			$theme->name = Input::get('name');

			$theme->save();

			Session::flash('message', 'Added theme #'.$theme->id);

			return Redirect::to('themes');
		}

		else
		{
			return Redirect::to('themes/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific theme.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$theme = Theme::find($id);

		if(is_null($theme))
		{
			return Redirect::to('themes');
		}

		$this->layout->title   = 'Viewing Theme #'.$id;
		$this->layout->content = View::make('themes.view')->with('theme', $theme);
	}

	/**
	 * Show the form to edit a specific theme.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$theme = Theme::find($id);

		if(is_null($theme))
		{
			return Redirect::to('themes');
		}

		$this->layout->title   = 'Editing Theme';
		$this->layout->content = View::make('themes.edit')->with('theme', $theme);
	}

	/**
	 * Edit a specific theme.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required', 'max:50'),
		));

		if($validation->valid())
		{
			$theme = Theme::find($id);

			if(is_null($theme))
			{
				return Redirect::to('themes');
			}

			$theme->name = Input::get('name');

			$theme->save();

			Session::flash('message', 'Updated theme #'.$theme->id);

			return Redirect::to('themes');
		}

		else
		{
			return Redirect::to('themes/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific theme.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$theme = Theme::find($id);

		if( ! is_null($theme))
		{
			$theme->delete();

			Session::flash('message', 'Deleted theme #'.$theme->id);
		}

		return Redirect::to('themes');
	}
}