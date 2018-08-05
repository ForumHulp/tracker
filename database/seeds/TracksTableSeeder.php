<?php

use Illuminate\Database\Seeder;

class TracksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('tracks')->insert([[
				"id" => 1,
				"user_id" => 1,
				"issue_id" => 3,
				"remark" => "Dit is een remark",
				"used_time" => 1,
				"progress" => 20,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			], [
				"id" => 2,
				"user_id" => 1,
				"issue_id" => 3,
				"remark" => "Dit is remark 2",
				"used_time" => 9,
				"progress" => 30,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]]
		);
    }
}
