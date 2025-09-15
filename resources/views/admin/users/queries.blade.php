<form method="GET" class="mb-6 max-w-xs relative">
    <label for="period" class="block mb-2 font-semibold text-light-text dark:text-dark-text">
        Select Period:
    </label>

    <div class="relative">
        <select name="period" id="period" onchange="this.form.submit()"
            class="appearance-none border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 w-full bg-light-background dark:bg-dark-background text-light-text dark:text-dark-text focus:ring-2 focus:ring-accent focus:outline-none transition duration-150 ease-in-out pr-10">
            
            <option disabled class="font-bold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">━ Quick Ranges ━</option>
            <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Today</option>
            <option value="yesterday" {{ $period == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
            <option value="this_week" {{ $period == 'this_week' ? 'selected' : '' }}>This Week</option>
            <option value="last_week" {{ $period == 'last_week' ? 'selected' : '' }}>Last Week</option>
            <option value="this_year" {{ $period == 'this_year' ? 'selected' : '' }}>This Year</option>

            <option disabled class="font-bold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">━ Specific Months ━</option>
            <option value="january" {{ $period == 'january' ? 'selected' : '' }}>January</option>
            <option value="february" {{ $period == 'february' ? 'selected' : '' }}>February</option>
            <option value="march" {{ $period == 'march' ? 'selected' : '' }}>March</option>
            <option value="april" {{ $period == 'april' ? 'selected' : '' }}>April</option>
            <option value="may" {{ $period == 'may' ? 'selected' : '' }}>May</option>
            <option value="june" {{ $period == 'june' ? 'selected' : '' }}>June</option>
            <option value="july" {{ $period == 'july' ? 'selected' : '' }}>July</option>
            <option value="august" {{ $period == 'august' ? 'selected' : '' }}>August</option>
            <option value="september" {{ $period == 'september' ? 'selected' : '' }}>September</option>
            <option value="october" {{ $period == 'october' ? 'selected' : '' }}>October</option>
            <option value="november" {{ $period == 'november' ? 'selected' : '' }}>November</option>
            <option value="december" {{ $period == 'december' ? 'selected' : '' }}>December</option>
        </select>

     
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
            
        </div>
    </div>
</form>
