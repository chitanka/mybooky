<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Books_Controller extends Crud_Controller {

	protected $single = 'book';
	protected $plural = 'books';
	protected $model = 'Book';
	protected $withRelations = array('sequence', 'themes');

	protected $formFields = array(
		'title' => array('required,max:100'),
		'edition' => array('max:30'),
		'pub_date' => array('max:30'),
		'volume' => array('integer'),
		'pages' => array('integer'),
		'seq_num' => array('integer'),
		'note' => array('max:200'),
	);
	protected $relations = array(
		'themes',
	);

	protected function view_params_create() {
		return array(
			'themeOptions' => Theme::lists('name', 'id'),
		);
	}

}
