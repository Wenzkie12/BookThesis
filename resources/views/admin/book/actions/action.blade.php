<div class="flex flex-wrap gap-2 justify-center">
    @can('edit books')
        <a href="{{ route('admin.book.edit', $book) }}" class="w-full sm:w-20">
            <x-primary-button type="button" class="w-full text-sm py-2">Edit</x-primary-button>
        </a>
    @endcan

    @can('delete books')
        <form action="{{ route('admin.book.destroy', $book) }}"
              method="POST"
              class="w-full sm:w-20"
              onsubmit="return confirm('Are you sure you want to delete this book?')">
            @csrf
            @method('DELETE')
            <x-danger-button type="submit" class="w-full text-sm py-2">Delete</x-danger-button>
        </form>
    @endcan

    @can('reserve books')
        @if ($book->quantity > 0)
            <form action="{{ route('reservations.store') }}" method="POST" class="flex flex-wrap gap-2 w-full sm:w-auto justify-center items-center">
                @csrf
                <input
                    type="hidden"
                    name="book_id"
                    value="{{ $book->id }}"
                >
                <input
                    type="date"
                    name="pickup_date"
                    required
                    min="{{ now()->toDateString() }}"
                    class="w-full sm:w-36 border border-primary rounded-md px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary"
                >
                <x-primary-button type="submit" class="w-full sm:w-24 text-sm py-2">Reserve</x-primary-button>
            </form>
        @else
            <div class="w-full text-center text-sm text-red-600">Out of Stock</div>
        @endif
    @endcan
</div>
