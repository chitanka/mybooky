<?php

class Translator extends Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'translators';

	public function books() {
		return $this->has_many_and_belongs_to('Book', 'book_translator');
	}

	public function contents() {
		return $this->has_many_and_belongs_to('Content', 'content_translator');
	}

	public function set_books($bookIds) {
		$this->books()->sync($bookIds);
	}

	public function set_contents($contentIds) {
		$this->contents()->sync($contentIds);
	}
}
