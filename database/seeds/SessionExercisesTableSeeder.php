<?php

use Illuminate\Database\Seeder;

class SessionExercisesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	App\Models\SessionExercise::truncate();  
        
    	factory(App\Models\SessionExercise::class, 2000)->create();
    }
}
