<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        'name', 'email', 'password', 'avatar', 'role_id', 'last_login_at',
        'last_login_ip'
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
    
    //User Creation rules
    public static $rules = [
        'name'=> ['required', 'string', 'max:191', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
        'avatar' => ['mimes:jpeg,bmp,png'],
        'password' => ['required', 'string', 'min:8', 'max:15'],
        'confirm-password' => ['required', 'string', 'min:8', 'max:15', 'same:password'],
        'role_id'=> ['required']
    ];
    public static $rules_messages = [
        'name.required' => 'A Name is required',
        'email.required'  => 'A Email Address is required',
        'email.email' => 'Given Email Address is Invalid',
        'email.unique' => 'Given Email Address Already taken',
        'email.max:191' =>'Given Email Address Maximum 191 characters only allowed',
        'avatar.mimes' => 'Photo File Must be jpg or png',
        'password.required'  => 'A Password is required',
        'password.min' => 'Password Minimum 8 digits',
        'password.max' => 'Password Minimum 15 digits',
        'confirm-password.required'  => 'A Confirm Password is required',
        'confirm-password.min' => 'A Confirm Password Minimum 8 digits',
        'confirm-password.max' => 'A Confirm Password Minimum 15 digits',
        'confirm-password.same:password'  => 'A Confirm Password  and Password should be same',
        'role_id.required' => 'A Role is required',
    ];

/*  public static $rules = [
        'name' => 'required|string|max:191',
        'email' => 'required|email|string|unique:users|max:191',
        'password' => 'required|string|max:20',
        'c_password' => 'required|string|same:password|max:20'
    ]; */

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

    public static function uploadAvatar($image, $create = null)
    {
        $filename = $image->getClientOriginalName();
        (isset($create['name']))? null: (new self())->deleteOldImage();
        $create['avatar'] = $filename;
        //store new file
        $image->storeAs('images', $filename, 'public');
        // dd($create);
        if (!isset($create['name'])) {
            $id=Auth::user()->id;
            User::where('id', $id)->update(['avatar'=>$filename]);
        } else {
            (new self())::create($create);
        }
    }

    protected function deleteOldImage()
    {
        //Delete existing profile image file
        if (Auth::user()->avatar) {
            Storage::delete('/public/images/'.Auth::user()->avatar);
        }
    }

    public static function deleteImage($id)
    {
        $avt=User::find($id)->avatar;
        if ($avt) {
            Storage::delete('/public/images/'.$avt);
        }
    }

    public function createToken($var)
    {
        $this->accessToken= Hash::make($var);
        return ["accessToken"=>$this->accessToken];
    }

    //Accessor & Mutator Concept
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getNameAttribute()
    {
        return ucfirst($this->attributes['name']);
    }
    //Relationship Concept
    public function todos()
    {
        return $this->hasMany('App\Todo');
    }

    //Still pending to relate the roles table with user model
    /* public function roles()
    {
        return $this->belongsToMany('Spatie\Permission\Models\Role');
    } */
}
