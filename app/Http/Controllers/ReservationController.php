<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('book', 'claimedBy', 'returnedBy')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
if (Reservation::userCannotReserveDueToIncompleteProfile()) {
    return redirect()->route('userprofile.show')->with('error', 'Please complete your phone number and full address in your profile before making a reservation.');
}
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'pickup_date' => 'required|date|after_or_equal:today',
        ]);

        $activeCount = Reservation::where('user_id', Auth::id())
            ->whereIn('status', ['to_claim', 'to_return'])
            ->count();

        if ($activeCount >= 2) {
            return back()->with('error', 'You can only have a maximum of 2 active reservations.');
        }

        $existing = Reservation::where('user_id', Auth::id())
            ->where('book_id', $request->book_id)
            ->whereIn('status', ['to_claim', 'to_return'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have an active reservation for this book.');
        }

        $book = \App\Models\Book::findOrFail($request->book_id);

        if ($book->quantity < 1) {
            return back()->with('error', 'This book is currently out of stock.');
        }

        $now = Carbon::now();
        $pickupDate = Carbon::parse($request->pickup_date)->setTimeFrom($now);
        $dueDate = $pickupDate->copy()->addDay();

        Reservation::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'pickup_date' => $pickupDate,
            'due_date' => $dueDate,
            'initial_duedate' => $dueDate,
            'status' => 'to_claim',
        ]);

        $book->decrement('quantity');

        return redirect()->route('user.reservations.index')->with('success', 'Book reserved successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'to_claim') {
            abort(403);
        }

        $reservation->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        $reservation->book->increment('quantity');

        return redirect()->route('user.reservations.index')->with('success', 'Reservation cancelled.');
    }

    public function declareLost(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'to_return') {
            abort(403);
        }

        $reservation->update([
            'lost_declared' => true,
            'lost_status' => 'pending',
        ]);

        return redirect()->route('user.reservations.index')->with('success', 'Lost declaration submitted.');
    }

public function editPickupDate(Request $request, Reservation $reservation)
{
    if (
        $reservation->user_id !== Auth::id() ||
        $reservation->status !== 'to_claim' ||
        $reservation->pickup_date_edited
    ) {
        abort(403, 'You cannot edit the pickup date.');
    }

    $request->validate([
        'pickup_date' => 'required|date|after_or_equal:today',
    ]);

    $updatedPickup = Carbon::parse($request->pickup_date)->setTimeFrom(Carbon::now());
    $updatedDue = $updatedPickup->copy()->addDay();

    $reservation->update([
        'pickup_date' => $updatedPickup,
        'due_date' => $updatedDue,
        'pickup_date_edited' => true,
    ]);

    return redirect()->route('user.reservations.index')->with('success', 'Pickup date updated successfully.');
}

}
