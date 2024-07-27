<?php

namespace App\Http\Controllers;

use App\Enums\BuildingTypeEnum;
use App\Http\Requests\BuildingRequest;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\EnumResource;
use App\Http\Resources\UserResource;
use App\Models\Building;
use App\Models\User;

class BuildingController extends Controller
{
    public function index()
    {
        $this->ifAuthorized('building.index');
        $buildings = BuildingResource::collection(Building::with('user')->latest()->paginate(10))->resource;

        return inertia('Building/Index', compact('buildings'));
    }


    public function create()
    {
        $this->ifAuthorized('building.create');
        $types = EnumResource::collection(BuildingTypeEnum::cases());
        $users = UserResource::collection(User::latest()->get());

        return inertia('Building/Create', compact('types', 'users'));
    }

    public function store(BuildingRequest $request)
    {
        $this->ifAuthorized('building.create');
        Building::create($request->validated());

        return to_route('buildings.index')->with('success', __('Building has been created.'));
    }

    public function show(Building $building)
    {
        $this->ifAuthorized('building.index');
        $building = new BuildingResource($building->load('user'));

        return inertia('Building/Show', compact('building'));
    }

    public function edit(Building $building)
    {
        $this->ifAuthorized('building.edit');
        $types = EnumResource::collection(BuildingTypeEnum::cases());
        $building = new BuildingResource($building->load('user'));
        $users = UserResource::collection(User::latest()->get());

        return inertia('Building/Edit', compact(['building', 'types', 'users']));
    }

    public function update(BuildingRequest $request, Building $building)
    {
        $this->ifAuthorized('building.edit');
        $building->update($request->validated());

        return to_route('buildings.index')->with('success', __('Building has been updated.'));
    }

    public function destroy(Building $building)
    {
        $this->ifAuthorized('building.delete');
        $building->delete();

        return to_route('buildings.index')->with('success', __('Building has been deleted.'));
    }
}
