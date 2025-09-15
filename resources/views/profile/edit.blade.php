<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ tab: localStorage.getItem('profile-tab') || 'profile' }" x-init="$watch('tab', value => localStorage.setItem('profile-tab', value))">
 
            
            <div class="sm:hidden p-4">
                <label for="tabs" class="sr-only">Select section</label>
                <select
                    id="tabs"
                    class="block w-full rounded-md border-primary text-gray-700 focus:border-primary focus:ring-primary"
                    x-model="tab"
                >
                    <option value="profile">{{ __('Account') }}</option>
                    <option value="password">{{ __('Update Password') }}</option>
                    <option value="delete">{{ __('Delete Account') }}</option>
                </select>
            </div>

            <nav class="hidden sm:block">
                <ul class="flex space-x-6 px-4 sm:px-6" role="tablist" aria-label="Profile sections">
                    <li>
                        <button
                            @click="tab = 'profile'"
                            :class="tab === 'profile' ? 'border-primary text-primary font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="inline-flex items-center border-b-2 px-3 pt-3 pb-2 text-sm focus:outline-none"
                            role="tab"
                            :aria-selected="tab === 'profile'"
                            aria-controls="profile-panel"
                            id="profile-tab"
                        >
                            {{ __('Account') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="tab = 'password'"
                            :class="tab === 'password' ? 'border-primary text-primary font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="inline-flex items-center border-b-2 px-3 pt-3 pb-2 text-sm focus:outline-none"
                            role="tab"
                            :aria-selected="tab === 'password'"
                            aria-controls="password-panel"
                            id="password-tab"
                        >
                            {{ __('Update Password') }}
                        </button>
                    </li>
                    <li>
                        <button
                            @click="tab = 'delete'"
                            :class="tab === 'delete' ? 'border-primary text-primary font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="inline-flex items-center border-b-2 px-3 pt-3 pb-2 text-sm focus:outline-none"
                            role="tab"
                            :aria-selected="tab === 'delete'"
                            aria-controls="delete-panel"
                            id="delete-tab"
                        >
                            {{ __('Delete Account') }}
                        </button>
                    </li>
                </ul>
            </nav>

            <div class="p-6 max-w-xl">
                <section
                    x-show="tab === 'profile'"
                    x-cloak
                    role="tabpanel"
                    aria-labelledby="profile-tab"
                    id="profile-panel"
                >
                    @include('profile.partials.update-profile-information-form')
                </section>

                <section
                    x-show="tab === 'password'"
                    x-cloak
                    role="tabpanel"
                    aria-labelledby="password-tab"
                    id="password-panel"
                >
                    @include('profile.partials.update-password-form')
                </section>

                <section
                    x-show="tab === 'delete'"
                    x-cloak
                    role="tabpanel"
                    aria-labelledby="delete-tab"
                    id="delete-panel"
                >
                    @include('profile.partials.delete-user-form')
                </section>
            </div>
        </div>

</x-app-layout>
