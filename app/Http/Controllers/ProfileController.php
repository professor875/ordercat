<?php

namespace App\Http\Controllers;

use App\Enums\ContactChannelEnum;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\EnumResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = new UserResource(auth()->user()->load('roles.permissions'));
        $contactChannels = EnumResource::collection(ContactChannelEnum::cases());

        return inertia('Profile/Index', compact(['user', 'contactChannels']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request)
    {
        if(in_array($request->contact_channel, [ContactChannelEnum::whatsapp->value, ContactChannelEnum::sms->value, ContactChannelEnum::phone->value])){
            return back()->with('error', __('This Contact Channel feature is not available.'));
        }

        auth()->user()->update($request->validated());

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed',
        ]);

        auth()->user()->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function updateDp(Request $request)
    {
        $request->validate([
            'dp' => 'required|file|mimetypes:image/*',
        ]);

        auth()->user()->addMediaFromRequest('dp')->toMediaCollection('dp');

        return back()->with('success', 'Profile picture updated successfully.');
    }
}
