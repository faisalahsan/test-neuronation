<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    /**
     * The attributes that is table name.
     *
     * @var array
     */
    protected $table = 'course_sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'course_id', 'score', 'status',
    ];

    /**
     * Relationship with User     
     * @return object
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Relationship with Course     
     * @return object
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    /**
     * Relationship with SessionExercise
     *     
     * @return object
     */
    public function exercises()
    {
        return $this->hasMany('App\Models\SessionExercise', 'exercise_id', 'id');
    }
}
