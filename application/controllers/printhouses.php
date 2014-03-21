<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Printhouses_Controller extends Crud_Controller {

	protected $model = 'Printhouse';

	protected $formFields = array(
		'name' => array('validators' => 'required,max:100'),
	);
}
