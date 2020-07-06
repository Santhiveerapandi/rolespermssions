<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $accessToken;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public static $rules = [
        'name' => 'required|string|max:191',
        'email' => 'required|email|string|unique:users|max:191',
        'password' => 'required|string|max:20',
        'c_password' => 'required|string|same:password|max:20'
    ];

    public static $updaterules = [
        'name' => 'required|max:191',
        'first_name' => 'max:191',
        'last_name' => 'max:191',
        'full_name' => 'max:191',
        'email' => 'required|email|unique:users|max:191',
        'phone' => 'numeric|size:12'
    ];

    public static $loginrules = [
        'email' => 'required|email|string|max:191',
        'password' => 'required|string|max:20',
    ];

    public static $messages = [
        'name.required' => 'A Name is required',
        'email.required'  => 'A Email Address is required',
        'email.email' => 'Given Email Address is Invalid',
        'email.unique' => 'Given Email Address Already taken',
        'email.max:191' =>'Given Email Address Maximum 191 characters only allowed',
        'phone.numeric' => 'Phone Number Must be Numeric',
        'phone.size:12' => 'Phone Number Must be not more than 12 Digits',
        'password.required'  => 'A Password is required',
        'c_password.required'  => 'A Confirm Password is required',
        'c_password.same:password'  => 'A Confirm Password  and Password should be same',
    ];

    public function createToken($var)
    {
        $this->accessToken= Hash::make($var);
        return ["accessToken"=>$this->accessToken];
    }
}
