<?php
class_exists('Crud_Controller') || require __DIR__.'/crud.php';

class Themes_Controller extends Crud_Controller {

	protected $single = 'theme';
	protected $plural = 'themes';
	protected $model = 'Theme';

	protected $formFields = array(
		'name' => array('required,max:50'),
	);

}
