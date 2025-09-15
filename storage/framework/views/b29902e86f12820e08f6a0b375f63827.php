 <form method="GET" action="<?php echo e(route('admin.book.index')); ?>" class="flex flex-wrap gap-3 items-center">
            <input
                type="text"
                name="search"
                value="<?php echo e(request('search')); ?>"
                placeholder="Search books..."
                class="border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
            />

            <select
                name="category"
                class="border border-primary rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary"
            >
                <option value="">All Categories</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-accent">
                Search
            </button>

            <?php if(request()->has('search') || request()->has('category')): ?>
                <a href="<?php echo e(route('admin.book.index')); ?>" class="text-sm text-gray-600 underline ml-2">
                    Reset
                </a>
            <?php endif; ?>
        </form>

        <?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/user/book/actions/queries.blade.php ENDPATH**/ ?>