<x-app-layout>
    <x-slot name="header">
        Create Book
    </x-slot>

    <div class="max-w-lg mx-auto mt-6 bg-background p-6 rounded shadow space-y-6">
   @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST" action="{{ route('admin.book.store') }}">
            @csrf

            <div class="mb-4">
                <label for="category_id" class="block font-medium">Category</label>
                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm text-sm px-3 py-[0.5rem] leading-tight"
                >
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="title" class="block font-medium">Title</label>
                <x-text-input
                    id="title"
                    name="title"
                    type="text"
                    :value="old('title')"
                    required
                    class="w-full"
                />
            </div>

            <div class="mb-4">
                <label for="author" class="block font-medium">Author</label>
                <x-text-input
                    id="author"
                    name="author"
                    type="text"
                    :value="old('author')"
                    required
                    class="w-full"
                />
            </div>

            <div class="mb-4">
                <label for="date_published" class="block font-medium">Year Published</label>
                <select
                    id="date_published"
                    name="date_published"
                    required
                    class="w-full border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm text-sm px-3 py-[0.5rem] leading-tight"
                >
                    <option value="">Select year</option>
                    @for ($year = now()->year; $year >= 1900; $year--)
                        <option value="{{ $year }}" {{ old('date_published') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block font-medium">Quantity</label>
                <x-text-input
                    id="quantity"
                    name="quantity"
                    type="number"
                    min="0"
                    :value="old('quantity', 0)"
                    required
                    class="w-full"
                />
            </div>

            <div class="text-right">
                <x-primary-button type="submit">
                    Create Book
                </x-primary-button>
            </div>
        </form>

        <div class="border-t pt-4">
            <h3 class="text-lg font-semibold mb-2">Import Books via Excel</h3>
            <form action="{{ route('books.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center gap-4">
                    <input
                        type="file"
                        name="file"
                        required
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    >
                    <x-primary-button type="submit">
                        Import
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
