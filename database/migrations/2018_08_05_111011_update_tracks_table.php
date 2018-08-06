<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracks', function (Blueprint $table) {
            $table->date('date')->nullable();
	  		$table->dropForeign(['used_time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('tracks', function (Blueprint $table) {
            $table->foreign('used_time')
                ->references('id')
                ->on('timeslots');
			$table->dropColumn('date');
		});
    }
}
