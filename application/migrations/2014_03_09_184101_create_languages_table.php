<?php

class Create_Languages_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('languages', function($table)
		{
			$table->increments('id');

			$table->string('name', 30);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('languages');
	}

}