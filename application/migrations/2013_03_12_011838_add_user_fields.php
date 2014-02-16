<?php

class Add_User_Fields {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users', function($table) {
			$table->string('title', 10);
			$table->string('position', 50);
			$table->string('gender', 3);
			$table->string('contact_number', 14);
			$table->string('years_taught', 50);
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