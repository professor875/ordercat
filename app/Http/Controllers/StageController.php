<?php

namespace App\Http\Controllers;

use App\Enums\ContactChannelEnum;
use App\Http\Requests\StageRequest;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\KitchenResource;
use App\Http\Resources\StageResource;
use App\Http\Resources\UserResource;
use App\Mail\BuildingRatingMail;
use App\Mail\KitchenRatingMail;
use App\Models\Building;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Kitchen;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class StageController extends Controller
{
    public function index()
    {
        $this->ifAuthorized('stage.index');
        $stages = StageResource::collection(Stage::with(['createdBy', 'orderedFrom', 'orderedFor', 'deliveredBy', 'handedTo'])->latest()->paginate(10))->resource;

        return inertia('Stage/Index', compact('stages'));
    }

    public function create()
    {
        $this->ifAuthorized('stage.create');
        $contacts = ContactResource::collection(Contact::latest()->get());
        $buildings = BuildingResource::collection(Building::latest()->get());
        $kitchens = KitchenResource::collection(Kitchen::latest()->get());
        $items = ItemResource::collection(Item::latest()->get());
        $days = config('constants.days');
        $itemTypes = config('constants.itemTypes');

        return inertia('Stage/Create', compact(['contacts', 'buildings', 'kitchens', 'items', 'days', 'itemTypes']));
    }

    public function store(StageRequest $request)
    {
        $this->ifAuthorized('stage.create');
        $stage = Stage::create($request->safe()->except('items') + [
                'created_by_id' => $request->user()->id,
                'delivered_to_id' => $request->ordered_for_id,
                'started_at' => now(),
            ]);

        $itemsAttachablePayload = [];

        foreach ($request->items as $item) {
            $itemsAttachablePayload[$item['id']] = ['quantity' => $item['quantity']];
        }

        $stage->items()->attach($itemsAttachablePayload);

        return to_route('stages.index')->with('success', __('Stage has been created.'));
    }

    public function show(Stage $stage)
    {
        $rating = config('constants.rating');
        $this->ifAuthorized('stage.index');
        $stage = new StageResource($stage->load(['items', 'createdBy', 'orderedFrom', 'orderedFor', 'deliveredBy', 'handedTo']));

        $deliveredByAble = $this->getDeliveredByAble();
        $handedToAble = $this->getHandedToAble();

        return inertia('Stage/Show', compact(['stage', 'deliveredByAble', 'handedToAble', 'rating']));
    }

    public function edit(Stage $stage)
    {
        $this->ifAuthorized('stage.edit');
        $stage = new StageResource($stage->load(['items', 'createdBy', 'orderedFrom', 'orderedFor']));
        $contacts = ContactResource::collection(Contact::latest()->get());
        $buildings = BuildingResource::collection(Building::latest()->get());
        $kitchens = KitchenResource::collection(Kitchen::latest()->get());
        $items = ItemResource::collection(Item::latest()->get());

        return inertia('Stage/Edit', compact(['stage', 'contacts', 'buildings', 'kitchens', 'items']));
    }

    public function update(StageRequest $request, Stage $stage)
    {
        $this->ifAuthorized('stage.edit');
        $stage->update($request->safe()->except('items') + [
                'delivered_to_id' => $request->ordered_for_id,
            ]);

        $itemsAttachablePayload = [];

        foreach ($request->items as $item) {
            $itemsAttachablePayload[$item['id']] = ['quantity' => $item['quantity']];
        }

        $stage->items()->sync($itemsAttachablePayload);

        return to_route('stages.index')->with('success', __('Stage has been updated.'));
    }

    public function destroy(Stage $stage)
    {
        $this->ifAuthorized('stage.delete');
        $stage->delete();

        return to_route('stages.index')->with('success', 'Stage has been deleted.');
    }

    public function assignCookedAt(Request $request, Stage $stage)
    {
        $this->ifAuthorized('stage.cooked');
        $request->validate([
            'cooked_at' => 'required',
        ]);

        $stage->update($request->only('cooked_at') + ['status' => config('constants.stageStatuses.cooked')]);

        return back()->with('success', 'Cooked time has been updated.');
    }

    public function assignPackagingAt(Request $request, Stage $stage)
    {
        $this->ifAuthorized('stage.packaging');
        $request->validate([
            'packaging_at' => 'required',
        ]);

        $stage->update($request->only('packaging_at') + ['status' => config('constants.stageStatuses.packaging')]);

        return back()->with('success', 'Packaging time has been updated.');
    }

    public function assignDeliveredBy(Request $request, Stage $stage)
    {
        $this->ifAuthorized('stage.delivery');
        $table = $this->getDeliveredByTable();
        $request->validate([
            'delivered_by_id' => "required|numeric|exists:$table,id",
        ]);

        $stage->update($request->only('delivered_by_id') + [
                'status' => config('constants.stageStatuses.delivery'),
                'delivered_by_type' => config('constants.deliveredByAble'),
            ]);

        return back()->with('success', 'Delivery boy has been assigned.');
    }

    public function assignDeliveredAt(Request $request, Stage $stage)
    {
        $this->ifAuthorized('stage.delivery');
        $request->validate([
            'delivered_at' => 'required',
        ]);

        $stage->update($request->only('delivered_at') + ['status' => config('constants.stageStatuses.delivery')]);

        return back()->with('success', 'Delivered time has been assigned.');
    }

    public function assignHandedTo(Request $request, Stage $stage)
    {
        $this->ifAuthorized('stage.handed');
        $table = $this->getHandedToTable();
        $request->validate([
            'handed_to_id' => "required|numeric|exists:$table,id",
        ]);

        $stage->update($request->only('handed_to_id') + [
                'handed_at' => now(),
                'status' => config('constants.stageStatuses.handed'),
                'handed_to_type' => config('constants.handedToAble'),
            ]);

        return back()->with('success', 'Handed to has been assigned.');
    }

    public function updateRating(Request $request, Stage $stage)
    {
        $this->ifAuthorized('stage.rating');
        $request->validate([
            'delivery_rating' => ['required', 'string', Rule::in(config('constants.rating'))],
            'kitchen_rating' => ['required', 'string', Rule::in(config('constants.rating'))],
            'employees_rating' => ['required', 'string', Rule::in(config('constants.rating'))],
            'instruments_rating' => ['required', 'string', Rule::in(config('constants.rating'))]
        ]);

        $stage->update($request->only(['delivery_rating', 'kitchen_rating', 'employees_rating', 'instruments_rating']) + ['status' => config('constants.stageStatuses.rating')]);

        $this->sendRatingMails(stage:$stage);

        return back()->with('success', 'Kitchen & Delivery rating has been assigned.');
    }

    private function getDeliveredByAble()
    {
        if (config('constants.deliveredByAble') == Contact::class) {
            return ContactResource::collection(Contact::latest()->get());
        } else {
            return UserResource::collection(User::latest()->get());
        }
    }

    private function getHandedToAble()
    {
        if (config('constants.handedToAble') == Contact::class) {
            return ContactResource::collection(Contact::latest()->get());
        } else {
            return UserResource::collection(User::latest()->get());
        }
    }

    private function getDeliveredByTable(): string
    {
        $class = config('constants.deliveredByAble');
        return (new $class)->getTable();
    }

    private function getHandedToTable(): string
    {
        $class = config('constants.handedToAble');
        return (new $class)->getTable();
    }

    private function sendRatingMails(Stage $stage): void
    {
        if ($stage->orderedFrom->user->contact_channel->value == ContactChannelEnum::email->value) {
            Mail::to($stage->orderedFrom->user)->send(new KitchenRatingMail(stage: $stage, actor: auth()->user()));
        }

        if ($stage->orderedFor->user->contact_channel->value == ContactChannelEnum::email->value) {
            Mail::to($stage->orderedFor->user)->send(new BuildingRatingMail(stage: $stage, actor: auth()->user()));
        }
    }
}
