<form method="GET" class="mb-6 max-w-xs relative">
    <label for="period" class="block mb-2 font-semibold text-light-text dark:text-dark-text">
        Select Period:
    </label>

    <div class="relative">
        <select name="period" id="period" onchange="this.form.submit()"
            class="appearance-none border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 w-full bg-light-background dark:bg-dark-background text-light-text dark:text-dark-text focus:ring-2 focus:ring-accent focus:outline-none transition duration-150 ease-in-out pr-10">
            
            <option disabled class="font-bold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">━ Quick Ranges ━</option>
            <option value="today" <?php echo e($period == 'today' ? 'selected' : ''); ?>>Today</option>
            <option value="yesterday" <?php echo e($period == 'yesterday' ? 'selected' : ''); ?>>Yesterday</option>
            <option value="this_week" <?php echo e($period == 'this_week' ? 'selected' : ''); ?>>This Week</option>
            <option value="last_week" <?php echo e($period == 'last_week' ? 'selected' : ''); ?>>Last Week</option>
            <option value="this_year" <?php echo e($period == 'this_year' ? 'selected' : ''); ?>>This Year</option>

            <option disabled class="font-bold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">━ Specific Months ━</option>
            <option value="january" <?php echo e($period == 'january' ? 'selected' : ''); ?>>January</option>
            <option value="february" <?php echo e($period == 'february' ? 'selected' : ''); ?>>February</option>
            <option value="march" <?php echo e($period == 'march' ? 'selected' : ''); ?>>March</option>
            <option value="april" <?php echo e($period == 'april' ? 'selected' : ''); ?>>April</option>
            <option value="may" <?php echo e($period == 'may' ? 'selected' : ''); ?>>May</option>
            <option value="june" <?php echo e($period == 'june' ? 'selected' : ''); ?>>June</option>
            <option value="july" <?php echo e($period == 'july' ? 'selected' : ''); ?>>July</option>
            <option value="august" <?php echo e($period == 'august' ? 'selected' : ''); ?>>August</option>
            <option value="september" <?php echo e($period == 'september' ? 'selected' : ''); ?>>September</option>
            <option value="october" <?php echo e($period == 'october' ? 'selected' : ''); ?>>October</option>
            <option value="november" <?php echo e($period == 'november' ? 'selected' : ''); ?>>November</option>
            <option value="december" <?php echo e($period == 'december' ? 'selected' : ''); ?>>December</option>
        </select>

     
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
            
        </div>
    </div>
</form>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/admin/users/queries.blade.php ENDPATH**/ ?>