<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'student_id' => ['required', 'string', 'max:50', 'unique:users,student_id'],
        'department_id' => ['required', 'exists:departments,id'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'student_id' => $request->student_id,
        'department_id' => $request->department_id,
        'password' => Hash::make($request->password),
    ]);

    $user->assignRole('user');

    $profile = new Profile();
    $profile->user_id = $user->id;
    $profile->phone = null;
    $profile->age = null;
    $profile->bio = null;
    $profile->avatar = null;
    $profile->birthdate = null;
    $profile->province = null;
    $profile->city = null;
    $profile->barangay = null;
    $profile->penalty = 0.00;
    $profile->save();

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}

}
