<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    //attributes
    protected $fillable = ['title',
        'description',
        'due_date'];

    public function priority()
    {
        return $this->belongsTo('App\Priorities');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_tasks', 'user_id', 'task_id');
    }
}
