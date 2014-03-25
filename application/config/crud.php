<?php
return array(
	'Author' => array(
		'fields' => array(
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
			)
		),
		'pagination' => 20
	),

	'Book' => array(
		'fields' => array(
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
			)
		),
		'pagination' => 20
	),

	'Compiler' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:100'),
			'nickname' => array('validators' => 'max:50'),
			'note' => array('validators' => 'max:200'),
			'books' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Content' => array(
		'fields' => array(
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
			'note' => array('validators' => 'max:200')
		),
		'pagination' => 20
	),

	'Illustrator' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:100'),
			'nickname' => array('validators' => 'max:50'),
			'note' => array('validators' => 'max:200'),
			'books' => array(
				'index' => false
			),
			'contents' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Language' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:30'),
			'books' => array(
				'index' => false
			),
			'contents' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Printhouse' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:100'),
			'books' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Publisher' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:100'),
			'books' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Sequence' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:100'),
			'books' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Theme' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:50'),
			'books' => array(
				'index' => false
			),
			'contents' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),

	'Translator' => array(
		'fields' => array(
			'name' => array('validators' => 'required,max:100'),
			'nickname' => array('validators' => 'max:50'),
			'note' => array('validators' => 'max:200'),
			'books' => array(
				'index' => false
			),
			'contents' => array(
				'index' => false
			)
		),
		'pagination' => 20
	),
);
