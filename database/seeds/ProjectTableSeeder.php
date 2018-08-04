<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('projects')->insert([[
					'id'	=> 1,
					'client_id'	=> 1,
					'title' => 'Issue tracker',
					'description' => 'Issuetracker for Inovamedia',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				],
				[
					'id'	=> 2,
					'client_id'	=> 4,
					'title' => 'Proband Genealogy pages',
					'description' => 'Proband for ForumHulp.com',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				]]
			);
    }
}
