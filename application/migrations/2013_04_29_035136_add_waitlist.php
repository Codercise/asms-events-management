<?php

class Add_Waitlist {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//add waitlist table
		Schema::table('pdevent_waitlist', function($table){
			$table->create();
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('pdevent_id');
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