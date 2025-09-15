<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-[#1f1f1f] text-[#ffffff]">
        <div class="w-full max-w-lg bg-[#6b6b6b] shadow-md rounded-lg p-6 relative">

            <!-- Back Button -->
            <a href="{{ route('roles.index') }}"
                class="absolute -top-4 -left-4 bg-[#42ff68] text-[#1f1f1f] px-3 py-1 rounded-md shadow hover:bg-[#36cc52] transition text-sm font-medium">
                ← Back
            </a>

            <h2 class="text-2xl font-semibold text-center text-[#ffffff] mb-4">
                Assign Permissions to Role: 
                <span class="text-[#42ff68]">{{ $role->name }}</span>
            </h2>

            <form action="{{ route('roles.store-permissions', $role) }}" method="POST">
                @csrf

                <h3 class="text-lg font-medium text-[#ffffff] mb-3">Available Permissions:</h3>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    @foreach ($permissions as $permission)
                        <div class="flex items-center space-x-2">
                            <input 
                                type="checkbox" 
                                name="permissions[]" 
                                id="permission-{{ $permission->id }}"
                                value="{{ $permission->name }}" 
                                {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}
                                class="rounded border-[#666] bg-[#1f1f1f] text-[#42ff68] focus:ring-[#42ff68]"
                            >
                            <label for="permission-{{ $permission->id }}" class="text-[#ffffff]">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center space-x-4">
                    <button type="submit" 
                        class="w-full bg-[#42ff68] text-[#1f1f1f] py-2 px-4 rounded-md shadow hover:bg-[#36cc52] transition">
                        Save Permissions
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
