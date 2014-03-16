<?php
return array(

	'title' => 'Преводачи',
	'single' => 'translator',
	'model' => 'Translator',

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
