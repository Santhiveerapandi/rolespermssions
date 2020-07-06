<?php

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;

// use App\University;

// use App\Http\Requests\RegisterRequest;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) //RegisterRequest $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, User::$rules);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 201);
        }
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    public function loginuniversity(Request $request)
    {
        $login=$request->only(['email', 'password']);
        $validator = Validator::make($login, University::$loginrules);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $university=University::where("email", $login['email'])->first();
        if ($university && Hash::check($login['password'], $university->password)) {
            //Auth::attempt($login)
            // dd($university);
            $user = University::find($university->id);//Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['user_type']= 'university';
            $success['eastablished']= $user->established;
            University::where('id', $user->id)->update([
                'api_token'=>$success['token'],
                // 'remmeber_token'=>$success['token'],
                'last_login'=> date('Y-m-d H:i:s')
                ]);
            return $this->sendResponse($success, 'University admin login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // $login = $request->validate(User::$loginrules);
        $login=$request->only(['email', 'password']);
        $validator = Validator::make($login, User::$loginrules);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        if (Auth::attempt($login)) {
            $user = Auth::user();
            // $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['token'] = $user->createToken('MyApp')["accessToken"];
            $success['name']  =  $user->name;
            $success['email'] =  $user->email;
            User::where('id', $user->id)->update([
                'api_token'=>$success['token']
                ]);
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
