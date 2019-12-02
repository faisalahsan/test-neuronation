<?php

use Illuminate\Database\Seeder;

class CourseSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\CourseSession::truncate();  
     
        for ($i=1; $i < 9; $i++) { 
            DB::table('course_sessions')->insert([ 
                    'course_id' => $i, 
                    'user_id' => rand(1, 100),
                    'score' => rand(0, 100), 
                    'created_at' => now(), 
                    'updated_at' => now(),
                ]);
       }
    }
}
