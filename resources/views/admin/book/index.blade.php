<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-light-text dark:text-dark-text">
            Books
        </h2>
    </x-slot>

    <x-success-alert />
    <x-error-alert />

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div class="w-full sm:flex-1">
                    @include('admin.book.actions.queries')
                </div>

                @can('add books')
                    <a href="{{ route('admin.book.create') }}" class="w-full sm:w-auto">
                        <x-primary-button type="button" class="w-full sm:w-48 text-sm py-2">
                            + Add Book
                        </x-primary-button>
                    </a>
                @endcan
            </div>
        </div>

        <x-table>
            <x-thead>
                <x-tr>
                    <x-th>Title</x-th>
                    <x-th>Author</x-th>
                    <x-th>Year</x-th>
                    <x-th>Quantity</x-th>
                    <x-th>Category</x-th>
                    <x-th>Actions</x-th>
                </x-tr>
            </x-thead>

            <x-tbody>
                @forelse ($books as $book)
                    <x-tr>
                        <x-td>{{ $book->title }}</x-td>
                        <x-td>{{ $book->author }}</x-td>
                        <x-td>{{ $book->date_published }}</x-td>
                        <x-td>{{ $book->quantity }}</x-td>
                        <x-td>{{ $book->category->name ?? 'N/A' }}</x-td>
                        <x-td>
                            <div class="flex justify-center flex-wrap gap-2">
                                @include('admin.book.actions.action')
                            </div>
                        </x-td>
                    </x-tr>
                @empty
                    <x-tr>
                        <x-td colspan="6" class="text-center py-6 text-gray-500">
                            No books found.
                        </x-td>
                    </x-tr>
                @endforelse
            </x-tbody>
        </x-table>

        <div class="mt-6">
            {{ $books->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
