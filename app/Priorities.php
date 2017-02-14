<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priorities extends Model
{
    protected $table = 'priorities';

    //attributes
    protected $fillable = ['name'];

    //Relationships
    public function tasks()
    {
        return $this->hasMany('App\Task','priority_id');
    }
}
