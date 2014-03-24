<?php
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
}
