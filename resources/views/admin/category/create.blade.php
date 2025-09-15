<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Create Category
        </h2>
    </x-slot>

    <div class="py-12 max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.category.store') }}" class="bg-background p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="mt-1 block w-full border border-primary rounded-md shadow-sm focus:border-primary focus:ring-primary">
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button type="submit">
                    Save
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
