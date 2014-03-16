<?php
return array(

	'title' => 'Автори',
	'single' => 'author',
	'model' => 'Author',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id',
		'name' => array(
			'title' => 'Име',
		),
		'nickname' => array(
			'title' => 'Псевдоним',
		),
		'note' => array(
			'title' => 'Бележка',
		),
		/*'num_books' => array(
			'title' => '# books',
			'relationship' => 'books',
			'select' => 'COUNT((:table).id)',
		),*/
	),
	'sort' => array(
		'field' => 'name',
		'direction' => 'asc',
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'id',
		'name' => array(
			'title' => 'Име',
		),
		'nickname' => array(
			'title' => 'Псевдоним',
		),
		/*'books' => array(
			'title' => 'Books',
			'type' => 'relationship',
			'name_field' => 'title',
		),*/
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'name' => array(
			'title' => 'Име',
			'type' => 'text',
		),
		'nickname' => array(
			'title' => 'Псевдоним',
			'type' => 'text',
		),
		'note' => array(
			'title' => 'Бележка',
			'type' => 'text',
		),
		'books' => array(
			'title' => 'Книги',
			'type' => 'relationship',
			'name_field' => 'title',
		),
	),

);
