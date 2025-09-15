<x-app-layout>
    @vite(['resources/js/app.js'])

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-light-text leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-background dark:bg-dark-secondary">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-background overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-text">
                    @include('admin.users.queries')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <x-stat-card title="New Users" :value="$currentData['users']" />
                        <x-stat-card title="New Books" :value="$currentData['books']" />
                        <x-stat-card title="New Reservations" :value="$currentData['reservations']" />
                        <x-stat-card title="New Payments" :value="number_format($currentData['payments'], 2)" />
                        <x-stat-card title="New Penalties" :value="number_format($currentData['penalties'], 2)" />
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
                        <div class="bg-light-secondary dark:bg-dark-secondary p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-4 text-light-text dark:text-dark-text">
                                Reservation Status Distribution ({{ ucfirst(str_replace('_', ' ', $period)) }})
                            </h2>
                            <div class="h-64">
                                <canvas id="reservationStatusChart"></canvas>
                            </div>
                        </div>

                        <div class="bg-light-secondary dark:bg-dark-secondary p-6 rounded-lg shadow">
                            <h2 class="text-lg font-semibold mb-4 text-light-text dark:text-dark-text">
                                Penalties vs Payments ({{ ucfirst(str_replace('_', ' ', $period)) }})
                            </h2>
                            <div class="h-64">
                                <canvas id="penaltiesPaymentsChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                        @foreach($totals as $label => $value)
                            <div class="bg-secondary text-text p-6 rounded-lg shadow">
                                <h3 class="text-md font-semibold capitalize mb-1 text-light-text dark:text-dark-text">
                                    {{ str_replace('_', ' ', $label) }}
                                </h3>
                                <p class="text-xl font-bold text-light-text dark:text-dark-text">
                                    @if(in_array($label, ['payments', 'penalties']))
                                        {{ number_format($value, 2) }}
                                    @else
                                        {{ number_format($value) }}
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>

                    {{-- 📄 Printable Most Reservers --}}
                    <div id="printable-reservers" class="bg-light-secondary dark:bg-dark-secondary p-6 rounded-lg shadow mb-10">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold text-light-text dark:text-dark-text">
                                Most Reservers ({{ ucfirst($period) }})
                            </h2>
                            <button onclick="printReservers()" class="bg-primary text-white px-4 py-1.5 rounded hover:opacity-90 text-sm">
                                Print / Save as PDF
                            </button>
                        </div>

                        <ul class="space-y-3">
                            @forelse ($topUsers as $user)
                                @if ($user->completed_count > 0)
                                <li class="flex items-center justify-between bg-light-background dark:bg-dark-background p-3 rounded">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ $user->profile && $user->profile->avatar ? asset('storage/' . $user->profile->avatar) : asset('images/default-avatar.png') }}"
                                            alt="{{ $user->name }}"
                                            class="w-12 h-12 rounded-full object-cover border">
                                        <div class="text-sm">
                                            <p class="font-semibold text-light-text dark:text-dark-text">
                                                {{ $user->name ?? 'No Name' }}
                                            </p>
                                            <p class="text-gray-500 text-xs">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xl font-bold text-light-text dark:text-dark-text">
                                            {{ $user->completed_count }}
                                        </span>
                                        <span class="text-sm text-gray-500">completed</span>
                                    </div>
                                </li>
                                @endif
                            @empty
                                <li class="text-light-text dark:text-dark-text">No data available.</li>
                            @endforelse
                        </ul>
                    </div>

                    @if ($groupedReservations->isNotEmpty())
                        <div class="bg-light-secondary dark:bg-dark-secondary p-6 rounded-lg shadow mb-10">
                            <h2 class="text-lg font-semibold mb-4 text-light-text dark:text-dark-text">
                                Completed Reservations Trend ({{ ucfirst(str_replace('_', ' ', $period)) }})
                            </h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto text-left text-light-text dark:text-dark-text">
                                    <thead>
                                        <tr class="border-b border-gray-300 dark:border-gray-700">
                                            <th class="px-4 py-2">Date</th>
                                            <th class="px-4 py-2">Total Completed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupedReservations as $data)
                                            <tr class="border-b border-gray-200 dark:border-gray-800">
                                                <td class="px-4 py-2">{{ $data->date }}</td>
                                                <td class="px-4 py-2 font-semibold">{{ $data->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        window.dashboardData = {
            reservationStatus: @json($statusCounts),
            financials: @json($financials),
        };

        function printReservers() {
            const element = document.getElementById('printable-reservers');
            const options = {
                margin: 0.3,
                filename: 'Most_Reservers_{{ $period }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

            html2pdf().set(options).from(element).save();
        }
    </script>
</x-app-layout>
