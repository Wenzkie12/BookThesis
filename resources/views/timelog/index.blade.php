<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            All Timelogs
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6 flex flex-wrap gap-4 items-center justify-between">
            <form method="GET" action="{{ route('timelog.index') }}" class="flex flex-wrap gap-4 items-center flex-grow">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by user..."
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                    autofocus
                >

                <select name="month" class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" >
                    <option value="">Month</option>
                    @foreach([
                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                    ] as $num => $name)
                        <option value="{{ $num }}" @selected(request('month') === $num)>{{ $name }}</option>
                    @endforeach
                </select>

                <select name="year" class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" >
                    <option value="">Year</option>
                    @php
                        $currentYear = date('Y');
                        $startYear = $currentYear - 5;
                    @endphp
                    @for($y = $currentYear; $y >= $startYear; $y--)
                        <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
                    @endfor
                </select>

                <x-primary-button type="submit" class="text-sm px-4 py-2">
                    Search
                </x-primary-button>

                @if(request('search') || request('sort_by') || request('month') || request('year'))
                    <a href="{{ route('timelog.index') }}"
                       class="text-sm text-accent underline hover:text-accent-dark transition">
                        Clear
                    </a>
                @endif
            </form>

            <a href="{{ route('timelog.export', request()->all()) }}" class="text-sm px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark transition whitespace-nowrap">
                Export to Excel
            </a>
        </div>

        <x-table>
            <x-thead>
                <x-tr>
                    <x-th>User</x-th>
                    <x-th >
                        <a href="{{ route('timelog.index', ['sort_by' => 'year_month', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc'] + request()->except('sort_by', 'sort_order', 'page')) }}" class="hover:underline flex items-center gap-1 select-none cursor-pointer">
                            Date
                            @if(request('sort_by') === 'year_month')
                                @if(request('sort_order') === 'asc')
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 12l5-5 5 5H5z"/></svg>
                                @else
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5 5 5-5H5z"/></svg>
                                @endif
                            @endif
                        </a>
                    </x-th>
                    <x-th class="text-green-600">Time In</x-th>
                    <x-th class="text-red-600">Time Out</x-th>
                </x-tr>
            </x-thead>

            <x-tbody>
                @forelse ($logs as $log)
                    <x-tr>
                        <x-td>{{ $log->user_name }}</x-td>
                        <x-td>{{ $log->date }}</x-td>
                        <x-td>{{ $log->time_in }}</x-td>
                        <x-td>{{ $log->time_out }}</x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <x-td colspan="4" class="text-center py-6 text-gray-500">
                            No timelogs found.
                        </x-td>
                    </x-tr>
                @endforelse
            </x-tbody>
        </x-table>

        @if(method_exists($logs, 'links'))
            <div class="mt-6">
                {{ $logs->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
