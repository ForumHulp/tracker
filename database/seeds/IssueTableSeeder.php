<?php

use Illuminate\Database\Seeder;

class IssueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('issues')->insert([[
					"id" => 1,
					"status_id" => 2,
					"type_id" => 1,
					"priority_id" => 3,
					"title" => "Issue 1",
					"description" => "Hier de beschrijving van het issue",
					"start_date" => "2018-08-04",
					"plan_time" => 3,
					"assigned" => 1,
					"used_time" => NULL,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
					"deleted_at" => NULL,
					"project_id" => 1,
					"parent_id" => NULL,
					"lft" => 1,
					"rgt" => 2,
					"depth" => 0,
				], [
					"id" => 2,
					"status_id" => 2,
					"type_id" => 1,
					"priority_id" => 3,
					"title" => "Issue 1",
					"description" => "Hier de beschrijving van het issue",
					"start_date" => "2018-08-04",
					"plan_time" => 3,
					"assigned" => 3,
					"used_time" => NULL,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
					"deleted_at" => NULL,
					"project_id" => 2,
					"parent_id" => NULL,
					"lft" => 1,
					"rgt" => 2,
					"depth" => 0,
				], [
					"id" => 3,
					"status_id" => 2,
					"type_id" => 1,
					"priority_id" => 3,
					"title" => "Sub Issue 1",
					"description" => "Hier de beschrijving van het issue",
					"start_date" => "2018-08-04",
					"plan_time" => 3,
					"assigned" => 2,
					"used_time" => NULL,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
					"deleted_at" => NULL,
					"project_id" => 2,
					"parent_id" => 2,
					"lft" => 4,
					"rgt" => 5,
					"depth" => 1,
				], [
					"id" => 4,
					"status_id" => 3,
					"type_id" => 1,
					"priority_id" => 3,
					"title" => "Sub Issue 2",
					"description" => "Hier de beschrijving van het issue",
					"start_date" => "2018-08-04",
					"plan_time" => 3,
					"assigned" => 1,
					"used_time" => NULL,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
					"deleted_at" => NULL,
					"project_id" => 2,
					"parent_id" => 2,
					"lft" => 6,
					"rgt" => 7,
					"depth" => 1,
			]]
		);
    }
}
