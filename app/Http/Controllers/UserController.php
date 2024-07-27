<?php

namespace App\Http\Controllers;

use App\Enums\ContactChannelEnum;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\EnumResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use http\Encoding\Stream\Deflate;

class UserController extends Controller
{
    public function index()
    {
        $this->ifAuthorized('user.index');
        $users = UserResource::collection(User::with('roles')->latest()->paginate(10))->resource;

        return inertia('User/Index', compact('users'));
    }

    public function create()
    {
        $this->ifAuthorized('user.create');
        $contact_channel = EnumResource::collection(ContactChannelEnum::cases());
        $roles = Role::excludePermanentRoles()->latest()->pluck('name');

        return inertia('User/Create', compact('contact_channel', 'roles'));
    }

    public function store(UserStoreRequest $request)
    {
        $this->ifAuthorized('user.create');
        if(in_array($request->contact_channel, [ContactChannelEnum::whatsapp->value, ContactChannelEnum::sms->value, ContactChannelEnum::phone->value])){
            return back()->with('error', __('This Contact Channel feature is not available.'));
        }
        $user = User::create($request->validated());

        $user->assignRole($request->roles);

        return to_route('users.index')->with('success', __('User has been created.'));
    }

    public function show(User $user)
    {
        $this->ifAuthorized('user.index');
        $user = new UserResource($user->load('roles'));

        return inertia('User/Show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->ifAuthorized('user.edit');
        $user = new UserResource($user->load('roles'));
        $roles = Role::excludePermanentRoles()->pluck('name');
        $contact_channel = EnumResource::collection(ContactChannelEnum::cases());

        return inertia('User/Edit', compact(['user','contact_channel','roles']));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->ifAuthorized('user.edit');
        if(in_array($request->contact_channel, [ContactChannelEnum::whatsapp->value, ContactChannelEnum::sms->value, ContactChannelEnum::phone->value])){
            return back()->with('error', __('This Contact Channel feature is not available.'));
        }
        $user->update($request->validated());
        $user->syncRoles($request->roles);

        return to_route('users.index')->with('success', __('User has been updated.'));
    }

    public function destroy(User $user)
    {
        $this->ifAuthorized('user.delete');
        $user->delete();

        return to_route('users.index')->with('success', 'User has been deleted.');
    }
}
