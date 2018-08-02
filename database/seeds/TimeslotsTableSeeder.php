<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Timeslot;
use App\User;

class TimeslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($seed=1; $seed<20; $seed++){


        $hours= rand(0, 23);
        $input = array(00, 15, 30, 45, 00, 15, 30, 45, 00,);
        $rand_keys = array_rand($input, 2);
        $minutes = $input[$rand_keys[0]];

        $date = Carbon::create(2018, 5, 28, $hours, $minutes, 0);
        DB::table('timeslots')->insert([
    					'id'	=> $seed,
              'user_id' => User::all()->random()->id,
              'time_amount' => $date->format('Y-m-d H:i:s'),
              'date' => date('Y-m-d H:i:s'),
    					'created_at' => date('Y-m-d H:i:s'),
    					'updated_at' => date('Y-m-d H:i:s'),
    			]
    				);

      }

    }
}
