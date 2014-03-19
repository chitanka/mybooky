<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Languages_Controller extends Crud_Controller {

	protected $single = 'language';
	protected $plural = 'languages';
	protected $model = 'Language';

	protected $formFields = array(
		'name' => array('required,max:30'),
	);
}
