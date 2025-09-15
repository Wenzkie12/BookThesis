<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
   public function index(Request $request)
{
    $users = QueryBuilder::for(User::class)
        ->with('roles')
        ->allowedFilters([
            AllowedFilter::scope('search'),
        ])
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })
        ->paginate(10)
        ->appends($request->query());

    return view('admin.users.index', compact('users'));
}


    public function edit(User $user)
{
    $roles = Role::all();
    $userRoles = $user->roles->pluck('name')->toArray(); 
    return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
}

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'roles' => 'array|nullable'
    ]);

   
    if ($request->has('roles')) {
        $user->syncRoles($request->roles);
    } else {
        $user->syncRoles([]);
    }

    return redirect()->route('admin.users.index')->with('success', 'User roles updated.');
}



    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function show(User $user)
{
    return view('admin.users.show', compact('user'));
}

}
