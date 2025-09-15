<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-light-text dark:text-dark-text">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 text-light-text dark:text-dark-text">
        <div class="w-full bg-background shadow-lg rounded-2xl p-6 text-center">
            <div class="flex flex-col items-center space-y-4">
                <div class="w-full flex justify-center">
                    <img src="{{ asset('image/hello.svg') }}" alt="Library Illustration" class="w-2/4 md:w-1/3 max-w-xs md:max-w-sm">
                </div>
                <div>
                    <p id="current-date" class="text-sm text-gray-600 dark:text-gray-400"></p>
                    <p id="current-time" class="text-lg font-semibold text-gray-800 dark:text-gray-200"></p>
                </div>
                @php
                    $hour = now()->hour;
                    $greeting = $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening');
                @endphp
                <h1 class="text-2xl font-bold">
                    Hello, {{ Auth::user()->name }}! {{ $greeting }}!
                </h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-background shadow-md rounded-lg flex flex-col">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">
                        Reservations to Claim ({{ $toClaim->count() }})
                    </h3>
                    <a href="{{ route('staff.reservations.index', ['tab' => 'to_claim']) }}">
                        <button class="bg-primary hover:bg-accent text-white text-sm font-medium px-4 py-2 rounded transition">
                            View All
                        </button>
                    </a>
                </div>
                <div class="p-6 flex-grow">
                    @if($toClaim->isEmpty())
                        <p class="text-gray-500">No reservations to claim.</p>
                    @else
                        <x-table>
                            <x-thead>
                                <x-tr>
                                    <x-th>User</x-th>
                                    <x-th>Book</x-th>
                                    <x-th>Pickup Date</x-th>
                                    <x-th>Due Date</x-th>
                                </x-tr>
                            </x-thead>
                            <x-tbody>
                                @foreach($toClaim as $reservation)
                                    <x-tr>
                                        <x-td>{{ $reservation->user->name ?? 'N/A' }}</x-td>
                                        <x-td>{{ $reservation->book->title ?? 'N/A' }}</x-td>
                                        <x-td>{{ $reservation->pickup_date?->format('M d, Y') ?? 'Not set' }}</x-td>
                                        <x-td>{{ $reservation->due_date?->format('M d, Y') ?? 'Not set' }}</x-td>
                                    </x-tr>
                                @endforeach
                            </x-tbody>
                        </x-table>
                    @endif
                </div>
            </div>

            <div class="bg-background shadow-md rounded-lg flex flex-col">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">
                        Reservations to Return ({{ $toReturn->count() }})
                    </h3>
                    <a href="{{ route('staff.reservations.index', ['tab' => 'to_return']) }}">
                        <button class="bg-primary hover:bg-accent text-white text-sm font-medium px-4 py-2 rounded transition">
                            View All
                        </button>
                    </a>
                </div>
                <div class="p-6 flex-grow">
                    @if($toReturn->isEmpty())
                        <p class="text-gray-500">No reservations to return.</p>
                    @else
                        <x-table>
                            <x-thead>
                                <x-tr>
                                    <x-th>User</x-th>
                                    <x-th>Book</x-th>
                                    <x-th>Pickup Date</x-th>
                                    <x-th>Due Date</x-th>
                                </x-tr>
                            </x-thead>
                            <x-tbody>
                                @foreach($toReturn as $reservation)
                                    <x-tr>
                                        <x-td>{{ $reservation->user->name ?? 'N/A' }}</x-td>
                                        <x-td>{{ $reservation->book->title ?? 'N/A' }}</x-td>
                                        <x-td>{{ $reservation->pickup_date?->format('M d, Y') ?? 'Not set' }}</x-td>
                                        <x-td>{{ $reservation->due_date?->format('M d, Y') ?? 'Not set' }}</x-td>
                                    </x-tr>
                                @endforeach
                            </x-tbody>
                        </x-table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = now.getHours() % 12 || 12;
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const ampm = now.getHours() >= 12 ? 'PM' : 'AM';
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('current-time').innerText = `${hours}:${minutes}:${seconds} ${ampm}`;
            document.getElementById('current-date').innerText = now.toLocaleDateString('en-US', dateOptions);
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>
