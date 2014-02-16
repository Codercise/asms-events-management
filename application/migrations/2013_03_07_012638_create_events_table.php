<?php

class Create_Events_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create events table
		Schema::create('pdevents', function($table) {
			$table->increments('id')->unique;
			$table->string('name', 100);
			$table->text('description', 100);
			$table->date('date_start');
			$table->date('date_finish');
			$table->string('length', 10);
			$table->string('venue_address');
			$table->string('cost', 10);
			$table->string('password', 256);
			$table->timestamps();
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