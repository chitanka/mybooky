<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Contents_Controller extends Crud_Controller {

	protected $model = 'Content';
	protected $withRelations = array(
		'book',
		'authors',
		'translators',
		'illustrators',
		'languages',
		'themes',
	);

	protected $formFields = array(
		'book',
		'idx' => array('validators' => 'required,integer'),
		'title' => array('validators' => 'required,max:100'),
		'authors',
		'translators' => array(
			'index' => false,
		),
		'illustrators' => array(
			'index' => false,
		),
		'languages' => array(
			'index' => false,
		),
		'themes' => array(
			'index' => false,
		),
		'note' => array('validators' => 'max:200'),
	);

	protected function view_params_create($book_id = null) {
		return array(
			'book_id' => $book_id,
			'bookOptions' => array('') + Book::lists('title', 'id'),
		) + parent::view_params_create();
	}

}
