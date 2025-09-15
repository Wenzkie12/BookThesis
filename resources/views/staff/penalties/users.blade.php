<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Users with Penalties
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <form method="GET" action="{{ route('staff.penalties.users') }}" class="flex flex-wrap gap-4 items-center">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by name" 
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                >

                <x-primary-button 
                    type="submit" 
                    class="text-sm px-4 py-2"
                >
                    Search
                </x-primary-button>

                @if(request()->has('search'))
                    <a href="{{ route('staff.penalties.users') }}" 
                       class="text-sm text-accent underline hover:text-accent-dark transition"
                    >
                        Clear
                    </a>
                @endif
            </form>
        </div>

        @if ($users->count())
            <x-table>
                <x-thead>
                    <x-tr>
                        <x-th>Name</x-th>
                        <x-th>Email</x-th>
                        <x-th>Penalty</x-th>
                        <x-th>Action</x-th>
                    </x-tr>
                </x-thead>

                <x-tbody>
                    @foreach ($users as $user)
                        @php $profile = $user->profile; @endphp
                        <x-tr>
                            <x-td>{{ $user->name }}</x-td>
                            <x-td>{{ $user->email }}</x-td>
                            <x-td>₱{{ number_format($profile->penalty, 2) }}</x-td>
                            <x-td>
                                <button
                                    x-data
                                    @click="$dispatch('open-modal', '{{ 'pay-modal-' . $profile->id }}')"
                                    class="bg-primary hover:bg-accent text-white font-semibold px-4 py-2 rounded transition text-sm"
                                >
                                    Pay
                                </button>
                            </x-td>
                        </x-tr>

                        <x-modal name="{{ 'pay-modal-' . $profile->id }}">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold mb-4 text-center">Make a Payment for {{ $user->name }}</h2>
                                <form method="POST" action="{{ route('payments.store', $profile) }}" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="amount-{{ $profile->id }}" class="block text-sm font-medium mb-1">Amount (₱)</label>
                                        <x-text-input
                                            id="amount-{{ $profile->id }}"
                                            name="amount"
                                            type="number"
                                            step="0.01"
                                            max="{{ $profile->penalty }}"
                                            min="1"
                                            required
                                            class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
                                        />
                                    </div>
                                    <div class="flex justify-end space-x-2 mt-2">
                                        <button type="button"
                                            @click="$dispatch('close-modal', '{{ 'pay-modal-' . $profile->id }}')"
                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded transition text-sm"
                                        >
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-primary hover:bg-accent text-white rounded transition text-sm"
                                        >
                                            Confirm Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </x-modal>
                    @endforeach
                </x-tbody>
            </x-table>

            {{-- <div class="mt-6">
                {{ $users->links() }}
            </div> --}}
        @else
            <p class="text-center text-gray-500 dark:text-gray-400 mt-12">
                No users with penalties.
            </p>
        @endif
    </div>
</x-app-layout>
