<?php

class Create_Publishers_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('publishers', function($table)
		{
			$table->increments('id');

			$table->string('name', 100);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publishers');
	}

}