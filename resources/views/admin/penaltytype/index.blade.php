<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center">
            Penalty Types
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <x-table>
            <x-thead>
                <x-tr>
                    <x-th>Name</x-th>
                    <x-th>Amount (₱)</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
            </x-thead>

            <x-tbody>
                @forelse($penaltyTypes as $type)
                    <x-tr>
                        <x-td>{{ $type->name }}</x-td>
                        <x-td>₱{{ number_format($type->amount, 2) }}</x-td>
                        <x-td>
                            <div class="flex gap-2 justify-center flex-wrap">
                                <a href="{{ route('admin.penaltytype.edit', $type) }}" class="w-full sm:w-20">
                                    <x-primary-button type="button" class="w-full text-sm py-2">Edit</x-primary-button>
                                </a>
                            </div>
                        </x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <x-td colspan="3" class="text-center py-6 text-gray-500">
                            No penalty types defined.
                        </x-td>
                    </x-tr>
                @endforelse
            </x-tbody>
        </x-table>
    </div>
</x-app-layout>
