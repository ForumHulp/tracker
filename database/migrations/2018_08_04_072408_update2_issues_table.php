<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update2IssuesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('issues', function(Blueprint $table) {
	  $table->dropForeign(['client_id']);
	  $table->dropColumn('client_id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
	Schema::table('issues', function (Blueprint $table) {
        $table->unsignedInteger('client_id');
		$table->foreign('client_id')
			->references('id')
			->on('clients');
	});
  }

}
