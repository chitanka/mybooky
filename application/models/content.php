<?php

class Content extends \Laravel\Database\Eloquent\Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'contents';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	public static function listsKeyValue() {
		return self::lists('title', 'id');
	}

	/**
	 * Establish the relationship between a content and a book.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function book() {
		return $this->belongs_to('Book');
	}

	public function authors() {
		return $this->has_many_and_belongs_to('Author', 'content_author');
	}

	public function translators() {
		return $this->has_many_and_belongs_to('Translator', 'content_translator');
	}

	public function illustrators() {
		return $this->has_many_and_belongs_to('Illustrator', 'content_illustrator');
	}

	public function languages() {
		return $this->has_many_and_belongs_to('Language', 'content_language');
	}

	/**
	 * Establish the relationship between a content and themes.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function themes() {
		return $this->has_many_and_belongs_to('Theme', 'content_theme');
	}

	public function set_book($book) {
		if (is_numeric($book)) {
			$this->book_id = $book;
		}
	}

	public function set_authors($authorIds) {
		$this->authors()->sync($authorIds);
	}

	public function set_translators($translatorIds) {
		$this->translators()->sync($translatorIds);
	}

	public function set_illustrators($illustratorIds) {
		$this->illustrators()->sync($illustratorIds);
	}

	public function set_themes($themeIds) {
		$this->themes()->sync($themeIds);
	}

	public function set_languages($languageIds) {
		$this->languages()->sync($languageIds);
	}

	public function __toString() {
		return $this->title;
	}
}
