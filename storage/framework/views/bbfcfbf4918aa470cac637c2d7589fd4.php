<form method="GET" action="<?php echo e(route('admin.book.index')); ?>" class="flex flex-wrap gap-3 items-center">
    <div class="w-full sm:w-auto flex-1">
        <input
            type="text"
            name="search"
            value="<?php echo e(request('search')); ?>"
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
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                    <?php echo e($category->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="w-full sm:w-auto flex gap-3">
        <button type="submit" class="w-full sm:w-32 bg-primary text-white px-4 py-2 rounded-md text-sm hover:bg-accent">
            Search
        </button>

        <?php if(request()->has('search') || request()->has('category')): ?>
            <a href="<?php echo e(route('admin.book.index')); ?>" class="w-full sm:w-20 text-center text-sm py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                Reset
            </a>
        <?php endif; ?>
    </div>
</form>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/admin/book/actions/queries.blade.php ENDPATH**/ ?>