<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table    = "todos";
    // protected $guarded  = [];
    protected $fillable = ['title', 'description', 'user_id', 'completed'];

    /* These Validation rules are move to Request of TodoCreateRequest Class
    (pa make:request TodoCreateRequest)
    public static $rules= ['title' => 'required|min:5|max:255'];
    public static $msg  = [
        'title.required' => 'Todo is Required',
        'title.min'=> 'Todo Must be atleast 5 characters',
        'title.max'=> 'Todo allowed only 255 characters'
    ]; */

    /* If need to Route Model Binding with Name of field
    public function getRouteKeyName()
    {
        return 'title';
    } */

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
