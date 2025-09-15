<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function index()
    {
        $user = Auth::user();

      
        $toClaim = Reservation::where('status', 'to_claim')
            ->where('user_id', $user->id)
            ->with('book')
            ->orderBy('pickup_date', 'asc')
            ->get();

        $toReturn = Reservation::where('status', 'to_return')
            ->where('user_id', $user->id)
            ->with('book')
            ->orderBy('due_date', 'asc')
            ->get();

        return view('dashboard', compact('toClaim', 'toReturn'));
    }
}
