<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Penalty Records
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <form method="GET" class="flex flex-wrap gap-4 items-center">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by user name"
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm"
                />

                <select 
                    name="sort"
                    class="rounded-md border px-3 py-2 text-sm"
                >
                    <option value="">Sort by</option>
                    <option value="today" {{ request('sort') === 'today' ? 'selected' : '' }}>Today</option>
                    <option value="yesterday" {{ request('sort') === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                    <option value="last_week" {{ request('sort') === 'last_week' ? 'selected' : '' }}>Last Week</option>
                    <option value="last_month" {{ request('sort') === 'last_month' ? 'selected' : '' }}>Last Month</option>
                    <option value="last_year" {{ request('sort') === 'last_year' ? 'selected' : '' }}>Last Year</option>
                    <option value="all" {{ request('sort') === 'all' ? 'selected' : '' }}>All</option>
                </select>

                <x-primary-button type="submit">
                    Search
                </x-primary-button>

                <a href="{{ route('penalties.export', request()->query()) }}">
    <x-secondary-button>
        Export to Excel
    </x-secondary-button>
</a>

            </form>
        </div>

        @if ($penalties->count())
            <x-table>
                <x-thead>
                    <x-tr>
                        <x-th>User</x-th>
                        <x-th>Amount</x-th>
                        <x-th>Applied At</x-th>
                    </x-tr>
                </x-thead>

                <x-tbody>
                    @foreach ($penalties as $penalty)
                        <x-tr>
                            <x-td>{{ $penalty->profile->user->name ?? 'N/A' }}</x-td>
                            <x-td>₱{{ number_format($penalty->amount, 2) }}</x-td>
                            <x-td>{{ $penalty->applied_at->format('F j, Y g:i A') }}</x-td>
                        </x-tr>
                    @endforeach
                </x-tbody>
            </x-table>

            <div class="mt-6">
                {{ $penalties->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-gray-400 mt-12">
                No penalty records found.
            </p>
        @endif
    </div>
</x-app-layout>
