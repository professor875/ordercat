<?php

namespace App\Http\Controllers;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Http\Resources\ContactResource;
use App\Http\Resources\EnumResource;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $this->ifAuthorized('contact.index');
        $contacts = ContactResource::collection(Contact::latest()->paginate(10))->resource;

        return inertia('Contact/Index', compact('contacts'));
    }

    public function create()
    {
        $this->ifAuthorized('contact.create');
        $types = EnumResource::collection(ContactTypeEnum::cases());
        $contact_channel = EnumResource::collection(ContactChannelEnum::cases());

        return inertia('Contact/Create', compact('types','contact_channel'));
    }

    public function store(ContactStoreRequest $request)
    {
        $this->ifAuthorized('contact.create');
        if(in_array($request->contact_channel, [ContactChannelEnum::whatsapp->value, ContactChannelEnum::sms->value, ContactChannelEnum::phone->value])){
            return back()->with('error', __('This Contact Channel feature is not available.'));
        }
        Contact::create($request->validated());

        return to_route('contacts.index')->with('success', __('Contact has been created.'));

    }

    public function show(Contact $contact)
    {
        $this->ifAuthorized('contact.index');
        $contact = new ContactResource($contact);

        return inertia('Contact/Show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $this->ifAuthorized('contact.edit');
        $contact = new ContactResource($contact);
        $types = EnumResource::collection(ContactTypeEnum::cases());
        $contact_channel = EnumResource::collection(ContactChannelEnum::cases());

        return inertia('Contact/Edit', compact(['contact', 'types','contact_channel']));
    }

    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $this->ifAuthorized('contact.edit');
        if(in_array($request->contact_channel, [ContactChannelEnum::whatsapp->value, ContactChannelEnum::sms->value, ContactChannelEnum::phone->value])){
            return back()->with('error', __('This Contact Channel feature is not available.'));
        }
        $contact->update($request->validated());

        return to_route('contacts.index')->with('success', __('Contact has been updated.'));
    }

    public function destroy(Contact $contact)
    {
        $this->ifAuthorized('contact.delete');
        $contact->delete();

        return to_route('contacts.index')->with('success', 'Contact has been deleted.');
    }
}
