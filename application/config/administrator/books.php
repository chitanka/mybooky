<?php
return array(

	'title' => 'Книги',
	'single' => 'book',
	'model' => 'Book',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id',
		'title' => array(
			'title' => 'Заглавие',
		),
		'sequence_name' => array(
			'title' => 'Поредица',
			'relationship' => 'sequence',
			'select' => '(:table).name',
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
		'id',
		'title' => array(
			'title' => 'Заглавие',
		),
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'title' => array(
			'title' => 'Заглавие',
			'type' => 'text',
		),
		'sequence' => array(
			'title' => 'Поредица',
			'type' => 'relationship',
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
		'compilers' => array(
			'title' => 'Съставители',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
		'illustrators' => array(
			'title' => 'Илюстратори',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
		'publishers' => array(
			'title' => 'Издатели',
			'type' => 'relationship',
			'sort_field' => 'name',
		),
		'printhouses' => array(
			'title' => 'Печатници',
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
	),
);
