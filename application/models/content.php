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
	public static $timestamps = false;

	/**
	 * Establish the relationship between a content and a book.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function book()
	{
		return $this->belongs_to('Book');
	}

	/**
	 * Establish the relationship between a content and themes.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function themes()
	{
		return $this->has_many('Theme');
	}
}