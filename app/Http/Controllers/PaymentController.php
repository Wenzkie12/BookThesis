<?php

namespace App\Http\Controllers;

use App\Mail\PaymentReceiptMail;
use App\Models\Payment;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function usersWithPenalties(Request $request)
    {
        $query = Profile::where('penalty', '>', 0)->with('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $usersWithPenalties = $query->get();

        return view('staff.payments.users', compact('usersWithPenalties'));
    }

 public function index(Request $request)
{
    $query = Payment::with('profile.user');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->whereHas('profile.user', function ($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->orWhere('reference_number', 'like', '%' . $search . '%');
        });
    }

    if ($request->filled('filter')) {
        $now = Carbon::now();
        $filter = $request->filter;

        switch ($filter) {
            case 'today':
                $query->whereDate('payment_date', $now->toDateString());
                break;
            case 'yesterday':
                $query->whereDate('payment_date', $now->subDay()->toDateString());
                break;
            case 'last_week':
                $query->whereBetween('payment_date', [
                    $now->copy()->subWeek()->startOfWeek(),
                    $now->copy()->subWeek()->endOfWeek()
                ]);
                break;
            case 'last_month':
                $query->whereBetween('payment_date', [
                    $now->copy()->subMonth()->startOfMonth(),
                    $now->copy()->subMonth()->endOfMonth()
                ]);
                break;
            case 'last_year':
                $query->whereYear('payment_date', $now->copy()->subYear()->year);
                break;
        }
    }

    $payments = $query->latest()->paginate(10);

    return view('staff.payments.index', compact('payments'));
}



    public function store(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:' . $profile->penalty,
        ]);

        $amount = $validated['amount'];
        $referenceNumber = strtoupper(Str::random(10));

        $payment = Payment::create([
            'user_profile_id' => $profile->id,
            'amount' => $amount,
            'reference_number' => $referenceNumber,
            'payment_date' => now(),
        ]);

        $profile->penalty = max(0, $profile->penalty - $amount);
        $profile->save();

        if ($profile->user && $profile->user->email) {
            Mail::to($profile->user->email)->send(new PaymentReceiptMail($payment));
        }

        return back()->with('success', 'Payment recorded. Reference: ' . $referenceNumber);
    }
}
