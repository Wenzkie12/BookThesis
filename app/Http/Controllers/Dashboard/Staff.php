<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class Staff extends Controller
{
    public function index()
    {
        $toClaim = Reservation::where('status', 'to_claim')
            ->with(['user', 'book'])
            ->orderBy('pickup_date', 'asc')
            ->get();
            
        $toReturn = Reservation::where('status', 'to_return')
            ->with(['user', 'book'])
            ->orderBy('due_date', 'asc')
            ->get();
            
        return view('staff.dashboard', compact('toClaim', 'toReturn'));
    }
}