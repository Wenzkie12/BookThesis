@can('edit books')
                                <a href="{{ route('admin.book.edit', $book) }}">
                                    <x-primary-button>Edit</x-primary-button>
                                </a>
                            @endcan

                            @can('delete books')
                                <form action="{{ route('admin.book.destroy', $book) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this book?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>Delete</x-danger-button>
                                </form>
                            @endcan

                            @can('reserve books')
                            @if ($book->quantity > 0)
                                <form action="{{ route('reservations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <input
                                        type="date"
                                        name="pickup_date"
                                        required
                                        min="{{ now()->toDateString() }}"
                                    >
                                    <x-primary-button>Reserve</x-primary-button>
                                </form>
                            @else
                                <div>Out of Stock</div>
                            @endif
                        @endcan