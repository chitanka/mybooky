<?php

class Create_Compilers_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('compilers', function($table)
		{
			$table->increments('id');

			$table->string('name', 100);
			$table->string('nickname', 50);
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
		Schema::drop('compilers');
	}

}