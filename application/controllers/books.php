<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Books_Controller extends Crud_Controller {

	protected $model = 'Book';
	protected $withRelations = array('sequence', 'themes');

	protected $formFields = array(
		'title' => array(
			'validators' => 'required,max:100',
			'type' => 'text',
		),
		'authors',
		'translators',
		'compilers',
		'illustrators',
		'languages',
		'themes',
		'edition' => array('max:30'),
		'pub_date' => array('max:30'),
		'volume' => array('integer'),
		'pages' => array('integer'),
		'sequence',
		'seq_num' => array('integer'),
		'note' => array('max:200'),
		'publishers',
		'printhouses',
	);

}
