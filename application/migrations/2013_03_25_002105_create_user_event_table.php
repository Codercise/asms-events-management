<?php

class Create_User_PDEvent_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('pdevent_user', function($table){
			$table->create();
			$table->integer('id');
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