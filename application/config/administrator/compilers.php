<?php
return array(

	'title' => 'Съставители',
	'single' => 'compiler',
	'model' => 'Compiler',

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
	),

);
