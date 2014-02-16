<?php

class Add_Event_Fields {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('pdevents', function($table) {
			$table->string('available_spaces', 10);
			$table->string('facilitator', 50);
			$table->string('start_time', 10);
			$table->string('finish_time', 10);
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
		Schema::table('pdevents', function($table){
			$table->drop_column(array('date_start', 'date_finish'));
		});
	}

}