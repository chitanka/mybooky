<?php
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

	protected function view_params_create($book_id = null) {
		return array(
			'book_id' => $book_id,
			'bookOptions' => array('') + Book::lists('title', 'id'),
		) + parent::view_params_create();
	}
}
