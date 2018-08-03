<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('priority_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->unsignedInteger('plan_time')->nullable();
            $table->unsignedInteger('assigned')->nullable();
            $table->unsignedInteger('used_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients');

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');

            $table->foreign('type_id')
                ->references('id')
                ->on('types');

            $table->foreign('priority_id')
                ->references('id')
                ->on('priorities');

            $table->foreign('plan_time')
                ->references('id')
                ->on('timeslots');

            $table->foreign('assigned')
                ->references('id')
                ->on('users');

            $table->foreign('used_time')
                ->references('id')
                ->on('timeslots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
