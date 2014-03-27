<?php
namespace Application\Services;

class BookManager extends ObjectManager {

	public function __construct($model = null, $controller = null) {
		parent::__construct($model ?: 'Book', $controller);
	}

	public function view_params_create($requestParams) {
		$b = \Book::find(14);
		$b->set_contents(array (
    0 =>
    array (
      'idx' => '1',
      'title' => 'загл1',
      'note' => '',
    ),
    1 =>
    array (
      'idx' => '2',
      'title' => 'загл 2',
      'authors' =>
      array (
        0 => '8',
      ),
      'note' => '',
    ),
  ));
		#$b->save();

		$contentManager = new ObjectManager('Content');
		$contentParams = $contentManager->view_params_create($requestParams);
		unset($contentParams['fields']['book']);
		$contents = array();
		foreach ($contentParams['fields'] as $field => $options) {
			$contents[0]["contents[0][$field]"] = $options;
			$contents[1]["contents[1][$field]"] = $options;
		}

		return parent::view_params_create($requestParams) + array(
			'contents' => $contents,
		);
	}
}
