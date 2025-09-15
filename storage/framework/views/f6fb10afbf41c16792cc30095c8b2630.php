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
        <h2 class="font-semibold text-xl text-center text-gray-800">
            Payment Records
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <form method="GET" action="<?php echo e(route('payments.index')); ?>" class="flex flex-wrap gap-4 items-center">
                <input 
                    type="text" 
                    name="search" 
                    value="<?php echo e(request('search')); ?>" 
                    placeholder="Search by name, email, or reference" 
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                >

                <select 
                    name="filter" 
                    class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                >
                    <option value="">All Time</option>
                    <option value="today" <?php echo e(request('filter') === 'today' ? 'selected' : ''); ?>>Today</option>
                    <option value="yesterday" <?php echo e(request('filter') === 'yesterday' ? 'selected' : ''); ?>>Yesterday</option>
                    <option value="last_week" <?php echo e(request('filter') === 'last_week' ? 'selected' : ''); ?>>Last Week</option>
                    <option value="last_month" <?php echo e(request('filter') === 'last_month' ? 'selected' : ''); ?>>Last Month</option>
                    <option value="last_year" <?php echo e(request('filter') === 'last_year' ? 'selected' : ''); ?>>Last Year</option>
                </select>

                <div class="flex gap-2">
                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit','class' => 'text-sm px-4 py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'text-sm px-4 py-2']); ?>
                        Apply
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>

                    <a href="<?php echo e(route('payments.export', request()->query())); ?>">
                        <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['class' => 'text-sm px-4 py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-sm px-4 py-2']); ?>
                            Export to Excel
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $attributes = $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af)): ?>
<?php $component = $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af; ?>
<?php unset($__componentOriginal3b0e04e43cf890250cc4d85cff4d94af); ?>
<?php endif; ?>
                    </a>
                </div>

                <?php if(request()->has('search') || request()->has('filter')): ?>
                    <a href="<?php echo e(route('payments.index')); ?>" 
                       class="text-sm text-accent underline hover:text-accent-dark transition">
                        Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <?php if($payments->count()): ?>
            <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php if (isset($component)) { $__componentOriginal36a132461e62a1bc64933df69e2192b5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36a132461e62a1bc64933df69e2192b5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.thead','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('thead'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <?php if (isset($component)) { $__componentOriginal12c94140e7bbf6927428c65e570fe77d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12c94140e7bbf6927428c65e570fe77d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tr','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tr'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                        <?php if (isset($component)) { $__componentOriginal01458c31083fa607d5bca4115c7452df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01458c31083fa607d5bca4115c7452df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>User Name <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $attributes = $__attributesOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__attributesOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $component = $__componentOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__componentOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal01458c31083fa607d5bca4115c7452df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01458c31083fa607d5bca4115c7452df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Email <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $attributes = $__attributesOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__attributesOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $component = $__componentOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__componentOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal01458c31083fa607d5bca4115c7452df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01458c31083fa607d5bca4115c7452df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Amount <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $attributes = $__attributesOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__attributesOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $component = $__componentOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__componentOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal01458c31083fa607d5bca4115c7452df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01458c31083fa607d5bca4115c7452df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Reference Number <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $attributes = $__attributesOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__attributesOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $component = $__componentOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__componentOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal01458c31083fa607d5bca4115c7452df = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal01458c31083fa607d5bca4115c7452df = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Payment Date <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $attributes = $__attributesOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__attributesOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal01458c31083fa607d5bca4115c7452df)): ?>
<?php $component = $__componentOriginal01458c31083fa607d5bca4115c7452df; ?>
<?php unset($__componentOriginal01458c31083fa607d5bca4115c7452df); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12c94140e7bbf6927428c65e570fe77d)): ?>
<?php $attributes = $__attributesOriginal12c94140e7bbf6927428c65e570fe77d; ?>
<?php unset($__attributesOriginal12c94140e7bbf6927428c65e570fe77d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12c94140e7bbf6927428c65e570fe77d)): ?>
<?php $component = $__componentOriginal12c94140e7bbf6927428c65e570fe77d; ?>
<?php unset($__componentOriginal12c94140e7bbf6927428c65e570fe77d); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36a132461e62a1bc64933df69e2192b5)): ?>
<?php $attributes = $__attributesOriginal36a132461e62a1bc64933df69e2192b5; ?>
<?php unset($__attributesOriginal36a132461e62a1bc64933df69e2192b5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36a132461e62a1bc64933df69e2192b5)): ?>
<?php $component = $__componentOriginal36a132461e62a1bc64933df69e2192b5; ?>
<?php unset($__componentOriginal36a132461e62a1bc64933df69e2192b5); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal15f39b62581c28d3ffab890657d54357 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal15f39b62581c28d3ffab890657d54357 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tbody','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tbody'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginal12c94140e7bbf6927428c65e570fe77d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12c94140e7bbf6927428c65e570fe77d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tr','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tr'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php if (isset($component)) { $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.td','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($payment->profile->user->name ?? 'N/A'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $attributes = $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $component = $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.td','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($payment->profile->user->email ?? 'N/A'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $attributes = $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $component = $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.td','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>₱<?php echo e(number_format($payment->amount, 2)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $attributes = $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $component = $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.td','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($payment->reference_number); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $attributes = $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $component = $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
                            <?php if (isset($component)) { $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.td','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($payment->payment_date ? $payment->payment_date->format('F j, Y g:i A') : 'N/A'); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $attributes = $__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__attributesOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c)): ?>
<?php $component = $__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c; ?>
<?php unset($__componentOriginale4bbc7ac7aa8c098a103fce9117edf6c); ?>
<?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12c94140e7bbf6927428c65e570fe77d)): ?>
<?php $attributes = $__attributesOriginal12c94140e7bbf6927428c65e570fe77d; ?>
<?php unset($__attributesOriginal12c94140e7bbf6927428c65e570fe77d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12c94140e7bbf6927428c65e570fe77d)): ?>
<?php $component = $__componentOriginal12c94140e7bbf6927428c65e570fe77d; ?>
<?php unset($__componentOriginal12c94140e7bbf6927428c65e570fe77d); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal15f39b62581c28d3ffab890657d54357)): ?>
<?php $attributes = $__attributesOriginal15f39b62581c28d3ffab890657d54357; ?>
<?php unset($__attributesOriginal15f39b62581c28d3ffab890657d54357); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal15f39b62581c28d3ffab890657d54357)): ?>
<?php $component = $__componentOriginal15f39b62581c28d3ffab890657d54357; ?>
<?php unset($__componentOriginal15f39b62581c28d3ffab890657d54357); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>

            <div class="mt-6">
                <?php echo e($payments->appends(request()->query())->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-center text-gray-500 dark:text-gray-400 mt-12">
                No payment records found.
            </p>
        <?php endif; ?>
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
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/staff/payments/index.blade.php ENDPATH**/ ?>