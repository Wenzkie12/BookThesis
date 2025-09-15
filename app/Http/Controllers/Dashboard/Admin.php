<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Penalty;
use App\Models\Payment;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', 'today');
        $range = $this->getDateRange($period);

        $currentData = [
            'users' => User::whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'books' => Book::whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'reservations' => Reservation::whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'payments' => Payment::whereBetween('created_at', [$range['start'], $range['end']])->sum('amount'),
            'penalties' => Penalty::whereBetween('created_at', [$range['start'], $range['end']])->sum('amount'),
        ];

        $statusCounts = [
            'to_claim' => Reservation::where('status', 'to_claim')->whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'to_return' => Reservation::where('status', 'to_return')->whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'completed' => Reservation::where('status', 'completed')->whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->whereBetween('created_at', [$range['start'], $range['end']])->count(),
            'lost' => Reservation::where('status', 'lost')->whereBetween('created_at', [$range['start'], $range['end']])->count(),
        ];

        $financials = [
            'payments' => $currentData['payments'],
            'penalties' => $currentData['penalties'],
        ];

        $totals = [
            'users' => User::count(),
            'books' => Book::count(),
            'reservations' => Reservation::count(),
            'to_claim' => Reservation::where('status', 'to_claim')->count(),
            'to_return' => Reservation::where('status', 'to_return')->count(),
            'completed' => Reservation::where('status', 'completed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'lost' => Reservation::where('status', 'lost')->count(),
            'payments' => Payment::sum('amount'),
            'penalties' => Penalty::sum('amount'),
        ];

        $topUsers = User::withCount([
            'reservations as completed_count' => function ($query) use ($range) {
                $query->where('status', 'completed')
                      ->whereBetween('created_at', [$range['start'], $range['end']]);
            }
        ])
        ->orderByDesc('completed_count')
        ->take(5)
        ->get();

        $groupedReservations = $this->getGroupedReservations($period, $range);

        return view('admin.dashboard', compact(
            'period',
            'currentData',
            'statusCounts',
            'financials',
            'totals',
            'topUsers',
            'groupedReservations'
        ));
    }

  private function getDateRange($period)
{
    switch ($period) {
        case 'january':
            return ['start' => Carbon::create(null, 1, 1)->startOfMonth(), 'end' => Carbon::create(null, 1, 1)->endOfMonth()];
        case 'february':
            return ['start' => Carbon::create(null, 2, 1)->startOfMonth(), 'end' => Carbon::create(null, 2, 1)->endOfMonth()];
        case 'march':
            return ['start' => Carbon::create(null, 3, 1)->startOfMonth(), 'end' => Carbon::create(null, 3, 1)->endOfMonth()];
        case 'april':
            return ['start' => Carbon::create(null, 4, 1)->startOfMonth(), 'end' => Carbon::create(null, 4, 1)->endOfMonth()];
        case 'may':
            return ['start' => Carbon::create(null, 5, 1)->startOfMonth(), 'end' => Carbon::create(null, 5, 1)->endOfMonth()];
        case 'june':
            return ['start' => Carbon::create(null, 6, 1)->startOfMonth(), 'end' => Carbon::create(null, 6, 1)->endOfMonth()];
        case 'july':
            return ['start' => Carbon::create(null, 7, 1)->startOfMonth(), 'end' => Carbon::create(null, 7, 1)->endOfMonth()];
        case 'august':
            return ['start' => Carbon::create(null, 8, 1)->startOfMonth(), 'end' => Carbon::create(null, 8, 1)->endOfMonth()];
        case 'september':
            return ['start' => Carbon::create(null, 9, 1)->startOfMonth(), 'end' => Carbon::create(null, 9, 1)->endOfMonth()];
        case 'october':
            return ['start' => Carbon::create(null, 10, 1)->startOfMonth(), 'end' => Carbon::create(null, 10, 1)->endOfMonth()];
        case 'november':
            return ['start' => Carbon::create(null, 11, 1)->startOfMonth(), 'end' => Carbon::create(null, 11, 1)->endOfMonth()];
        case 'december':
            return ['start' => Carbon::create(null, 12, 1)->startOfMonth(), 'end' => Carbon::create(null, 12, 1)->endOfMonth()];

        case 'today':
            return ['start' => Carbon::today(), 'end' => Carbon::now()->endOfDay()];
        case 'yesterday':
            return ['start' => Carbon::yesterday(), 'end' => Carbon::yesterday()->endOfDay()];
        case 'this_week':
            return ['start' => Carbon::now()->startOfWeek(), 'end' => Carbon::now()->endOfDay()];
        case 'last_week':
            return ['start' => Carbon::now()->subWeek()->startOfWeek(), 'end' => Carbon::now()->subWeek()->endOfWeek()];
        case 'this_month':
            return ['start' => Carbon::now()->startOfMonth(), 'end' => Carbon::now()->endOfDay()];
        case 'last_month':
            return ['start' => Carbon::now()->subMonth()->startOfMonth(), 'end' => Carbon::now()->subMonth()->endOfMonth()];
        case 'this_year':
            return ['start' => Carbon::now()->startOfYear(), 'end' => Carbon::now()->endOfDay()];
        case 'last_year':
            return ['start' => Carbon::now()->subYear()->startOfYear(), 'end' => Carbon::now()->subYear()->endOfYear()];

        case 'all':
        default:
            return ['start' => Carbon::minValue(), 'end' => Carbon::now()->endOfDay()];
    }
}


    private function getGroupedReservations($period, $range)
    {
        if (in_array($period, ['this_month', 'last_month', 'this_week', 'last_week'])) {
            return Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as total')
                ->where('status', 'completed')
                ->whereBetween('created_at', [$range['start'], $range['end']])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get();
        } elseif (in_array($period, ['this_year', 'last_year', 'all'])) {
            return Reservation::selectRaw('MONTH(created_at) as month_number, MONTHNAME(created_at) as month_name, COUNT(*) as total')
                ->where('status', 'completed')
                ->whereBetween('created_at', [$range['start'], $range['end']])
                ->groupBy('month_number', 'month_name')
                ->orderBy('month_number')
                ->get()
                ->map(function ($item) {
                    return (object)[
                        'date' => $item->month_name,
                        'total' => $item->total,
                    ];
                });
        }

        return collect();
    }
}
