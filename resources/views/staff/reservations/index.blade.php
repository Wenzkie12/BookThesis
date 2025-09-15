<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center">
            Reservation Management
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-text">
        <x-success-alert />

        <div class="py-12 w-full max-w-full mx-auto px-4 sm:px-6 lg:px-8 text-text">
            @foreach(['to_claim','to_return','completed','cancelled','lost'] as $statusOption)
                <a 
                    href="{{ route('staff.reservations.index', ['tab' => $statusOption]) }}" 
                    class="px-5 py-2 text-sm font-semibold transition
                        {{ request('tab', $status) === $statusOption 
                            ? 'border-primary border-b-2 text-primary' 
                            : 'text-gray-600 hover:text-primary' }}"
                    role="tab"
                    aria-selected="{{ request('tab', $status) === $statusOption ? 'true' : 'false' }}"
                >
                    {{ ucfirst(str_replace('_', ' ', $statusOption)) }}
                </a>
            @endforeach
        </div>

        
            <x-table>
                <x-thead>
                    <x-tr>
                        <x-th>User</x-th>
                        <x-th>Book</x-th>

                        @if($status === 'to_claim')
                            <x-th>Pickup Date</x-th>
                            <x-th>Reserved At</x-th>
                        @elseif($status === 'to_return')
                            <x-th>Due Date</x-th>
                            <x-th>Claimed At</x-th>
                        @elseif($status === 'completed')
                            <x-th>Due Date</x-th>
                            <x-th>Completed At</x-th>
                        @elseif($status === 'cancelled')
                            <x-th>Cancelled At</x-th>
                        @elseif($status === 'lost')
                            <x-th>Marked Lost</x-th>
                        @endif

                        <x-th>Actions</x-th>
                    </x-tr>
                </x-thead>

                <x-tbody>
                    @forelse($reservations as $reservation)
                        <x-tr>
                            <x-td>{{ $reservation->user->name }}</x-td>
                            <x-td>{{ $reservation->book->title }}</x-td>

                            @php
                                $fieldMap = [
                                    'to_claim' => ['pickup_date', 'created_at'],
                                    'to_return' => ['due_date', 'claimed_at'],
                                    'completed' => ['due_date', 'completed_at'],
                                    'cancelled' => ['cancelled_at'],
                                    'lost' => ['updated_at'],
                                ];
                            @endphp

                            @foreach ($fieldMap[$status] ?? [] as $field)
                                <x-td>{{ optional($reservation->$field)->format('F d, Y h:i A') }}</x-td>
                            @endforeach

                            <x-td>
                                @include('staff.reservations.partials.actions')
                            </x-td>
                        </x-tr>
                    @empty
                        <x-tr>
                            <x-td colspan="6" class="text-center italic">
                                No {{ str_replace('_',' ',$status) }} reservations.
                            </x-td>
                        </x-tr>
                    @endforelse
                </x-tbody>
            </x-table>
        </div>

        <div class="mt-6">
            {{ $reservations->links() }}
        </div>
    </div>
</x-app-layout>
