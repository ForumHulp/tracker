<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('clients')->insert([[
					'id'	=> 1,
					'name' => 'InovaMedia',
					'email' => 'info@inovamedia.nl',
					'phone' => '0854841200',
					'country' => 'NL',
					'city' => 'Meijel',
					'address' => 'Kerkveld 2A',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
			    ],
				[
                    'id'	=> 2,
                    'name' => 'Hema',
                    'email' => 'info@hema.nl',
                    'phone' => '0612345678',
                    'country' => 'NL',
                    'city' => 'Panningen',
                    'address' => 'Markt 4',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
				],
				[
                    'id'	=> 3,
                    'name' => 'Coop',
                    'email' => 'info@coop.nl',
                    'phone' => '0687654321',
                    'country' => 'NL',
                    'city' => 'Meijel',
                    'address' => 'Kerkveld 5',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
				]]
				);
    }
}
