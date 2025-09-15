<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12 max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.category.update', $category) }}" class="bg-background p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm">
                @error('name')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-primary-button type="submit">
                    Update
                </x-primary-button>
            </div>
        </form>
    </div>

    @if(session('unchanged'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('open-modal', { detail: 'unchanged-modal' }));
            });
        </script>

        <x-modal name="unchanged-modal" :show="true" maxWidth="sm">
            <div class="p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">No Changes Detected</h2>
                <p class="text-gray-600 mb-4">You didn’t modify any data. Please change something before submitting.</p>
                <x-primary-button
                    type="button"
                    x-on:click="$dispatch('close-modal', 'unchanged-modal')"
                >
                    Close
                </x-primary-button>
            </div>
        </x-modal>
    @endif
</x-app-layout>
