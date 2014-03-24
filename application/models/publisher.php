<?php

class Publisher extends Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'publishers';

	public function books() {
		return $this->has_many_and_belongs_to('Book', 'book_publisher');
	}

	public function set_books($bookIds) {
		$this->books()->sync($bookIds);
	}

}
