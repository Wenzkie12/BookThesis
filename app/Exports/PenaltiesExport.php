<?php

namespace App\Exports;

use App\Models\Penalty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenaltiesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Penalty::with('profile.user')
            ->filter(request()->only('search', 'sort'))
            ->get()
            ->map(function ($penalty) {
                return [
                    $penalty->profile->user->name ?? 'N/A',
                    $penalty->amount,
                    optional($penalty->applied_at)->format('Y-m-d H:i:s') ?? 'N/A',
                ];
            });
    }

    public function headings(): array
    {
        return ['User Name', 'Amount', 'Applied At'];
    }
}
