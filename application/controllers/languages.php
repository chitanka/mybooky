<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Languages_Controller extends Crud_Controller {

	protected $model = 'Language';

	protected $formFields = array(
		'name' => array('validators' => 'required,max:30'),
	);
}
