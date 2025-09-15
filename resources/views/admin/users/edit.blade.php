<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Edit User Roles
        </h2>
    </x-slot>

    <div class="py-12 max-w-lg mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-background shadow rounded-md p-6">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" value="Name" />
                    <input 
                        type="text" 
                        id="name" 
                        value="{{ $user->name }}" 
                        readonly
                        class="w-full rounded-md border border-accent bg-gray-100 cursor-not-allowed px-3 py-2 text-gray-700 dark:bg-dark-background dark:text-gray-300 dark:border-dark-accent"
                    />
                </div>

                <div>
                    <x-input-label for="email" value="Email" />
                    <input 
                        type="email" 
                        id="email" 
                        value="{{ $user->email }}" 
                        readonly
                        class="w-full rounded-md border border-accent bg-gray-100 cursor-not-allowed px-3 py-2 text-gray-700 dark:bg-dark-background dark:text-gray-300 dark:border-dark-accent"
                    />
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-3">Roles</h3>
                    <div class="grid grid-cols-2 gap-3 max-h-64 overflow-y-auto">
                        @foreach ($roles as $role)
                            <label class="flex items-center space-x-2">
                                <input 
                                    type="radio" 
                                    name="role" 
                                    value="{{ $role->name }}" 
                                    {{ in_array($role->name, $userRoles) ? 'checked' : '' }}
                                    class="rounded border-accent bg-background text-primary focus:ring-primary dark:border-dark-accent dark:bg-dark-background dark:text-dark-primary dark:focus:ring-dark-primary"
                                />
                                <span>{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <x-primary-button type="submit" class="w-full">
                    Update Role
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
