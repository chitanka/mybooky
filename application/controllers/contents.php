<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Contents_Controller extends Crud_Controller {

	protected $single = 'content';
	protected $plural = 'contents';
	protected $model = 'Content';

	protected $formFields = array(
		'book_id' => array('required,integer'),
		'idx' => array('required,integer'),
		'title' => array('required,max:100'),
		'note' => array('max:200'),
	);

	protected function view_params_create($book_id = null) {
		return array(
			'book_id' => $book_id,
			'bookOptions' => array('') + Book::lists('title', 'id'),
		);
	}

//	public function get_view($id){
//		$content = Content::with(array('book', 'themes'))->find($id);
//	}
}
