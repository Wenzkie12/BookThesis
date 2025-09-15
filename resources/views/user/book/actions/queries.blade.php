 <form method="GET" action="{{ route('admin.book.index') }}" class="flex flex-wrap gap-3 items-center">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search books..."
                class="border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
            />

            <select
                name="category"
                class="border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
            >
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-accent">
                Search
            </button>

            @if(request()->has('search') || request()->has('category'))
                <a href="{{ route('admin.book.index') }}" class="text-sm text-gray-600 underline ml-2">
                    Reset
                </a>
            @endif
        </form>

        