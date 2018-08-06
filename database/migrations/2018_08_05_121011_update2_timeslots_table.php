<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update2TimeslotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issues', function (Blueprint $table) {
	  		$table->dropForeign('issues_used_time_foreign');
			$table->dropColumn('used_time');
			
			$table->dropForeign('issues_plan_time_foreign');
			$table->dropColumn('plan_time');
        });
		
		Schema::drop('timeslots');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::create('timeslots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->time('time_amount');
            $table->date('date');
            $table->timestamps();
			$table->softDeletes();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
		});
		
		Schema::table('issues', function (Blueprint $table) {
	  		$table->unsignedInteger('used_time')->nullable();
			$table->foreign('used_time')
                ->references('id')
                ->on('timeslots');
				
			$table->unsignedInteger('plan_time')->nullable();
			$table->foreign('plan_time')
                ->references('id')
                ->on('timeslots');
        });
    }
}
