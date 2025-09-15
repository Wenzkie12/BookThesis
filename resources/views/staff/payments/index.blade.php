<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800">
            Payment Records
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <form method="GET" action="{{ route('payments.index') }}" class="flex flex-wrap gap-4 items-center">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by name, email, or reference" 
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                >

                <select 
                    name="filter" 
                    class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">All Time</option>
                    <option value="today" {{ request('filter') === 'today' ? 'selected' : '' }}>Today</option>
                    <option value="yesterday" {{ request('filter') === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                    <option value="last_week" {{ request('filter') === 'last_week' ? 'selected' : '' }}>Last Week</option>
                    <option value="last_month" {{ request('filter') === 'last_month' ? 'selected' : '' }}>Last Month</option>
                    <option value="last_year" {{ request('filter') === 'last_year' ? 'selected' : '' }}>Last Year</option>
                </select>

                <div class="flex gap-2">
                    <x-primary-button type="submit" class="text-sm px-4 py-2">
                        Apply
                    </x-primary-button>

                    <a href="{{ route('payments.export', request()->query()) }}">
                        <x-secondary-button class="text-sm px-4 py-2">
                            Export to Excel
                        </x-secondary-button>
                    </a>
                </div>

                @if(request()->has('search') || request()->has('filter'))
                    <a href="{{ route('payments.index') }}" 
                       class="text-sm text-accent underline hover:text-accent-dark transition">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        @if ($payments->count())
            <x-table>
                <x-thead>
                    <x-tr>
                        <x-th>User Name</x-th>
                        <x-th>Email</x-th>
                        <x-th>Amount</x-th>
                        <x-th>Reference Number</x-th>
                        <x-th>Payment Date</x-th>
                    </x-tr>
                </x-thead>

                <x-tbody>
                    @foreach ($payments as $payment)
                        <x-tr>
                            <x-td>{{ $payment->profile->user->name ?? 'N/A' }}</x-td>
                            <x-td>{{ $payment->profile->user->email ?? 'N/A' }}</x-td>
                            <x-td>₱{{ number_format($payment->amount, 2) }}</x-td>
                            <x-td>{{ $payment->reference_number }}</x-td>
                            <x-td>{{ $payment->payment_date ? $payment->payment_date->format('F j, Y g:i A') : 'N/A' }}</x-td>
                        </x-tr>
                    @endforeach
                </x-tbody>
            </x-table>

            <div class="mt-6">
                {{ $payments->appends(request()->query())->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-gray-400 mt-12">
                No payment records found.
            </p>
        @endif
    </div>
</x-app-layout>
