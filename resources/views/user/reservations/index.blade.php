<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-light-text dark:text-dark-text">
            My Reservations
        </h2>
    </x-slot>

    <div x-data="{ tab: 'to_claim' }" class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-text">
        <x-success-alert />

        <div class="mb-6">
            <div class="sm:hidden">
                <select x-model="tab" class="w-full rounded-md border-gray-300 dark:bg-dark-bg dark:text-dark-text">
                    @foreach (['to_claim', 'to_return', 'completed', 'cancelled', 'lost'] as $statusOption)
                        <option value="{{ $statusOption }}">
                            {{ ucfirst(str_replace('_', ' ', $statusOption)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="hidden sm:flex space-x-4 border-b border-gray-200">
                @foreach (['to_claim', 'to_return', 'completed', 'cancelled', 'lost'] as $statusOption)
                    <button
                        @click="tab = '{{ $statusOption }}'"
                        :class="tab === '{{ $statusOption }}' ? 'border-primary border-b-2 text-primary' : 'text-gray-600 hover:text-primary'"
                        class="px-4 py-2 font-semibold whitespace-nowrap"
                    >
                        {{ ucfirst(str_replace('_', ' ', $statusOption)) }}
                    </button>
                @endforeach
            </div>
        </div>

        @foreach (['to_claim', 'to_return', 'completed', 'cancelled', 'lost'] as $status)
            <div x-show="tab === '{{ $status }}'" x-cloak>
                {{-- Desktop Table --}}
                <div class="hidden sm:block overflow-x-auto rounded-2xl shadow">
                    <x-table>
                        <x-thead>
                            <x-tr>
                                <x-th>Book Title</x-th>
                                @if ($status === 'to_claim')
                                    <x-th>Pickup Date</x-th>
                                    <x-th>Reserved At</x-th>
                                @elseif ($status === 'to_return')
                                    <x-th>Due Date</x-th>
                                    <x-th>Claimed By</x-th>
                                    <x-th>Claimed At</x-th>
                                @elseif ($status === 'completed')
                                    <x-th>Returned By</x-th>
                                    <x-th>Completed At</x-th>
                                @elseif ($status === 'cancelled')
                                    <x-th>Cancelled At</x-th>
                                @elseif ($status === 'lost')
                                    <x-th>Lost Status</x-th>
                                @endif
                                <x-th>Actions</x-th>
                            </x-tr>
                        </x-thead>

                        <x-tbody>
                            @php
                                $filtered = $reservations->filter(fn($r) => $r->status === $status);
                            @endphp

                            @forelse ($filtered as $reservation)
                                <x-tr>
                                    <x-td>{{ $reservation->book->title }}</x-td>

                                    @if ($status === 'to_claim')
                                        <x-td>{{ $reservation->pickup_date?->format('F d, Y h:i A') ?? '-' }}</x-td>
                                        <x-td>{{ $reservation->created_at->format('M d, Y h:i A') }}</x-td>
                                    @elseif ($status === 'to_return')
                                        <x-td>{{ $reservation->due_date?->format('F d, Y h:i A') ?? '-' }}</x-td>
                                        <x-td>{{ $reservation->claimedBy?->name ?? '-' }}</x-td>
                                        <x-td>{{ $reservation->claimed_at?->format('M d, Y h:i A') ?? '-' }}</x-td>
                                    @elseif ($status === 'completed')
                                        <x-td>{{ $reservation->returnedBy?->name ?? '-' }}</x-td>
                                        <x-td>{{ $reservation->completed_at?->format('M d, Y h:i A') ?? '-' }}</x-td>
                                    @elseif ($status === 'cancelled')
                                        <x-td>{{ $reservation->cancelled_at?->format('M d, Y h:i A') ?? '-' }}</x-td>
                                    @elseif ($status === 'lost')
                                        <x-td class="capitalize">{{ $reservation->lost_status ?? 'pending' }}</x-td>
                                    @endif

                                    <x-td>
                                        @include('user.reservations.partials.actions')
                                    </x-td>
                                </x-tr>
                            @empty
                                <x-tr>
                                    <x-td colspan="7" class="text-center text-gray-500">
                                        No {{ str_replace('_', ' ', $status) }} reservations.
                                    </x-td>
                                </x-tr>
                            @endforelse
                        </x-tbody>
                    </x-table>
                </div>

               
                <div class="space-y-4 sm:hidden">
                    @forelse ($reservations->where('status', $status) as $reservation)
                        <div x-data="{ open: false }" class="bg-background rounded-xl shadow p-4">
                            <div class="flex justify-between items-center">
                                <div class="font-semibold">{{ $reservation->book->title }}</div>
                                <button @click="open = !open" class="text-sm text-primary font-medium">
                                    <span x-text="open ? 'Hide' : 'View'"></span>
                                </button>
                            </div>

                            <div x-show="open" x-collapse class="mt-3 text-sm space-y-2 text-gray-700 dark:text-gray-300">
                                @if ($status === 'to_claim')
                                    <div><span class="font-medium">Pickup Date:</span> {{ $reservation->pickup_date?->format('F d, Y h:i A') ?? '-' }}</div>
                                    <div><span class="font-medium">Reserved At:</span> {{ $reservation->created_at->format('M d, Y h:i A') }}</div>
                                @elseif ($status === 'to_return')
                                    <div><span class="font-medium">Due Date:</span> {{ $reservation->due_date?->format('F d, Y h:i A') ?? '-' }}</div>
                                    <div><span class="font-medium">Claimed By:</span> {{ $reservation->claimedBy?->name ?? '-' }}</div>
                                    <div><span class="font-medium">Claimed At:</span> {{ $reservation->claimed_at?->format('M d, Y h:i A') ?? '-' }}</div>
                                @elseif ($status === 'completed')
                                    <div><span class="font-medium">Returned By:</span> {{ $reservation->returnedBy?->name ?? '-' }}</div>
                                    <div><span class="font-medium">Completed At:</span> {{ $reservation->completed_at?->format('M d, Y h:i A') ?? '-' }}</div>
                                @elseif ($status === 'cancelled')
                                    <div><span class="font-medium">Cancelled At:</span> {{ $reservation->cancelled_at?->format('M d, Y h:i A') ?? '-' }}</div>
                                @elseif ($status === 'lost')
                                    <div><span class="font-medium">Lost Status:</span> {{ $reservation->lost_status ?? 'pending' }}</div>
                                @endif

                                <div class="pt-2">
                                    @include('user.reservations.partials.actions')
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No {{ str_replace('_', ' ', $status) }} reservations.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
