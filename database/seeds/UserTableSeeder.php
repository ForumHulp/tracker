<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role_employee = Role::where('name', 'employee')->first();
		$role_manager  = Role::where('name', 'manager')->first();

		$employee = new User();
		$employee->name = 'Billy';
		$employee->email = 'billyhcho@gmail.com';
		$employee->password = bcrypt('secret');
		$employee->save();
		$employee->roles()->attach($role_employee);

		$employee = new User();
		$employee->name = 'Youp';
		$employee->email = 'youpkoopmans@hotmail.com';
		$employee->password = bcrypt('secret');
		$employee->save();
		$employee->roles()->attach($role_employee);

		$employee = new User();
		$employee->name = 'John';
		$employee->email = 'info@forumhulp.com';
		$employee->password = bcrypt('secret');
		$employee->save();
		$employee->roles()->attach($role_employee);

		$manager = new User();
		$manager->name = 'Manager';
		$manager->email = 'manager@example.com' ;
		$manager->password = bcrypt('secret');
		$manager->save();
		$manager->roles()->attach($role_manager);
    }
}
