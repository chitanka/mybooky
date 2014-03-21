<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Authors_Controller extends Crud_Controller {

	protected $model = 'Author';

	protected $formFields = array(
		'name' => array('validators' => 'required,max:100'),
		'nickname' => array('validators' => 'max:50'),
		'note' => array(
			'validators' => 'max:200',
			'type' => 'text',
		),
	);

}
