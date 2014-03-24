<?php
return array(
	'Author' => array(
		'name' => array('validators' => 'required,max:100'),
		'nickname' => array('validators' => 'max:50'),
		'note' => array(
			'validators' => 'max:200',
			'type' => 'text',
		),
		'books' => array(
			'index' => false
		),
		'contents' => array(
			'index' => false
		),
	),

	'Book' => array(
		'title' => array(
			'validators' => 'required,max:100',
			'type' => 'text',
		),
		'authors',
		'translators' => array(
			'index' => false,
		),
		'compilers' => array(
			'index' => false,
		),
		'illustrators' => array(
			'index' => false,
		),
		'languages' => array(
			'index' => false,
		),
		'themes',
		'edition' => array(
			'validators' => 'max:30',
		),
		'pub_date' => array(
			'validators' => 'max:30',
		),
		'volume' => array(
			'validators' => 'integer',
			'index' => false,
		),
		'pages' => array(
			'validators' => 'integer',
			'index' => false,
		),
		'sequence',
		'seq_num' => array(
			'validators' => 'integer',
			'index' => false,
		),
		'note' => array(
			'validators' => 'max:200',
			'index' => false,
		),
		'publishers' => array(
			'index' => false,
		),
		'printhouses' => array(
			'index' => false,
		),
	),

	'Compiler' => array(
		'name' => array('validators' => 'required,max:100'),
		'nickname' => array('validators' => 'max:50'),
		'note' => array('validators' => 'max:200'),
		'books' => array(
			'index' => false
		),
	),

	'Content' => array(
		'book',
		'idx' => array('validators' => 'required,integer'),
		'title' => array('validators' => 'required,max:100'),
		'authors',
		'translators' => array(
			'index' => false,
		),
		'illustrators' => array(
			'index' => false,
		),
		'languages' => array(
			'index' => false,
		),
		'themes' => array(
			'index' => false,
		),
		'note' => array('validators' => 'max:200'),
	),

	'Illustrator' => array(
		'name' => array('validators' => 'required,max:100'),
		'nickname' => array('validators' => 'max:50'),
		'note' => array('validators' => 'max:200'),
		'books' => array(
			'index' => false
		),
		'contents' => array(
			'index' => false
		),
	),

	'Language' => array(
		'name' => array('validators' => 'required,max:30'),
		'books' => array(
			'index' => false
		),
		'contents' => array(
			'index' => false
		),
	),

	'Printhouse' => array(
		'name' => array('validators' => 'required,max:100'),
		'books' => array(
			'index' => false
		),
	),

	'Publisher' => array(
		'name' => array('validators' => 'required,max:100'),
		'books' => array(
			'index' => false
		),
	),

	'Sequence' => array(
		'name' => array('validators' => 'required,max:100'),
		'books' => array(
			'index' => false
		),
	),

	'Theme' => array(
		'name' => array('validators' => 'required,max:50'),
		'books' => array(
			'index' => false
		),
		'contents' => array(
			'index' => false
		),
	),

	'Translator' => array(
		'name' => array('validators' => 'required,max:100'),
		'nickname' => array('validators' => 'max:50'),
		'note' => array('validators' => 'max:200'),
		'books' => array(
			'index' => false
		),
		'contents' => array(
			'index' => false
		),
	),
);
