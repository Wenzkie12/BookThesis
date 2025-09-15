<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Add Department
        </h2>
    </x-slot>

    <div class="py-12 max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <x-success-alert />

        <form action="{{ route('admin.departments.store') }}" method="POST" class="space-y-6 bg-background shadow rounded-md p-6 sm:p-8">
            @csrf

            <div>
                <x-input-label for="department" :value="'Department'" />
                <x-text-input id="department" name="department" type="text" value="{{ old('department') }}" required autofocus class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('department')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="year_level" :value="'Year Level'" />
                <x-text-input id="year_level" name="year_level" type="text" value="{{ old('year_level') }}" required class="mt-1 block w-full" placeholder="e.g., 1st, 2nd" />
                <x-input-error :messages="$errors->get('year_level')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="section" :value="'Section'" />
                <x-text-input id="section" name="section" type="text" value="{{ old('section') }}" required class="mt-1 block w-full" placeholder="e.g., A, B" />
                <x-input-error :messages="$errors->get('section')" class="mt-1" />
            </div>

            <div class="flex justify-end">
                <x-primary-button type="submit">Save Department</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
