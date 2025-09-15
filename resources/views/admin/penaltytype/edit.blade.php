<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center">Edit Penalty Type</h2>
    </x-slot>

    <div class="max-w-md mx-auto p-6">
        <form method="POST" action="{{ route('admin.penaltytype.update', $penaltyType) }}" class="bg-background p-4 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block mb-1">Penalty Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $penaltyType->name) }}" readonly class="w-full border-gray-300 rounded p-2 bg-gray-100 cursor-not-allowed">
            </div>

            <div class="mb-4">
                <label for="amount" class="block mb-1">Amount (₱)</label>
                <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $penaltyType->amount) }}" required class="w-full border-gray-300 rounded p-2">
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.penaltytype.index') }}" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
