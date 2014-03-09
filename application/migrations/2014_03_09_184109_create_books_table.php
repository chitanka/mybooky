<?php

class Create_Books_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('books', function($table)
		{
			$table->increments('id');

			$table->string('title', 100);
			$table->string('edition', 30);
			$table->string('pub_date', 30);
			$table->integer('volume');
			$table->integer('pages');
			$table->integer('seq_num');
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
		Schema::drop('books');
	}

}