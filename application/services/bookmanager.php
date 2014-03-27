<?php
namespace Application\Services;

class BookManager extends ObjectManager {

	public function __construct($model = null, $controller = null) {
		parent::__construct($model ?: 'Book', $controller);
	}

	public function createObject($requestParams) {
		$book = parent::createObject($requestParams);
		$this->saveContents($book, $requestParams);
		return $book;
	}

	public function updateObject($id, $requestParams) {
		$book = parent::updateObject($id, $requestParams);
		$this->saveContents($book, $requestParams);
		return $book;
	}

	protected function saveContents($book, $requestParams) {
		if (isset($requestParams['contents']['NEXT_INDEX'])) {
			unset($requestParams['contents']['NEXT_INDEX']);
		}
		$contentManager = $this->newContentManager();
		foreach ($requestParams['contents'] as $contentParams) {
			$contentParams['book'] = $book;
			$contentManager->createObject($contentParams);
		}
	}

	public function view_params_create($requestParams = null) {
		$contentManager = $this->newContentManager();
		$contentParams = $contentManager->view_params_create($requestParams);
		unset($contentParams['fields']['book']);
		$templateContentFields = array();
		foreach ($contentParams['fields'] as $field => $options) {
			$templateContentFields[] = array('name' => "contents[NEXT_INDEX][$field]") + $options;
		}

		return array(
			'templateContentFields' => $templateContentFields,
			'nextContentIndex' => 1,
		) + parent::view_params_create($requestParams);
	}

	public function view_params_edit($book, $requestParams = null) {
		$contentManager = $this->newContentManager();
		$contentParams = $contentManager->view_params_create($requestParams);
		unset($contentParams['fields']['book']);
		$templateContentFields = array();
		foreach ($contentParams['fields'] as $field => $options) {
			$templateContentFields[] = array('name' => "contents[NEXT_INDEX][$field]") + $options;
		}

		$contents = $book->contents()->get();
		$contentFields = array();
		$nextContentIndex = 1;
		foreach ($contents as $content) {
			$fields = array();
			foreach ($contentParams['fields'] as $field => $options) {
				$fields[$field] = array('name' => "contents[$nextContentIndex][$field]") + $options;
			}
			$content->fields = $fields;
			$nextContentIndex++;
		}

		return array(
			'contents' => $contents,
			'templateContentFields' => $templateContentFields,
			'nextContentIndex' => $nextContentIndex,
		) + parent::view_params_edit($book, $requestParams);
	}

	protected function newContentManager() {
		return new ObjectManager('Content');
	}
}
