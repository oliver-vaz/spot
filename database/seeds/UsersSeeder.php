<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        		'name' 		=> 'Oliver',
        		'email' 	=> 'vazquezoliver@gmail.com',
        		'password' 	=> bcrypt('Spot1*2&'),
//       		'active' 	=> true,
//        		'role'		=> 'admin'
        	]);

        DB::table('users')->insert([
        		'name' 		=> 'Raul',
        		'email' 	=> 'raulje07@hotmail.com',
        		'password' 	=> bcrypt('Spot1*2&'),
//        		'active' 	=> true,
//        		'role'		=> 'admin'
        	]);

    }
}
