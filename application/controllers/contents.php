<?php

class Contents_Controller extends Base_Controller {

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
	 * View all of the contents.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$contents = Content::with(array('book', 'themes'))->get();

		$this->layout->title   = 'Contents';
		$this->layout->content = View::make('contents.index')->with('contents', $contents);
	}

	/**
	 * Show the form to create a new content.
	 *
	 * @return void
	 */
	public function get_create($book_id = null)
	{
		$this->layout->title   = 'New Content';
		$this->layout->content = View::make('contents.create', array(
									'book_id' => $book_id,
								));
	}

	/**
	 * Create a new content.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'book_id' => array('required', 'integer'),
			'idx' => array('required', 'integer'),
			'title' => array('required', 'max:100'),
			'note' => array('required', 'max:200'),
		));

		if($validation->valid())
		{
			$content = new Content;

			$content->book_id = Input::get('book_id');
			$content->idx = Input::get('idx');
			$content->title = Input::get('title');
			$content->note = Input::get('note');

			$content->save();

			Session::flash('message', 'Added content #'.$content->id);

			return Redirect::to('contents');
		}

		else
		{
			return Redirect::to('contents/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific content.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$content = Content::with(array('book', 'themes'))->find($id);

		if(is_null($content))
		{
			return Redirect::to('contents');
		}

		$this->layout->title   = 'Viewing Content #'.$id;
		$this->layout->content = View::make('contents.view')->with('content', $content);
	}

	/**
	 * Show the form to edit a specific content.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$content = Content::find($id);

		if(is_null($content))
		{
			return Redirect::to('contents');
		}

		$this->layout->title   = 'Editing Content';
		$this->layout->content = View::make('contents.edit')->with('content', $content);
	}

	/**
	 * Edit a specific content.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'book_id' => array('required', 'integer'),
			'idx' => array('required', 'integer'),
			'title' => array('required', 'max:100'),
			'note' => array('required', 'max:200'),
		));

		if($validation->valid())
		{
			$content = Content::find($id);

			if(is_null($content))
			{
				return Redirect::to('contents');
			}

			$content->book_id = Input::get('book_id');
			$content->idx = Input::get('idx');
			$content->title = Input::get('title');
			$content->note = Input::get('note');

			$content->save();

			Session::flash('message', 'Updated content #'.$content->id);

			return Redirect::to('contents');
		}

		else
		{
			return Redirect::to('contents/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific content.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$content = Content::find($id);

		if( ! is_null($content))
		{
			$content->delete();

			Session::flash('message', 'Deleted content #'.$content->id);
		}

		return Redirect::to('contents');
	}
}