<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SessionExercise extends Model
{
    /**
     * The attributes that is table name.
     *
     * @var array
     */
    protected $table = 'session_exercises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'session_id', 'score',
    ];

    /**
     * Relationship with Category
     *     
     * @return object
     */
    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    /**
     * Relationship with Course Session
     *     
     * @return object
     */
    public function sessions()
    {
        return $this->belongsTo('App\Models\CourseSession','sessions_id', 'id');
    }

    /**
     * A function to  user sessions     
     * @param $user integer
     * @param $skipSession integer 0
     * @param $takeSession integer 12

     * @return objects array
     */
    public function getExercisesByUserId($userId, $skipSession = 0, $takeSession = 12)
    {
        $exercises = $this
                ->join('categories as ca', 'ca.id', '=', 'session_exercises.category_id')

                /* 
                `where` condition can be used like below if mysql version support keyword `limit` in subquery
                    ->whereIn('session_exercises.session_id', function($query) use($userId){
                        $query->select('*')
                            ->from('course_sessions')
                            ->where('user_id', $userId)
                            ->latest()
                            ->limit($skipSession);
                    })
                */

                ->whereRaw("`session_exercises`.`session_id` IN (SELECT `id` FROM (SELECT `id` FROM `course_sessions` WHERE `user_id` = $userId order by `created_at` DESC limit $skipSession, $takeSession) latest_ids)")
                ->groupBy('session_exercises.category_id')
                ->selectRaw('ca.name, SUM(session_exercises.score) AS score')
                ->get();
        return $exercises; 
    } 

    /**
     * A function to user latest exercise(s)     
     * @param $$userId integer
     * @param $take integer 1
     *
     * @return objects array
     */
    public function getLatestExercisesByUserId($userId, $take = 1)
    {
        // $exercises = DB::table('course_sessions as cse')
        //             ->join('session_exercises as see', 'see.id', '=', DB::raw('(SELECT `id` FROM `session_exercises` WHERE `session_exercises`.`session_id` = `cse`.`id` ORDER BY `session_exercises`.`created_at` DESC, `session_exercises`.`id` DESC LIMIT 1)'))
        //             ->join('categories as ca', 'ca.id', '=', 'see.category_id')
        //             ->where('cse.user_id', $userId)
        //             ->orderBy('see.created_at', 'DESC')
        //             ->selectRaw('see.*, ca.name as category_name')
        //             ->limit($take)
        //             ->get();

        $exercises = DB::table('course_sessions as cse')
                    ->join('session_exercises as see', 'see.session_id', '=', 'cse.id')
                    ->join('categories as ca', 'ca.id', '=', 'see.category_id')
                    ->where('cse.user_id', $userId)
                    ->orderBy('see.created_at', 'DESC')
                    ->orderBy('see.id', 'DESC')
                    ->selectRaw('see.*, ca.name as category_name')
                    ->limit($take)
                    ->get();

        return $exercises; 
    }   
     
}
