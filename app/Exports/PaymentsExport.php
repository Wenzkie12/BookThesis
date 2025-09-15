<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Payment::with('profile.user')
            ->filter(request()->only('search', 'filter'))
            ->get()
            ->map(function ($payment) {
                return [
                    $payment->profile->user->name ?? 'N/A',
                    $payment->profile->user->email ?? 'N/A',
                    $payment->amount,
                    $payment->reference_number,
                    optional($payment->payment_date)->format('Y-m-d H:i:s') ?? 'N/A',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Email',
            'Amount',
            'Reference Number',
            'Payment Date',
        ];
    }
}
