<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TimelogsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query->select('user_id', 'created_at', 'time_in', 'time_out')->with('user');
    }

    public function headings(): array
    {
        return ['User', 'Date', 'Time In', 'Time Out'];
    }

    public function map($log): array
    {
        return [
            $log->user->name ?? 'Unknown',
            $log->created_at->format('l, F j, Y'),
            $log->time_in ? $log->time_in->format('h:i A') : '-',
            $log->time_out ? $log->time_out->format('h:i A') : '-',
        ];
    }
}
