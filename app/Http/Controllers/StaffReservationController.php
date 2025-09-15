<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffReservationController extends Controller
{
    public function index(Request $request)
{
    $status = $request->get('tab', 'to_claim');

    $reservations = Reservation::with('book', 'user', 'claimedBy', 'returnedBy')
        ->where('status', $status)
        ->latest()
        ->paginate(6)
        ->appends(['tab' => $status]);

    return view('staff.reservations.index', compact('reservations', 'status'));
}


    public function claim(Reservation $reservation)
{
    if ($reservation->status !== 'to_claim') {
        abort(403, 'Reservation is not eligible to be claimed.');
    }

    $reservation->update([
        'status' => 'to_return',
        'claimed_at' => now(),
        'due_date' => now()->addDay(),
        'initial_duedate' => now()->addDay(),
        'claimed_by' => Auth::id(),
    ]);

    return back()->with('success', 'Book marked as claimed.');
}


    public function complete(Reservation $reservation)
{
    if ($reservation->status !== 'to_return') {
        abort(403, 'Reservation is not eligible to be returned.');
    }

    if ($reservation->lost_declared && $reservation->lost_status === 'pending') {
        abort(403, 'Lost declaration is still pending.');
    }

    $reservation->update([
        'status' => 'completed',
        'completed_at' => now(),
        'returned_by' => Auth::id(),
    ]);

    $reservation->book->increment('quantity');

    return back()->with('success', 'Book marked as returned.');
}


  public function acceptLost(Reservation $reservation)
{
    if (
        $reservation->status !== 'to_return' ||
        !$reservation->lost_declared ||
        $reservation->lost_status !== 'pending'
    ) {
        abort(403);
    }

    $reservation->update([
        'status' => 'lost',
        'lost_status' => 'accepted',
    ]);

    $profile = $reservation->user->profile;
    $penaltyType = \App\Models\PenaltyType::where('name', 'Lost Book')->first();
    $now = now();

    if ($profile && $penaltyType) {
        $profile->increment('penalty', $penaltyType->amount);

        Penalty::create([
            'profile_id' => $profile->id,
            'book_id' => $reservation->book_id,
            'amount' => $penaltyType->amount,
            'applied_at' => $now,
            'penalty_type_id' => $penaltyType->id,
        ]);
    }

    return back()->with('success', 'Lost declaration accepted.');
}




    public function denyLost(Reservation $reservation)
    {
        if (
            $reservation->status !== 'to_return' ||
            !$reservation->lost_declared ||
            $reservation->lost_status !== 'pending'
        ) {
            abort(403, 'Reservation is not eligible for lost denial.');
        }

        $reservation->update([
            'lost_declared' => false,
            'lost_status' => 'denied',
        ]);

        return back()->with('success', 'Lost declaration denied.');
    }
}
