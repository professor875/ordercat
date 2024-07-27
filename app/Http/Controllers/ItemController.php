<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\ItemStoreRequest;
use App\Http\Requests\Item\ItemUpdateRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->ifAuthorized('item.index');
        $items = ItemResource::collection(Item::latest()->paginate(10))->resource;

        return inertia('Item/Index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ifAuthorized('item.create');
        $days = config('constants.days');
        $types = config('constants.itemTypes');

        return inertia('Item/Create', compact(['days', 'types']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $request)
    {
        $this->ifAuthorized('item.create');
        Item::create($request->validated());

        return to_route('items.index')->with('success', __('Item has been created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $this->ifAuthorized('item.index');
        $item = new ItemResource($item);

        return inertia('Item/Show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $this->ifAuthorized('item.edit');
        $item = new ItemResource($item);
        $days = config('constants.days');
        $types = config('constants.itemTypes');

        return inertia('Item/Edit', compact(['item', 'days', 'types']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Item $item,ItemUpdateRequest $request)
    {
        $this->ifAuthorized('item.edit');
        $item->update($request->validated());

        return to_route('items.index')->with('success', __('Item has been updated.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->ifAuthorized('item.delete');
        $item->delete();

        return to_route('items.index')->with('success', 'Item has been deleted.');
    }
}
