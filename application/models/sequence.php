<?php

class Sequence extends Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'sequences';

	public function books() {
		return $this->has_many('Book');
	}

	public function set_books($bookIds) {
		$this->books()->sync($bookIds);
	}

}
