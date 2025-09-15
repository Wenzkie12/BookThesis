<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Timelog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TimelogsExport;
use Illuminate\Support\Facades\DB;

class TimelogController extends Controller
{
  public function index(Request $request)
{
    $query = Timelog::with('user');

    if ($request->filled('search')) {
        $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$request->input('search')}%"));
    }

    if ($request->filled('month')) {
        $query->whereMonth('created_at', $request->input('month'));
    }

    if ($request->filled('year')) {
        $query->whereYear('created_at', $request->input('year'));
    }

    $logs = $query->orderByDesc('created_at')->paginate(20)->withQueryString()
        ->through(function ($log) {
            return (object) [
                'user_name' => $log->user->name ?? 'Unknown',
                'date' => \Carbon\Carbon::parse($log->created_at)->format('l, F j, Y'),
                'time_in' => $log->time_in ? \Carbon\Carbon::parse($log->time_in)->format('h:i A') : '-',
                'time_out' => $log->time_out ? \Carbon\Carbon::parse($log->time_out)->format('h:i A') : '-',
            ];
        });

    return view('timelog.index', ['logs' => $logs]);
}



    public function export(Request $request)
    {
        $queryBuilder = QueryBuilder::for(Timelog::with('user'))
            ->allowedFilters([
                AllowedFilter::callback('search', function ($query, $value) {
                    $query->whereHas('user', function ($q) use ($value) {
                        $q->where('name', 'like', "%{$value}%");
                    });
                }),
                AllowedFilter::callback('month', function ($query, $value) {
                    $query->whereMonth('created_at', $value);
                }),
                AllowedFilter::callback('year', function ($query, $value) {
                    $query->whereYear('created_at', $value);
                }),
            ])
            ->allowedSorts([
                'created_at',
                'time_in',
                'time_out',
                AllowedSort::callback('year_month', function ($query, $direction) {
                    $query->orderByRaw('YEAR(created_at) ' . $direction)
                          ->orderByRaw('MONTH(created_at) ' . $direction);
                }),
            ]);

        if ($request->filled('sort_by')) {
            $direction = $request->input('sort_order') === 'desc' ? '-' : '';
            $queryBuilder->defaultSort($direction . $request->input('sort_by'));
        } else {
            $queryBuilder->defaultSort('-created_at');
        }

        return Excel::download(new TimelogsExport($queryBuilder), 'timelogs_' . now()->format('Y_m_d_H_i_s') . '.xlsx');
    }

    public function timeIn(Request $request)
    {
        $profile = Profile::where('qr_code', $request->qr_code)->first();

        if (! $profile) {
            return response()->json(['error' => 'Invalid QR code'], 404);
        }

        Timelog::create([
            'user_id' => $profile->user_id,
            'time_in' => now(),
        ]);

        return response()->json(['success' => 'Time In recorded.']);
    }

    public function timeOut(Request $request)
    {
        $profile = Profile::where('qr_code', $request->qr_code)->first();

        if (! $profile) {
            return response()->json(['error' => 'Invalid QR code'], 404);
        }

        $lastLog = Timelog::where('user_id', $profile->user_id)
            ->whereNull('time_out')
            ->latest()
            ->first();

        if (! $lastLog) {
            return response()->json(['error' => 'No pending Time In found.'], 404);
        }

        $lastLog->update(['time_out' => now()]);

        return response()->json(['success' => 'Time Out recorded.']);
    }
}
