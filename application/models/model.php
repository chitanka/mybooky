<?php

abstract class Model extends \Laravel\Database\Eloquent\Model {

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	/**
	 * The field name used to represent this object in a string context, i.e. __toString()
	 */
	protected static $nameField = 'name';

	public static function listsKeyValue() {
		return self::ordered_query()->lists(static::$nameField, static::$key);
	}

	public static function ordered_query() {
		return self::order_by(static::$nameField, 'asc');
	}

	public function __toString() {
		return $this->{static::$nameField};
	}

}
