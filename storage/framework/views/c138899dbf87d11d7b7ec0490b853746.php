<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-center">Edit Penalty Type</h2>
     <?php $__env->endSlot(); ?>

    <div class="max-w-md mx-auto p-6">
        <form method="POST" action="<?php echo e(route('admin.penaltytype.update', $penaltyType)); ?>" class="bg-background p-4 rounded shadow">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="name" class="block mb-1">Penalty Name</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $penaltyType->name)); ?>" readonly class="w-full border-gray-300 rounded p-2 bg-gray-100 cursor-not-allowed">
            </div>

            <div class="mb-4">
                <label for="amount" class="block mb-1">Amount (₱)</label>
                <input type="number" step="0.01" name="amount" id="amount" value="<?php echo e(old('amount', $penaltyType->amount)); ?>" required class="w-full border-gray-300 rounded p-2">
            </div>

            <div class="flex justify-between">
                <a href="<?php echo e(route('admin.penaltytype.index')); ?>" class="text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/admin/penaltytype/edit.blade.php ENDPATH**/ ?>