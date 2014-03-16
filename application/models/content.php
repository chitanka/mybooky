<?php

class Content extends Eloquent {

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

	/**
	 * Establish the relationship between a content and a book.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function book()
	{
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

}