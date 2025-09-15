<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PenaltyController extends Controller
{
    public function index(Request $request)
    {
        $query = Penalty::with(['profile.user', 'penaltyType']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('profile.user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'today':
                    $query->whereDate('applied_at', Carbon::today());
                    break;

                case 'yesterday':
                    $query->whereDate('applied_at', Carbon::yesterday());
                    break;

                case 'last_week':
                    $query->whereBetween('applied_at', [
                        Carbon::now()->subWeek()->startOfDay(),
                        Carbon::now()->endOfDay()
                    ]);
                    break;

                case 'last_month':
                    $query->whereBetween('applied_at', [
                        Carbon::now()->subMonth()->startOfDay(),
                        Carbon::now()->endOfDay()
                    ]);
                    break;

                case 'last_year':
                    $query->whereYear('applied_at', Carbon::now()->subYear()->year);
                    break;

                case 'all':
                    break;
            }
        }

        $penalties = $query->latest()->paginate(6)->withQueryString();

        return view('staff.penalties.index', compact('penalties'));
    }

    public function usersWithPenalties(Request $request)
    {
        $query = \App\Models\User::whereHas('profile', function ($q) {
            $q->where('penalty', '>', 0);
        })->with('profile');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->get();

        return view('staff.penalties.users', compact('users'));
    }
}
