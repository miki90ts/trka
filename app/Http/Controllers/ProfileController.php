<?php

namespace App\Http\Controllers;

use stdClass;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'profile' => $request->user()->profile ? ProfileResource::make($request->user()->profile) : new stdClass(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        //    'phone' => 'required|string|max:255',
        //     'birthday' => 'required|date',

        //        'phone' => $request->phone,
        //     'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {

        //        'phone' => $request->phone,
        //     'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),

        // Profile::updateOrCreate(
        //     ['user_id' => $id],
        //     [
        //         'address' => $request->input('address'),
        //         'phone' => $request->input('phone'),
        //     ]
        // );

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
