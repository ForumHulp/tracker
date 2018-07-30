<?php

use Illuminate\Database\Seeder;

class StatusesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('statuses')->insert([[
					'id'	=> 1,
					'title' => 'New',
				],
				[
					'id'	=> 2,
					'title' => 'Assigned',
				],
				[
					'id'	=> 3,
					'title' => 'Closed',
				]]
				);
    }
}
