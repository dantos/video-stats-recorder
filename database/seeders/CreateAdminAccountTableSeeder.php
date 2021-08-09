<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateAdminAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    if (!User::whereEmail('admin@videostats.com')->first()) {
		    User::create([
			    'name' => 'Administrator',
			    'email' => 'admin@videostats.com',
			    'email_verified_at' => now(),
			    'password' => \Hash::make('video@stats2021'),
			    'role' => 'admin',
			    'remember_token' => Str::random(10),
		    ]);
	    }

	    User::create([
		    'name' => 'Guest',
		    'email' => 'guest@videostats.com',
		    'email_verified_at' => now(),
		    'password' => \Hash::make('guest@stats2021'),
		    'role' => 'guest',
		    'remember_token' => Str::random(10),
	    ]);
    }
}
