<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManager extends BaseController
{
    public function data()
    {
        $all_users_with_all_their_roles = User::with('roles')->get();
        $all_users_with_all_direct_permissions = User::with('permissions')->get();
        $all_roles_in_database = Role::all()->pluck('name');
        $users_without_any_roles = User::doesntHave('roles')->get();
        dd($all_users_with_all_their_roles);
    }
    

    public function permissionsIndex()
    {
        // dd("test", Permission::all());
        return Permission::all()->paginate(100);
    }

    public function rolesIndex()
    {
        return Role::all()->paginate(100);
    }

    public function rolesAddUser(Request $request, Role $role, User $user)
    {
        $user->assignRole($role);
        return response()->json(
            [
                "message" => $role->name." Role successfully assigned to User!"
            ],
            200
        );
    }

    public function rolesRemoveUser()
    {
        $user->removeRole($role);
        return response()->json(
            [
                "message" => $role->name." Role successfully removed from User!"
            ],
            200
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
