<?php

class Illustrator extends \Laravel\Database\Eloquent\Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'illustrators';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	public function books() {
		return $this->has_many_and_belongs_to('Book', 'book_illustrator');
	}

	public function contents() {
		return $this->has_many_and_belongs_to('Content', 'content_illustrator');
	}

	public function __toString() {
		return $this->name;
	}
}
