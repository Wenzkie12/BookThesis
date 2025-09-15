@if (Auth::user()->hasRole('admin'))
    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        {{ __('Account') }}
    </x-nav-link>


    @php
        $libraryActive = request()->routeIs('admin.category.index') || request()->routeIs('admin.book.index') || request()->routeIs('admin.departments.index') || request()->routeIs('admin.recycle-bin.index');
    @endphp
    <x-dropdown align="left" width="48">
        <x-slot name="trigger">
            <div class="inline-flex items-center cursor-pointer px-1 pt-1 text-sm font-medium leading-5 {{ $libraryActive ? 'text-primary' : 'text-text' }} hover:text-accent focus:outline-none focus:text-accent transition duration-150 ease-in-out">
                <div>Library Management</div>
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('admin.category.index')" :active="request()->routeIs('admin.category.index')">
                {{ __('Categories') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('admin.book.index')" :active="request()->routeIs('admin.book.index')">
                {{ __('Books') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('admin.departments.index')" :active="request()->routeIs('admin.departments.index')">
                {{ __('Departments') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('admin.recycle-bin.index')" :active="request()->routeIs('admin.recycle-bin.index')">
                {{ __('Trashed') }}
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>

    @php
        $userMgmtActive = request()->routeIs('roles.index') || request()->routeIs('permissions.index') || request()->routeIs('admin.users.index');
    @endphp
    <x-dropdown align="left" width="48">
        <x-slot name="trigger">
            <div class=" bg-background inline-flex items-center cursor-pointer px-1 pt-1 text-sm font-medium leading-5 {{ $userMgmtActive ? 'text-primary' : 'text-text' }} hover:text-accent focus:outline-none focus:text-accent transition duration-150 ease-in-out">
                <div>User Management</div>
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                {{ __('Roles') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('permissions.index')" :active="request()->routeIs('permissions.index')">
                {{ __('Permissions') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
                {{ __('Users') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('admin.penaltytype.index')" :active="request()->routeIs('admin.penaltytype.index')">
                {{ __('Penalty Types') }}
                
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>

    

    @php
        $attendanceActive = request()->routeIs('timelog.scanner') || request()->routeIs('timelog.index');
    @endphp
    <x-dropdown align="left" width="48">
        <x-slot name="trigger">
            <div class="inline-flex items-center cursor-pointer px-1 pt-1 text-sm font-medium leading-5 {{ $attendanceActive ? 'text-primary' : 'text-text' }} hover:text-accent focus:outline-none focus:text-accent transition duration-150 ease-in-out">
                <div>Attendance</div>
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('timelog.scanner')" :active="request()->routeIs('timelog.scanner')">
                {{ __('QR Scan') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('timelog.index')" :active="request()->routeIs('timelog.index')">
                {{ __('TimeLog') }}
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>

@elseif (Auth::user()->hasRole('staff'))
    <x-nav-link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        {{ __('Account') }}
    </x-nav-link>
    <x-nav-link :href="route('userprofile.show')" :active="request()->routeIs('userprofile.show')">
        {{ __('Profile') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.book.index')" :active="request()->routeIs('admin.book.index')">
        {{ __('Books') }}
    </x-nav-link>
    <x-nav-link :href="route('staff.reservations.index')" :active="request()->routeIs('staff.reservations.index')">
        {{ __('Reservations') }}
    </x-nav-link>
    <x-nav-link :href="route('staff.penalties.index')" :active="request()->routeIs('staff.penalties.index')">
        {{ __('Penalties') }}
    </x-nav-link>
    <x-nav-link :href="route('staff.penalties.users')" :active="request()->routeIs('staff.penalties.users')">
        {{ __('User w/ Penalty') }}
    </x-nav-link>
    <x-nav-link :href="route('staff.payments.users')" :active="request()->routeIs('staff.payments.users')">
        {{ __('Payments') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
        {{ __('Users') }}
    </x-nav-link>
    <x-nav-link :href="route('timelog.scanner')" :active="request()->routeIs('timelog.scanner')">
        {{ __('Qr Scan') }}
    </x-nav-link>

@else
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
        {{ __('Account') }}
    </x-nav-link>
    <x-nav-link :href="route('userprofile.show')" :active="request()->routeIs('userprofile.show')">
        {{ __('Profile') }}
    </x-nav-link>
    <x-nav-link :href="route('admin.book.index')" :active="request()->routeIs('admin.book.index')">
        {{ __('Books') }}
    </x-nav-link>
    <x-nav-link :href="route('user.reservations.index')" :active="request()->routeIs('user.reservations.index')">
        {{ __('Reservations') }}
    </x-nav-link>
@endif

<div class="md:hidden bg-background">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-nav-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-nav-link>
    </form>
</div>

<div class="hidden lg:flex lg:items-center lg:ms-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <div class="inline-flex items-center cursor-pointer px-1 pt-1 text-sm font-medium leading-5 text-text hover:text-accent focus:outline-none focus:text-accent transition duration-150 ease-in-out">
                @if (Auth::user()->profile?->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->profile->avatar) }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover border">
                @else
                    <div class="h-8 w-8 rounded-full bg-background flex items-center justify-center text-[10px] text-gray-500 border">
                        No Avatar
                    </div>
                @endif
                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-gray-700 hover:bg-gray-100 px-4 py-2 rounded-md transition">
                    {{ __('Log Out') }}
                </button>
            </form>
        </x-slot>
    </x-dropdown>
</div>
