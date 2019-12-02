<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     
}
