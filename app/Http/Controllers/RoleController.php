<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'Desc')->paginate(10);

        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:50|unique:roles,name',
            'slug'        => 'required|max:50|unique:roles,slug',
            'full-access' => 'required|in:yes,no'
        ]);

        $role = Role::create($request->all());

        // if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        // }

        return redirect()->route('role.index')
                ->with('status_success', 'Role Saved successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions_role = [];

        foreach ($role->permissions as $permission) {
            $permissions_role[] = $permission->id;
        }
        
        $permissions = Permission::get();
        return view('role.view', compact('permissions', 'role', 'permissions_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions_role = [];

        foreach ($role->permissions as $permission) {
            $permissions_role[] = $permission->id;
        }
        
        $permissions = Permission::get();
        return view('role.edit', compact('permissions', 'role', 'permissions_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'        => 'required|max:50|unique:roles,name,'.$role->id,
            'slug'        => 'required|max:50|unique:roles,slug,'.$role->id,
            'full-access' => 'required|in:yes,no'
        ]);

        $role->update($request->all());

        // if ($request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        // }

        return redirect()->route('role.index')
                ->with('status_success', 'Role update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')
                ->with('status_success', 'Role successfully removed');
    }
}
