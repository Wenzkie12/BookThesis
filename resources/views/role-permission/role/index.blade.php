<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <div class="mb-4 flex justify-end">
            <a href="{{ route('roles.create') }}" class="w-full sm:w-48">
                <x-primary-button type="button" class="w-full text-sm py-2">
                    + Create Role
                </x-primary-button>
            </a>
        </div>

        @if ($roles->isEmpty())
            <div class="text-center text-gray-500 py-6 text-lg">
                No roles available. Create a new role to get started.
            </div>
        @else
            <x-table>
                <x-thead>
                    <x-tr>
                        <x-th>Role Name</x-th>
                        <x-th>Permissions</x-th>
                        <x-th>Actions</x-th>
                    </x-tr>
                </x-thead>

                <x-tbody>
                    @foreach ($roles as $role)
                        <x-tr>
                            <x-td class="uppercase font-semibold">{{ $role->name }}</x-td>
                            <x-td>
                                @if ($role->permissions->isEmpty())
                                    <span class="text-gray-500 text-sm">No Permissions</span>
                                @else
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($role->permissions as $permission)
                                            <span class="inline-block bg-primary text-background text-[11px] font-medium px-2 py-1 rounded-md uppercase truncate max-w-[120px]">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </x-td>
                            <x-td>
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('roles.edit', $role) }}" class="w-full sm:w-20">
                                        <x-primary-button type="button" class="w-full text-sm py-2">Edit</x-primary-button>
                                    </a>

                                    <form action="{{ route('roles.destroy', $role) }}"
                                          method="POST"
                                          class="w-full sm:w-20"
                                          onsubmit="return confirm('Are you sure you want to delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" class="w-full text-sm py-2">Delete</x-danger-button>
                                    </form>
                                </div>
                            </x-td>
                        </x-tr>
                    @endforeach
                </x-tbody>
            </x-table>
        @endif
    </div>
</x-app-layout>
