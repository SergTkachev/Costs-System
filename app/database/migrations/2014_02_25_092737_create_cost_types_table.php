<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
    Schema::create('costs', function($table) {
        $table->engine = 'InnoDB';
        $table->increments('cid');
        $table->integer('value');
        $table->integer('tid');
        $table->integer('uid');
        $table->string('description', 255)->default('');
        $table->timestamp('date');
    });
    Schema::create('users', function($table) {
        $table->engine = 'InnoDB';
        $table->increments('uid');
        $table->string('name', 64);
        $table->string('email', 64)->unique();;
        $table->string('password', 256);
    });
    Schema::create('types', function($table) {
        $table->engine = 'InnoDB';
        $table->increments('tid');
        $table->string('name', 64)->unique();;
    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('costs');
    Schema::dropIfExists('users');
    Schema::dropIfExists('types');
	}

}
