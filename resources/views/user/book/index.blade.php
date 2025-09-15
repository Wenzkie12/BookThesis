<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-light-text dark:text-dark-text">
            Books
        </h2>
    </x-slot>

    <x-success-alert />
    <x-error-alert />

    <div class="py-6 max-w-xl mx-auto px-4 text-light-text dark:text-dark-text">
        <form method="GET" action="{{ route('admin.book.index') }}" class="flex flex-col gap-4 mb-6">
            <input
                type="text"
                name="search"
                placeholder="Search books..."
                value="{{ request('search') }}"
                class="w-full rounded-lg border-gray-300 dark:bg-dark-bg dark:text-dark-text"
            >

            <select
                name="category"
                class="w-full rounded-lg border-gray-300 dark:bg-dark-bg dark:text-dark-text"
            >
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <x-primary-button type="submit" class="w-full justify-center">Search</x-primary-button>
        </form>

        <div class="space-y-6">
            @forelse ($books as $book)
                <div x-data="{ open: false }" class="bg-background shadow rounded-xl p-4 relative space-y-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <h3 class="text-lg font-semibold">
                                {{ $book->title }}
                            </h3>
                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full">
                                {{ $book->quantity }}
                            </span>
                        </div>

                        @can('reserve books')
                            @if ($book->quantity > 0)
                                <x-primary-button @click="open = !open" class="justify-center">
                                    Reserve
                                    <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </x-primary-button>
                            @else
                                <p class="text-sm text-red-500 font-medium">Out of Stock</p>
                            @endif
                        @endcan
                    </div>

                    <div x-show="open" x-transition class="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                        <p><span class="font-medium">Author:</span> {{ $book->author }}</p>
                        <p><span class="font-medium">Published:</span> {{ $book->date_published }}</p>
                        <p><span class="font-medium">Category:</span> {{ $book->category->name ?? 'N/A' }}</p>

                        <x-primary-button
                            @click="$dispatch('open-modal', 'reserve-{{ $book->id }}')"
                            class="mt-2 w-full justify-center"
                        >
                            Continue to Reserve
                        </x-primary-button>
                    </div>

                    <x-modal name="reserve-{{ $book->id }}" :show="false" maxWidth="lg">
                        <x-slot name="title">Reserve Book</x-slot>

                        <div class="space-y-6 p-4 text-gray-800 dark:text-gray-200">
                            <div class="grid gap-2 text-sm">
                                <div class="font-medium text-base text-gray-900 dark:text-gray-100">
                                    {{ $book->title }}
                                </div>

                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Available:</span> {{ $book->quantity }}
                                </div>
                            </div>

                            <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">

                                <div>
                                    <label for="pickup_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Pickup Date
                                    </label>
                                    <input
                                        type="date"
                                        id="pickup_date_{{ $book->id }}"
                                        name="pickup_date"
                                        required
                                        min="{{ now()->toDateString() }}"
                                        max="{{ now()->addDays(14)->toDateString() }}"
                                        class="pickup-date w-full rounded-md border-gray-300 dark:bg-dark-bg dark:text-dark-text focus:ring-primary focus:border-primary"
                                    >
                                </div>

                                <div class="flex justify-end gap-2 pt-2">
                                    <x-secondary-button
                                        type="button"
                                        @click="$dispatch('close-modal', 'reserve-{{ $book->id }}')"
                                        class="justify-center"
                                    >
                                        Cancel
                                    </x-secondary-button>

                                    <x-primary-button type="submit" class="justify-center">
                                        Confirm
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </x-modal>
                </div>
            @empty
                <p class="text-center text-gray-500 mt-12">No books found.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $books->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('input.pickup-date');
            inputs.forEach(input => {
                input.addEventListener('change', function () {
                    const date = new Date(this.value);
                    const day = date.getDay();
                    if ([0, 5, 6].includes(day)) {
                        alert('You cannot reserve books for Friday, Saturday, or Sunday.');
                        this.value = '';
                    }
                });
            });
        });
    </script>
</x-app-layout>
