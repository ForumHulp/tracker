<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIssuesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('issues', function(Blueprint $table) {
      // These columns are needed for Baum's Nested Set implementation to work.
      // Column names may be changed, but they *must* all exist and be modified
      // in the model.
      // Take a look at the model scaffold comments for details.
      // We add indexes on parent_id, lft, rgt columns by default.
      $table->unsignedInteger('project_id')->nullable()->index();
      $table->integer('parent_id')->nullable()->index();
      $table->integer('lft')->nullable()->index();
      $table->integer('rgt')->nullable()->index();
      $table->integer('depth')->nullable();
	  $table->dropColumn('parent');

	  $table->foreign('project_id')
		->references('id')
		->on('projects');
      // Add needed columns here (f.ex: name, slug, path, etc.)
      // $table->string('name', 255);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
	Schema::table('issues', function (Blueprint $table) {
        $table->dropForeign(['project_id']);
		$table->dropColumn(['project_id', 'parent_id', 'lft', 'rgt', 'depth']);
        $table->unsignedInteger('parent')->nullable();
	});
  }

}
