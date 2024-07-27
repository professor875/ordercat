<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->ifAuthorized('role.index');
        $roles = RoleResource::collection(Role::excludePermanentRoles()->latest()->paginate(10))->resource;

        return inertia('Role/Index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ifAuthorized('role.create');
        $permissions = PermissionResource::collection(Permission::latest()->get());

        return inertia('Role/Create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $this->ifAuthorized('role.create');
        $role = Role::create($request->only('name') + ['guard_name' => 'web']);
        $role->givePermissionTo($request->permissions);

        return to_route('roles.index')->with('success', __('Role has been created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->ifAuthorized('role.index');
        abort_if(in_array($role->name, Role::permanentRoles), 404);
        $role = new RoleResource($role->load('permissions'));

        return inertia('Role/Show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->ifAuthorized('role.edit');
        $role = new RoleResource(Role::excludePermanentRoles()->with('permissions')->find($role->id));
        $permissions = PermissionResource::collection(Permission::latest()->get());

        return inertia('Role/Edit', compact(['role', 'permissions']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->ifAuthorized('role.edit');
        $role->update($request->only('name')+['guard_name' => 'web']);
        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', __('Role has been updated.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->ifAuthorized('role.delete');
        Role::excludePermanentRoles()->find($role->id)->delete();

        return to_route('roles.index')->with('success', 'Role has been deleted.');
    }
}
