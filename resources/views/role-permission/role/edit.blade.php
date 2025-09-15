<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-background shadow rounded-md p-6 relative">
            <a href="{{ route('roles.index') }}"
               class="inline-block mb-6 text-sm font-medium text-primary hover:text-accent transition">
                ← Back to Roles
            </a>

            <h2 class="text-2xl font-semibold text-center mb-6">
                Edit Role
            </h2>

            <form action="{{ route('roles.update', $role) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" value="Role Name:" class="mb-1" />
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $role->name) }}" 
                        required
                        class="w-full rounded-md border border-accent bg-background px-3 py-2 text-gray-900 focus:border-primary focus:ring-primary focus:outline-none dark:bg-dark-background dark:text-gray-100 dark:border-dark-accent dark:focus:border-dark-primary dark:focus:ring-dark-primary shadow-sm"
                    >
                </div>

                <h3 class="text-lg font-medium mb-4">
                    Assign Permissions:
                </h3>

                <div class="grid grid-cols-2 gap-3 max-h-64 overflow-y-auto mb-6">
                    @foreach ($permissions as $permission)
                        <div class="flex items-center space-x-2">
                            <input 
                                type="checkbox" 
                                name="permissions[]" 
                                id="permission-{{ $permission->id }}"
                                value="{{ $permission->name }}" 
                                {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                class="rounded border-accent bg-background text-primary focus:ring-primary dark:border-dark-accent dark:bg-dark-background dark:text-dark-primary dark:focus:ring-dark-primary"
                            >
                            <label for="permission-{{ $permission->id }}" class="select-none">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <x-primary-button type="submit" class="w-full">
                    Update Role
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
