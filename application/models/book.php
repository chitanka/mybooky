<?php

class Book extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'books';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = false;

	/**
	 * Establish the relationship between a book and a sequence.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_One
	 */
	public function sequence()
	{
		return $this->has_one('Sequence');
	}

	/**
	 * Establish the relationship between a book and themes.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function themes()
	{
		return $this->has_many('Theme');
	}
}