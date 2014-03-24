<?php

class Compiler extends Model {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'compilers';

	public function books() {
		return $this->has_many_and_belongs_to('Book', 'book_compiler');
	}

	public function set_books($bookIds) {
		$this->books()->sync($bookIds);
	}

}
