<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Recycle Bin
        </h2>
    </x-slot>

    <x-success-alert />
    <x-error-alert />

    <div x-data="{ tab: 'book' }" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Tabs -->
        <div class="flex space-x-4 border-b border-gray-200 mb-6">
            <button
                :class="tab === 'book' ? 'border-primary border-b-2 text-primary' : 'text-gray-600 hover:text-primary'"
                class="px-4 py-2 font-semibold"
                @click="tab = 'book'">
                Books
            </button>

            <button
                :class="tab === 'user' ? 'border-primary border-b-2 text-primary' : 'text-gray-600 hover:text-primary'"
                class="px-4 py-2 font-semibold"
                @click="tab = 'user'">
                Users
            </button>

            <button
                :class="tab === 'category' ? 'border-primary border-b-2 text-primary' : 'text-gray-600 hover:text-primary'"
                class="px-4 py-2 font-semibold"
                @click="tab = 'category'">
                Categories
            </button>

            <button
                :class="tab === 'department' ? 'border-primary border-b-2 text-primary' : 'text-gray-600 hover:text-primary'"
                class="px-4 py-2 font-semibold"
                @click="tab = 'department'">
                Departments
            </button>
        </div>

  
        <div>
       
            <div x-show="tab === 'book'" x-cloak>
                <div class="bg-background shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 capitalize">Deleted Books</h3>

                    @if ($deletedBooks->isEmpty())
                        <p class="text-gray-500 italic">No deleted books.</p>
                    @else
                        <table class="min-w-full text-sm text-left border">
                            <thead class="bg-gray-100 font-semibold">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Title</th>
                                    <th class="px-4 py-2 border">Deleted At</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedBooks as $book)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $book->id }}</td>
                                        <td class="px-4 py-2 border">{{ $book->title ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $book->deleted_at->format('F j, Y h:i A') }}</td>
                                        <td class="px-4 py-2 border space-x-2">
                                            <form method="POST" action="{{ route('admin.recycle-bin.restore', ['model' => 'book', 'id' => $book->id]) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <x-primary-button type="submit">Restore</x-primary-button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.recycle-bin.forceDelete', ['model' => 'book', 'id' => $book->id]) }}" class="inline" onsubmit="return confirm('Permanently delete this book?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <!-- Users -->
            <div x-show="tab === 'user'" x-cloak>
                <div class="bg-background shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 capitalize">Deleted Users</h3>

                    @if ($deletedUsers->isEmpty())
                        <p class="text-gray-500 italic">No deleted users.</p>
                    @else
                        <table class="min-w-full text-sm text-left border">
                            <thead class="bg-gray-100 font-semibold">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Deleted At</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedUsers as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                                        <td class="px-4 py-2 border">{{ $user->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $user->deleted_at->format('F j, Y h:i A') }}</td>
                                        <td class="px-4 py-2 border space-x-2">
                                            <form method="POST" action="{{ route('admin.recycle-bin.restore', ['model' => 'user', 'id' => $user->id]) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <x-primary-button type="submit">Restore</x-primary-button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.recycle-bin.forceDelete', ['model' => 'user', 'id' => $user->id]) }}" class="inline" onsubmit="return confirm('Permanently delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            <div x-show="tab === 'department'" x-cloak>
    <div class="bg-background shadow sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4 capitalize">Deleted Departments</h3>

        @if ($deletedDepartments->isEmpty())
            <p class="text-gray-500 italic">No deleted departments.</p>
        @else
            <table class="min-w-full text-sm text-left border">
                <thead class="bg-gray-100 font-semibold">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Department</th>
                        <th class="px-4 py-2 border">Year Level</th>
                        <th class="px-4 py-2 border">Section</th>
                        <th class="px-4 py-2 border">Deleted At</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deletedDepartments as $department)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $department->id }}</td>
                            <td class="px-4 py-2 border">{{ $department->department ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $department->year_level ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $department->section ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $department->deleted_at->format('F j, Y h:i A') }}</td>
                            <td class="px-4 py-2 border space-x-2">
                                <form method="POST" action="{{ route('admin.recycle-bin.restore', ['model' => 'department', 'id' => $department->id]) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <x-primary-button type="submit">Restore</x-primary-button>
                                </form>
                                <form method="POST" action="{{ route('admin.recycle-bin.forceDelete', ['model' => 'department', 'id' => $department->id]) }}" class="inline" onsubmit="return confirm('Permanently delete this department?')">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit">Delete</x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>


            <!-- Categories -->
            <div x-show="tab === 'category'" x-cloak>
                <div class="bg-background shadow sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 capitalize">Deleted Categories</h3>

                    @if ($deletedCategories->isEmpty())
                        <p class="text-gray-500 italic">No deleted categories.</p>
                    @else
                        <table class="min-w-full text-sm text-left border">
                            <thead class="bg-gray-100 font-semibold">
                                <tr>
                                    <th class="px-4 py-2 border">ID</th>
                                    <th class="px-4 py-2 border">Name</th>
                                    <th class="px-4 py-2 border">Deleted At</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletedCategories as $category)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border">{{ $category->id }}</td>
                                        <td class="px-4 py-2 border">{{ $category->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 border">{{ $category->deleted_at->format('F j, Y h:i A') }}</td>
                                        <td class="px-4 py-2 border space-x-2">
                                            <form method="POST" action="{{ route('admin.recycle-bin.restore', ['model' => 'category', 'id' => $category->id]) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <x-primary-button type="submit">Restore</x-primary-button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.recycle-bin.forceDelete', ['model' => 'category', 'id' => $category->id]) }}" class="inline" onsubmit="return confirm('Permanently delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
