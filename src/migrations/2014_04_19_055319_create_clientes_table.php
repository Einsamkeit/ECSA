<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
			$table->increments('id');
                        $table->string('name');
                        $table->string('municipio');
                        $table->string('estado');
                        $table->string('dir');
                        $table->string('tel1');
                        $table->string('nextel');
                        $table->string('correo');
                        $table->string('url');
                        $table->string('organizations_id');
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
		Schema::drop('clientes');
	}

}
