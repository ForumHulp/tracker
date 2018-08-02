<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('types')->insert([[
					'id'	=> 1,
					'title' => 'Bug',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				],
				[
					'id'	=> 2,
					'title' => 'Support',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				],
				[
					'id'	=> 3,
					'title' => 'Feature',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				]]
				);
    }
}
