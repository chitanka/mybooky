<?php
return array(

	'title' => 'Езици',
	'single' => 'language',
	'model' => 'Language',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id',
		'name' => array(
			'title' => 'Име',
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
	),

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'name' => array(
			'title' => 'Име',
			'type' => 'text',
		),
	),

);
