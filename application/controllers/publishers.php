<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Publishers_Controller extends Crud_Controller {

	protected $model = 'Publisher';

	protected $formFields = array(
		'name' => array('required,max:100'),
	);
}
