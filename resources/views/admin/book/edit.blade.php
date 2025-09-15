<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            {{ isset($book) ? 'Edit Book' : 'Create Book' }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-md mx-auto bg-background p-6 rounded shadow">
        <x-info-alert />

        <form method="POST" action="{{ isset($book) ? route('admin.book.update', $book) : route('admin.books.store') }}">
            @csrf
            @if(isset($book))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="title" class="block font-medium mb-1">Title</label>
                <input id="title" name="title" type="text"
                       value="{{ old('title', $book->title ?? '') }}"
                       placeholder="Title" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary" />
                @error('title') <p class="text-danger mt-1 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="block font-medium mb-1">Author</label>
                <input id="author" name="author" type="text"
                       value="{{ old('author', $book->author ?? '') }}"
                       placeholder="Author" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary" />
                @error('author') <p class="text-danger mt-1 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="date_published" class="block font-medium mb-1">Year Published</label>
                <input id="date_published" name="date_published" type="number" min="1900" max="{{ date('Y') }}"
                       value="{{ old('date_published', $book->date_published ?? '') }}"
                       placeholder="Year"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary" />
                @error('date_published') <p class="text-danger mt-1 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="quantity" class="block font-medium mb-1">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="0"
                       value="{{ old('quantity', $book->quantity ?? 0) }}" required
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary" />
                @error('quantity') <p class="text-danger mt-1 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="block font-medium mb-1">Category</label>
                <select id="category_id" name="category_id" required
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-danger mt-1 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="text-right">
                <x-primary-button type="submit">
                    {{ isset($book) ? 'Update' : 'Create' }}
                </x-primary-button>
            </div>
        </form>

      

    </div>
</x-app-layout>
