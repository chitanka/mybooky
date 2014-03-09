<?php

class Create_Themes_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('themes', function($table)
		{
			$table->increments('id');

			$table->string('name', 50);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('themes');
	}

}