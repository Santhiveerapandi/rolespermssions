<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Validator;

class AdminController extends Controller
{
    public function permissionDenied()
    {
        return view('admin.permission-denied');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminuser=Auth::user();
        $roles=[];
        $user=User::all()->where('id', "<>", $adminuser->id);
        foreach ($user as $u) {
            $roles[$u->id]=Role::find($u->role_id);
        }
        // dd($roles);
        return view('admin.index')->with([ 'users'=>$user, 'roles'=>$roles ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles      = Role::all();
        if (!is_null($roles)) {
            $roles_ar   = RoleResource::collection($roles);
            $r['']="Select Role";
            foreach ($roles_ar as $u) {
                $r[$u['id']]=$u['name'];
            }
        } else {
            $r=[];
        }
        
        return view('admin.create')->with(['roles'=> $r]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();//(['_token']);
        $validator = Validator::make($input, User::$rules, User::$rules_messages);
        if ($validator->fails()) {
            return redirect("admin/create")
                            ->withErrors($validator)
                            ->withInput();
        }
        if ($request->hasFile('avatar')) {
            unset($input['_token']);
            User::uploadAvatar($request->avatar, $input);
            return redirect()->route('admin.index')->with('status', 'User created successfully');
        } else {
            $user = User::create($input);
            return redirect()->route('admin.index')->with('status', 'User created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles=Role::all();
        $user=User::find($id);
        return view('admin.edit')->with(['request'=>$id, 'roles'=> $roles, 'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input=$request->except(['_method', '_token', 'submit']);
        $validator = Validator::make($input, ['role_id'=>'required']);
        if ($validator->fails()) {
            //  dd($validator->errors());
            return redirect("admin/$id/edit")
                            ->withErrors($validator->errors())
                            ->withInput();
            //Ajax method of form submission.
            // return $this->sendError('Validation Errors', [$validator->errors()], 201);
        }
        // $this->authorization($input);
        $user = User::where('id', $input['id'])->update($input);
        return redirect()->route('admin.index')->with('status', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        // dd($admin, $admin->id);
        User::deleteImage($admin->id);
        $admin->delete();
        return redirect(route('admin.index'))->with(['status'=> 'User Deleted Successfully.']);
    }
}
