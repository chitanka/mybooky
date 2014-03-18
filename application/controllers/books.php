<?php

class Books_Controller extends Base_Controller {

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
	 * View all of the books.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$books = Book::with(array('sequence', 'themes'))->get();

		$this->layout->title   = 'Books';
		$this->layout->content = View::make('books.index')->with('books', $books);
	}

	/**
	 * Show the form to create a new book.
	 *
	 * @return void
	 */
	public function get_create() {
		$this->layout->title   = 'New Book';
		$this->layout->content = View::make('books.create')->with(array(
			'themeOptions' => Theme::lists('name', 'id'),
		));
	}

	/**
	 * Create a new book.
	 *
	 * @return Response
	 */
	public function post_create() {
		$validation = Validator::make(Input::all(), array(
			'title' => array('required', 'max:100'),
			'edition' => array('max:30'),
			'pub_date' => array('max:30'),
			'volume' => array('integer'),
			'pages' => array('integer'),
			'seq_num' => array('integer'),
			'note' => array('max:200'),
		));

		if($validation->valid()) {
			$book = new Book;

			$book->title = Input::get('title');
			$book->edition = Input::get('edition');
			$book->pub_date = Input::get('pub_date');
			$book->volume = Input::get('volume');
			$book->pages = Input::get('pages');
			$book->seq_num = Input::get('seq_num');
			$book->note = Input::get('note');
			$book->save();
			$book->themes()->sync(Input::get('themes'));

			$book->save();

			Session::flash('message', 'Added book #'.$book->id);

			return Redirect::to('books');
		}

		return Redirect::to('books/create')
			->with_errors($validation->errors)
			->with_input();
	}

	/**
	 * View a specific book.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$book = Book::with(array('sequence', 'themes'))->find($id);

		if(is_null($book))
		{
			return Redirect::to('books');
		}

		$this->layout->title   = 'Viewing Book #'.$id;
		$this->layout->content = View::make('books.view')->with('book', $book);
	}

	/**
	 * Show the form to edit a specific book.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$book = Book::find($id);

		if(is_null($book))
		{
			return Redirect::to('books');
		}

		$this->layout->title   = 'Editing Book';
		$this->layout->content = View::make('books.edit')->with(array(
			'book' => $book,
			'themeOptions' => Theme::lists('name', 'id'),
		));
	}

	/**
	 * Edit a specific book.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id) {
		$validation = Validator::make(Input::all(), array(
			'title' => array('required', 'max:100'),
			'edition' => array('max:30'),
			'pub_date' => array('max:30'),
			'volume' => array('integer'),
			'pages' => array('integer'),
			'seq_num' => array('integer'),
			'note' => array('max:200'),
		));

		if($validation->valid()) {
			$book = Book::find($id);

			if(is_null($book)) {
				return Redirect::to('books');
			}

			$book->title = Input::get('title');
			$book->edition = Input::get('edition');
			$book->pub_date = Input::get('pub_date');
			$book->volume = Input::get('volume');
			$book->pages = Input::get('pages');
			$book->seq_num = Input::get('seq_num');
			$book->note = Input::get('note');
			$book->themes()->sync(Input::get('themes'));

			$book->save();

			Session::flash('message', 'Updated book #'.$book->id);

			return Redirect::to('books');
		}

		return Redirect::to('books/edit/'.$id)
			->with_errors($validation->errors)
			->with_input();
	}

	/**
	 * Delete a specific book.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$book = Book::find($id);

		if( ! is_null($book))
		{
			$book->delete();

			Session::flash('message', 'Deleted book #'.$book->id);
		}

		return Redirect::to('books');
	}
}