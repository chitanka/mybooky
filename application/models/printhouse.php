<?php

class Printhouse extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'printhouses';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	public function books() {
		return $this->has_many_and_belongs_to('Book', 'book_printhouse');
	}

	public function __toString() {
		return $this->name;
	}
}
