<?php

class Sequence extends \Laravel\Database\Eloquent\Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'sequences';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	public function books() {
		return $this->has_many('Book');
	}

	public function __toString() {
		return $this->name;
	}
}
