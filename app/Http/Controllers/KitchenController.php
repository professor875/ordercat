<?php

namespace App\Http\Controllers;

use App\Http\Requests\KitchenRequest;
use App\Http\Resources\KitchenResource;
use App\Http\Resources\UserResource;
use App\Models\Kitchen;
use App\Models\User;

class KitchenController extends Controller
{
    public function index()
    {
        $this->ifAuthorized('kitchen.index');
        $kitchens = KitchenResource::collection(Kitchen::with('user')->latest()->paginate(10))->resource;

        return inertia('Kitchen/Index', compact('kitchens'));
    }

    public function create()
    {
        $this->ifAuthorized('kitchen.create');
        $users = UserResource::collection(User::latest()->get());

        return inertia('Kitchen/Create', compact('users'));
    }

    public function store(KitchenRequest $request)
    {
        $this->ifAuthorized('kitchen.create');
        Kitchen::create($request->validated());

        return to_route('kitchens.index')->with('success', __('Kitchen created successfully.'));
    }

    public function show(Kitchen $kitchen)
    {
        $this->ifAuthorized('kitchen.index');
        $kitchen = new KitchenResource($kitchen->load('user'));

        return inertia('Kitchen/Show', compact('kitchen'));
    }

    public function edit(Kitchen $kitchen)
    {
        $this->ifAuthorized('kitchen.edit');
        $kitchen = new KitchenResource($kitchen->load('user'));
        $users = UserResource::collection(User::latest()->get());

        return inertia('Kitchen/Edit', compact('kitchen', 'users'));
    }

    public function update(KitchenRequest $request, Kitchen $kitchen)
    {
        $this->ifAuthorized('kitchen.edit');
        $kitchen->update($request->validated());

        return to_route('kitchens.index')->with('success', __('Kitchen updated successfully.'));
    }

    public function destroy(Kitchen $kitchen)
    {
        $this->ifAuthorized('kitchen.delete');
        $kitchen->delete();

        return to_route('kitchens.index')->with('success', __('Kitchen deleted successfully.'));
    }
}
