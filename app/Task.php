<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =['name', 'user_id', 'todo_id'];
    
    public function todos()
    {
        return $this->belongsTo('App\Todo');
    }
}
