<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserProfileController extends Controller
{
    public function show(){
        $user= Auth::user();

        $profile=$user->profile ?? Profile::class::create(['user_id'=>$user->id]);

        return view ('userprofile.show', compact('user','profile'));
    }

     public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('userprofile.edit', compact('user', 'profile'));
    }

  public function update(UpdateProfileRequest $request)
{
    $user = Auth::user();
    $profile = $user->profile;
    $data = $request->validated();

    try {

        $province = Http::withoutVerifying()->get("https://psgc.gitlab.io/api/provinces/{$data['province']}")->json();
        $city = Http::withoutVerifying()->get("https://psgc.gitlab.io/api/cities-municipalities/{$data['city']}")->json();
        $barangay = Http::withoutVerifying()->get("https://psgc.gitlab.io/api/barangays/{$data['barangay']}")->json();

        $data['province'] = $province['name'] ?? $data['province'];
        $data['city'] = $city['name'] ?? $data['city'];
        $data['barangay'] = $barangay['name'] ?? $data['barangay'];
    } catch (\Exception $e) {
    
    }

    if ($request->hasFile('avatar')) {
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $profile->update($data);

    return redirect()->route('userprofile.show')->with('success', 'Profile updated successfully.');
}
}
