<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            User List
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-4 items-center">
                <input
                    type="text"
                    name="filter[search]"
                    value="{{ request()->input('filter.search') }}"
                    placeholder="Search users..."
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                    autofocus
                >

                <x-primary-button type="submit" class="w-full sm:w-32 text-sm py-2">
                    Search
                </x-primary-button>

                @if(request()->has('filter.search'))
                    <a href="{{ route('admin.users.index') }}"
                       class="w-full sm:w-20 text-center text-sm py-2 rounded-md border border-accent text-accent hover:bg-accent hover:text-white transition">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <x-table>
            <x-thead>
                <x-tr>
                    <x-th>Name</x-th>
                    <x-th>Email</x-th>
                    <x-th>Verified</x-th>
                    <x-th>Roles</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
            </x-thead>

            <x-tbody>
                @forelse ($users as $user)
                    <x-tr>
                        <x-td>{{ $user->name }}</x-td>
                        <x-td>{{ $user->email }}</x-td>
                        <x-td>
                            @if($user->email_verified_at)
                                <span class="inline-block bg-primary text-white text-xs font-semibold uppercase px-2 py-1 rounded-md">Verified</span>
                            @else
                                <span class="inline-block bg-red-600 text-white text-xs font-semibold uppercase px-2 py-1 rounded-md">Not Verified</span>
                            @endif
                        </x-td>
                        <x-td>
                            @if($user->getRoleNames()->isNotEmpty())
                                @foreach ($user->getRoleNames() as $role)
                                    <span class="inline-block bg-primary text-white text-xs font-semibold uppercase px-2 py-1 rounded-md">{{ $role }}</span>
                                @endforeach
                            @else
                                <span>None</span>
                            @endif
                        </x-td>
                        <x-td>
                            <div class="flex flex-wrap gap-2">
                                {{-- View Profile --}}
                                <a href="{{ route('admin.users.show', $user) }}" class="w-full sm:w-24">
                                    <x-secondary-button type="button" class="w-full text-sm py-2">Profile</x-secondary-button>
                                </a>

                                @can('edit users')
                                    <a href="{{ route('admin.users.edit', $user) }}" class="w-full sm:w-20">
                                        <x-primary-button type="button" class="w-full text-sm py-2">Edit</x-primary-button>
                                    </a>
                                @endcan

                                @can('delete users')
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="w-full sm:w-20" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button type="submit" class="w-full text-sm py-2">Delete</x-danger-button>
                                    </form>
                                @endcan
                            </div>
                        </x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <x-td colspan="5" class="text-center py-6 text-gray-500">
                            No users found.
                        </x-td>
                    </x-tr>
                @endforelse
            </x-tbody>
        </x-table>

        @if(method_exists($users, 'links'))
            <div class="mt-6">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
