<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Edit Permission
        </h2>
    </x-slot>

    <div class="py-12 max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-background shadow rounded-md p-6">
            <form action="{{ route('permissions.update', $permission) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" value="Permission Name:" class="mb-1" />
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $permission->name) }}"
                        required
                        class="w-full rounded-md border border-accent bg-background px-4 py-2 text-gray-900 focus:border-primary focus:ring-primary focus:outline-none dark:bg-dark-background dark:text-gray-100 dark:border-dark-accent dark:focus:border-dark-primary dark:focus:ring-dark-primary shadow-sm"
                    >
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('permissions.index') }}"
                       class="inline-block px-4 py-2 rounded-md text-primary hover:text-accent transition">
                        Cancel
                    </a>

                    <x-primary-button type="submit" class="px-6">
                        Update
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
