<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Authors_Controller extends Crud_Controller {

	protected $single = 'author';
	protected $plural = 'authors';
	protected $model = 'Author';

	protected $formFields = array(
		'name' => array('required,max:100'),
		'nickname' => array('max:50'),
		'note' => array('max:200'),
	);

}
