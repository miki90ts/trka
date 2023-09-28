<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Enums\Gender;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\{User, Country, Profile, ShirtSize};
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Resources\{UserResource, CountryResource, GenderResource, ShirtSizeResource};

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
            'user' => UserResource::make(User::with('profile')->findOrFail(auth()->user()->id)),
            'countries' => CountryResource::collection(Country::all()),
            'genders' => GenderResource::collection(Gender::cases()),
            'shirtSizes' => ShirtSizeResource::collection(ShirtSize::all()),
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

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        //dd($request);
        //        'phone' => $request->phone,
        //     'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),

        Profile::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'user_id' => $request->user()->id,
                'gender' => $request->input('gender'),
                'birthday' => Carbon::parse($request->birthday)->format('Y-m-d'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('postal_code'),
                'country_id' => $request->input('country_id'),
                'club' => $request->input('club'),
                'shirt_size_id' => $request->input('shirt_size_id'),
                'emergency_phone' => $request->input('emergency_phone'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]
        );

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
