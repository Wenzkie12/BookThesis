<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <x-success-alert />
    <x-error-alert />

    <div class="py-12">
        <div class="max-w-lg mx-auto px-6">
            <div class="bg-background shadow-md rounded-2xl p-8 flex flex-col items-center space-y-4">
                {{-- Avatar --}}
                @if ($profile->avatar)
                    <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border">
                @else
                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                        No Avatar
                    </div>
                @endif

                {{-- Name & Email --}}
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-base text-primary">{{ $user->email }}</p>

                {{-- Student ID and Department --}}
                <div class="text-center text-gray-700 text-lg space-y-1">
                    <div><span class="font-semibold">Student ID:</span> {{ $user->student_id ?? 'N/A' }}</div>
                    <div><span class="font-semibold">Department:</span> {{ $user->department->name ?? 'N/A' }}</div>
                </div>

                {{-- QR Code --}}
                <div class="p-2 bg-gray-100 rounded shadow mt-2 cursor-pointer" id="qr-code-container">
                    <div id="qrcode" class="w-[120px] h-[120px] mx-auto"></div>
                    <p class="mt-2 text-xs text-gray-500 text-center">Click QR to copy Student ID</p>
                </div>

                {{-- Collapsible Info Section --}}
                <div x-data="{ open: false }" class="w-full mt-4">
                    <button @click="open = !open"
                        class="w-full flex items-center text-center justify-between px-4 py-3 bg-secondary hover:bg-accent rounded text-lg font-semibold">
                        More Information
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 15l7-7 7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse class="mt-4 space-y-3 text-gray-700 text-base">
                        <div><span class="font-semibold">Phone:</span> {{ $profile->phone ?? 'N/A' }}</div>
                        <div><span class="font-semibold">Birthdate:</span>
                            {{ $profile->birthdate ? \Carbon\Carbon::parse($profile->birthdate)->format('F j, Y') : 'N/A' }}
                        </div>
                        <div><span class="font-semibold">Age:</span> {{ $profile->age ?? 'N/A' }}</div>
                        <div><span class="font-semibold">Bio:</span> {{ $profile->bio ?? 'N/A' }}</div>
                        <div>
                            <span class="font-semibold">Address:</span>
                            {{ implode(', ', array_filter([$profile->barangay, $profile->city, $profile->province])) ?: 'N/A' }}
                        </div>
                        <div><span class="font-semibold">Penalty:</span> ₱{{ number_format($profile->penalty ?? 0, 2) }}</div>
                    </div>
                </div>

                {{-- Edit Profile Button --}}
                <a href="{{ route('userprofile.edit') }}" class="w-full mt-6">
                    <x-primary-button class="w-full text-lg py-3">
                        Edit Profile
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>

    {{-- QR Code Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var qrData = @json($profile->qr_code ?? 'NO-STUDENT-ID');
            new QRCode(document.getElementById("qrcode"), {
                text: qrData,
                width: 120,
                height: 120,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            document.getElementById('qr-code-container').addEventListener('click', function() {
                navigator.clipboard.writeText(qrData).then(function() {
                    alert('Student ID copied to clipboard');
                });
            });
        });
    </script>
</x-app-layout>
