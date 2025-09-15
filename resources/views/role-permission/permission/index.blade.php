<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <div class="mb-4 flex justify-end">
            <a href="{{ route('permissions.create') }}" class="w-full sm:w-48">
                <x-primary-button type="button" class="w-full text-sm py-2">
                    + Create Permission
                </x-primary-button>
            </a>
        </div>

        @if ($permissions->isEmpty())
            <div class="text-center text-gray-500 py-6 text-lg">
                No permissions available. Create a new permission to get started.
            </div>
        @else
            <x-table>
                <x-thead>
                    <x-tr>
                        <x-th>Permission Name</x-th>
                        <x-th>Actions</x-th>
                    </x-tr>
                </x-thead>

                <x-tbody>
                    @foreach ($permissions as $permission)
                        <x-tr>
                            <x-td>
                                <span class="uppercase">{{ $permission->name }}</span>
                            </x-td>
                            <x-td>
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('permissions.edit', $permission) }}" class="w-full sm:w-20">
                                        <x-primary-button type="button" class="w-full text-sm py-2">Edit</x-primary-button>
                                    </a>

                                    <form action="{{ route('permissions.destroy', $permission) }}" 
                                          method="POST" 
                                          class="w-full sm:w-20"
                                          onsubmit="return confirm('Are you sure you want to delete this permission?')">
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
