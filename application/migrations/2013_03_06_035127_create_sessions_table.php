<?php

class Create_Sessions_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('sessions', function($table){
			$table->increments('id')->unique();
			$table->integer('last_activity');
			$table->text('data');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}