<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManager extends Controller
{
    public function permissionsIndex()
    {
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
