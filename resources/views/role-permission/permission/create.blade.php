<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            {{ __('Create Permission') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-background shadow rounded-md p-6">
            <a href="{{ route('permissions.index') }}"
               class="inline-block mb-6 text-sm font-medium text-primary hover:text-accent transition">
                ← Back to Permissions
            </a>

            <h2 class="text-2xl font-semibold text-center mb-6">
                Create Permission
            </h2>

            <form action="{{ route('permissions.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" value="Permission Name:" class="mb-1" />
                    <input
                        type="text"
                        name="name"
                        id="name"
                        required
                        class="w-full rounded-md border border-accent bg-background px-4 py-2 text-gray-900 focus:border-primary focus:ring-primary focus:outline-none dark:bg-dark-background dark:text-gray-100 dark:border-dark-accent dark:focus:border-dark-primary dark:focus:ring-dark-primary shadow-sm"
                    >
                </div>

                <x-primary-button type="submit" class="w-full">
                    Create Permission
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
