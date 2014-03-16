<?php
return array(

	'title' => 'Теми',
	'single' => 'theme',
	'model' => 'Theme',

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
