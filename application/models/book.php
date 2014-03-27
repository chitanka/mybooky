<?php

class Book extends Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'books';

	/**
	 * The field name used to represent this object in a string context, i.e. __toString()
	 */
	protected static $nameField = 'title';

	/**
	 * Establish the relationship between a book and a sequence.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_One
	 */
	public function sequence() {
		return $this->belongs_to('Sequence');
	}

	public function contents() {
		return $this->has_many('Content');
	}

	public function authors() {
		return $this->has_many_and_belongs_to('Author', 'book_author');
	}

	public function translators() {
		return $this->has_many_and_belongs_to('Translator', 'book_translator');
	}

	public function compilers() {
		return $this->has_many_and_belongs_to('Compiler', 'book_compiler');
	}

	public function illustrators() {
		return $this->has_many_and_belongs_to('Illustrator', 'book_illustrator');
	}

	public function publishers() {
		return $this->has_many_and_belongs_to('Publisher', 'book_publisher');
	}

	public function printhouses() {
		return $this->has_many_and_belongs_to('Printhouse', 'book_printhouse');
	}

	public function languages() {
		return $this->has_many_and_belongs_to('Language', 'book_language');
	}

	/**
	 * Establish the relationship between a book and themes.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function themes() {
		return $this->has_many_and_belongs_to('Theme', 'book_theme');
	}

	public function set_authors($authorIds) {
		$this->authors()->sync($authorIds);
	}

	public function set_translators($translatorIds) {
		$this->translators()->sync($translatorIds);
	}

	public function set_compilers($compilerIds) {
		$this->compilers()->sync($compilerIds);
	}

	public function set_illustrators($illustratorIds) {
		$this->illustrators()->sync($illustratorIds);
	}

	public function set_publishers($publisherIds) {
		$this->publishers()->sync($publisherIds);
	}

	public function set_printhouses($printhouseIds) {
		$this->printhouses()->sync($printhouseIds);
	}

	public function set_themes($themeIds) {
		$this->themes()->sync($themeIds);
	}

	public function set_languages($languageIds) {
		$this->languages()->sync($languageIds);
	}

	public function set_sequence($sequence) {
		if (is_numeric($sequence)) {
			$this->sequence_id = $sequence;
		}
	}

	public function set_contents($contents) {
		$this->contents()->save($contents);
	}
}
