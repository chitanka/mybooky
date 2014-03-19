<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Translators_Controller extends Crud_Controller {

	protected $single = 'translator';
	protected $plural = 'translators';
	protected $model = 'Translator';

	protected $formFields = array(
		'name' => array('required,max:100'),
		'nickname' => array('max:50'),
		'note' => array('max:200'),
	);
}
