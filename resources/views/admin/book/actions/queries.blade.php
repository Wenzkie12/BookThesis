<form method="GET" action="{{ route('admin.book.index') }}" class="flex flex-wrap gap-3 items-center">
    <div class="w-full sm:w-auto flex-1">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search books..."
            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-sm"
        />
    </div>

    <div class="w-full sm:w-48">
        <select
            name="category"
            class="w-full border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary text-sm"
        >
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="w-full sm:w-auto flex gap-3">
        <button type="submit" class="w-full sm:w-32 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-accent">
            Search
        </button>

        @if(request()->has('search') || request()->has('category'))
            <a href="{{ route('admin.book.index') }}" class="w-full sm:w-20 text-center text-sm py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                Reset
            </a>
        @endif
    </div>
</form>
