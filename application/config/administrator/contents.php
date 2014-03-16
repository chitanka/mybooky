<?php
return array(

	'title' => 'Съдържания', // Произведения
	'single' => 'content',
	'model' => 'Content',

	/**
	 * The display columns
	 */
	'columns' => array(
		'book_name' => array(
			'title' => 'Книга',
			'relationship' => 'book',
			'select' => '(:table).title',
		),
		'idx' => array(
			'title' => '№',
		),
		'title' => array(
			'title' => 'Заглавие',
		),
	),
	'sort' => array(
		'field' => 'title',
		'direction' => 'asc',
	),

	/**
	 * The filter set
	 */
	'filters' => array(
		'title' => array(
			'title' => 'Title',
		),
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'book' => array(
			'title' => 'Книга',
			'type' => 'relationship',
			'sort_field' => 'title',
		),
		'idx' => array(
			'title' => 'Позиция',
			'type' => 'integer',
		),
		'title' => array(
			'title' => 'Заглавие',
			'type' => 'text',
		),
		'authors' => array(
			'title' => 'Автори',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
		'translators' => array(
			'title' => 'Преводачи',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
		'illustrators' => array(
			'title' => 'Илюстратори',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
//		'languages' => array(
//			'title' => 'Езици',
//			'type' => 'relationship',
//			'sort_field' => 'name',
//		),
		'themes' => array(
			'title' => 'Теми',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
		'note' => array(
			'title' => 'Бележка',
			'type' => 'text',
		),
	),

);
