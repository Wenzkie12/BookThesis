<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Categories
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <div class="flex justify-end">
                <a href="{{ route('admin.category.create') }}" class="w-full sm:w-40">
                    <x-primary-button type="button" class="w-full text-sm py-2">
                        Add Category
                    </x-primary-button>
                </a>
            </div>
        </div>

        <x-table>
            <x-thead>
                <x-tr>
                    <x-th>Name</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
            </x-thead>

            <x-tbody>
                @forelse ($categories as $category)
                    <x-tr>
                        <x-td>{{ $category->name }}</x-td>
                        <x-td>
                            <div class="flex flex-wrap gap-2 justify-center">
                                <a href="{{ route('admin.category.edit', $category) }}" class="w-full sm:w-20">
                                    <x-primary-button type="button" class="w-full text-sm py-2">Edit</x-primary-button>
                                </a>
                                <form action="{{ route('admin.category.destroy', $category) }}" 
                                      method="POST" 
                                      class="w-full sm:w-20"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit" class="w-full text-sm py-2">Delete</x-danger-button>
                                </form>
                            </div>
                        </x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <x-td colspan="2" class="text-center py-6 text-gray-500">
                            No categories found.
                        </x-td>
                    </x-tr>
                @endforelse
            </x-tbody>
        </x-table>
    </div>
</x-app-layout>
