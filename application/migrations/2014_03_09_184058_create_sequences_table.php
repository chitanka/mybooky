<?php

class Create_Sequences_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('sequences', function($table)
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
		Schema::drop('sequences');
	}

}