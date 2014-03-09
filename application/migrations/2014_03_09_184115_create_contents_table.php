<?php

class Create_Contents_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('contents', function($table)
		{
			$table->increments('id');

			$table->integer('book_id');
			$table->integer('idx');
			$table->string('title', 100);
			$table->string('note', 200);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contents');
	}

}