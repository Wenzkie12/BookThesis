<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <x-success-alert />
    <x-error-alert />

    <div class="py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-background dark:bg-dark-secondary shadow rounded-xl p-6 flex flex-col items-center space-y-6 text-center">
                {{-- Avatar --}}
                @if ($user->profile?->avatar)
                    <img src="{{ asset('storage/' . $user->profile->avatar) }}" alt="Avatar" class="w-36 h-36 rounded-full object-cover border-4 border-primary shadow-md">
                @else
                    <div class="w-36 h-36 rounded-full bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                        No Avatar
                    </div>
                @endif

                {{-- Name & Email --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-primary">{{ $user->email }}</p>
                </div>

                {{-- QR Code --}}
                <div class="cursor-pointer text-sm" id="qr-code-container">
                    <div id="qrcode" class="w-[100px] h-[100px] mx-auto"></div>
                    <p class="mt-2 text-xs text-gray-500">Tap QR to copy Student ID</p>
                </div>

                {{-- Dropdown Info --}}
                <div x-data="{ open: false }" class="w-full mt-6">
                    <button @click="open = !open" class="w-full bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-opacity-80 transition">
                        {{ __('View Details') }}
                    </button>

                    <div x-show="open" x-collapse class="mt-4 space-y-2 text-left text-gray-700 dark:text-gray-200">
                        <p><span class="font-semibold">Student ID:</span> {{ $user->profile?->qr_code ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Department:</span> {{ $user->department->name ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Phone:</span> {{ $user->profile?->phone ?? 'N/A' }}</p>
                        <p>
                            <span class="font-semibold">Birthdate:</span>
                            {{ $user->profile?->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('F j, Y') : 'N/A' }}
                        </p>
                        <p><span class="font-semibold">Age:</span> {{ $user->profile?->age ?? 'N/A' }}</p>
                        <p><span class="font-semibold">Bio:</span> {{ $user->profile?->bio ?? 'N/A' }}</p>
                        <p>
                            <span class="font-semibold">Address:</span>
                            {{ implode(', ', array_filter([$user->profile?->barangay, $user->profile?->city, $user->profile?->province])) ?: 'N/A' }}
                        </p>
                        <p><span class="font-semibold">Penalty:</span> ₱{{ number_format($user->profile?->penalty ?? 0, 2) }}</p>
                    </div>
                </div>

                <a href="{{ route('admin.users.index') }}" class="w-full mt-6">
                    <x-secondary-button class="w-full text-base py-2">
                        ← Back to User List
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div>

    {{-- QR Code Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var qrData = @json($user->profile?->qr_code ?? 'NO-STUDENT-ID');
            new QRCode(document.getElementById("qrcode"), {
                text: qrData,
                width: 100,
                height: 100,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            document.getElementById('qr-code-container').addEventListener('click', function () {
                navigator.clipboard.writeText(qrData).then(function () {
                    alert('Student ID copied to clipboard');
                });
            });
        });
    </script>
</x-app-layout>
