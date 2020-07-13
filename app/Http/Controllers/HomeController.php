<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth'); //->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();
        $userDetails=User::find($user->id);
        return view('home')->with(['user'=>$userDetails]);
    }

    public function uploadAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            User::uploadAvatar($request->avatar);
            // $request->session()->flash();
            return redirect()->back()->with('status', 'Image Uploaded.');
        }
        // $request->session()->flash();
        return redirect()->back()->with('error', 'When Upload Error Occurs.');
    }

    /* protected function deleteOldImage()
    {
        //Delete existing profile image file
        if (Auth::user()->avatar) {
            Storage::delete('/public/images/'.Auth::user()->avatar);
        }
    } */
}
