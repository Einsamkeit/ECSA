<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('logo');
                        $table->string('municipio');
                        $table->string('estado');
                        $table->string('dir');
                        $table->string('tel1');
                        $table->string('tel2');
                        $table->string('firma');
                        $table->string('correo');
                        $table->integer('status');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('organizations');
	}

}
