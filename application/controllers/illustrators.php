<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Illustrators_Controller extends Crud_Controller {

	protected $single = 'illustrator';
	protected $plural = 'illustrators';
	protected $model = 'Illustrator';

	protected $formFields = array(
		'name' => array('required,max:100'),
		'nickname' => array('max:50'),
		'note' => array('max:200'),
	);
}
