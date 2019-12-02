<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	App\Models\User::truncate();  
        
    	factory(\App\Models\User::class, 100)->create();
    }
}
