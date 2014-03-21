<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Books_Controller extends Crud_Controller {

	protected $model = 'Book';
	protected $withRelations = array(
		'authors',
		'translators',
		'compilers',
		'illustrators',
		'languages',
		'themes',
		'sequence',
		'publishers',
		'printhouses',
	);

	protected $formFields = array(
		'title' => array(
			'validators' => 'required,max:100',
			'type' => 'text',
		),
		'authors',
		'translators' => array(
			'index' => false,
		),
		'compilers' => array(
			'index' => false,
		),
		'illustrators' => array(
			'index' => false,
		),
		'languages' => array(
			'index' => false,
		),
		'themes',
		'edition' => array(
			'validators' => 'max:30',
		),
		'pub_date' => array(
			'validators' => 'max:30',
		),
		'volume' => array(
			'validators' => 'integer',
			'index' => false,
		),
		'pages' => array(
			'validators' => 'integer',
			'index' => false,
		),
		'sequence',
		'seq_num' => array(
			'validators' => 'integer',
			'index' => false,
		),
		'note' => array(
			'validators' => 'max:200',
			'index' => false,
		),
		'publishers' => array(
			'index' => false,
		),
		'printhouses' => array(
			'index' => false,
		),
	);

}
