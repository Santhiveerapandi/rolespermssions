<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';//RouteServiceProvider::HOME;
    
    //Login security constraints
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1

   /*  public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 1:
                $this->redirectTo= '/admin';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo= '/clientsprofile/'.Auth::user()->id;
                return $this->redirectTo;
                break;
            case 3:
                $this->redirectTo= '/userprofile/'.Auth::user()->id;
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo= '/login';
                return $this->redirectTo;
                break;
        }
    } */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /* Finally, how do we fill them in?
    You need to know that there is authenticated() method
    in the AuthenticatesUsers trait. It’s called every time someone logs in.
    */
    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
}
