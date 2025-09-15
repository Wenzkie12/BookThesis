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
        <h2 class="font-semibold text-xl text-gray-800 text-center">
            Users with Penalties
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if (isset($component)) { $__componentOriginale9af99bfa2d53af14a65b48d2181bd41 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.success-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $attributes = $__attributesOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__attributesOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41)): ?>
<?php $component = $__componentOriginale9af99bfa2d53af14a65b48d2181bd41; ?>
<?php unset($__componentOriginale9af99bfa2d53af14a65b48d2181bd41); ?>
<?php endif; ?>

        <div class="mb-6 bg-background shadow rounded-md p-4 sm:p-6">
            <form method="GET" action="<?php echo e(route('staff.penalties.users')); ?>" class="flex flex-wrap gap-4 items-center">
                <input 
                    type="text" 
                    name="search" 
                    value="<?php echo e(request('search')); ?>" 
                    placeholder="Search by name" 
                    class="w-full sm:w-64 rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                >

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
                    Search
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

                <?php if(request()->has('search')): ?>
                    <a href="<?php echo e(route('staff.penalties.users')); ?>" 
                       class="text-sm text-accent underline hover:text-accent-dark transition"
                    >
                        Clear
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <?php if($users->count()): ?>
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
<?php $component->withAttributes([]); ?>Name <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes([]); ?>Penalty <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes([]); ?>Action <?php echo $__env->renderComponent(); ?>
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
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $profile = $user->profile; ?>
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
<?php $component->withAttributes([]); ?><?php echo e($user->name); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes([]); ?><?php echo e($user->email); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes([]); ?>₱<?php echo e(number_format($profile->penalty, 2)); ?> <?php echo $__env->renderComponent(); ?>
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
<?php $component->withAttributes([]); ?>
                                <button
                                    x-data
                                    @click="$dispatch('open-modal', '<?php echo e('pay-modal-' . $profile->id); ?>')"
                                    class="bg-primary hover:bg-accent text-white font-semibold px-4 py-2 rounded transition text-sm"
                                >
                                    Pay
                                </button>
                             <?php echo $__env->renderComponent(); ?>
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

                        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => ''.e('pay-modal-' . $profile->id).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e('pay-modal-' . $profile->id).'']); ?>
                            <div class="p-6">
                                <h2 class="text-lg font-semibold mb-4 text-center">Make a Payment for <?php echo e($user->name); ?></h2>
                                <form method="POST" action="<?php echo e(route('payments.store', $profile)); ?>" class="space-y-4">
                                    <?php echo csrf_field(); ?>
                                    <div>
                                        <label for="amount-<?php echo e($profile->id); ?>" class="block text-sm font-medium mb-1">Amount (₱)</label>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'amount-'.e($profile->id).'','name' => 'amount','type' => 'number','step' => '0.01','max' => ''.e($profile->penalty).'','min' => '1','required' => true,'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'amount-'.e($profile->id).'','name' => 'amount','type' => 'number','step' => '0.01','max' => ''.e($profile->penalty).'','min' => '1','required' => true,'class' => 'mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    </div>
                                    <div class="flex justify-end space-x-2 mt-2">
                                        <button type="button"
                                            @click="$dispatch('close-modal', '<?php echo e('pay-modal-' . $profile->id); ?>')"
                                            class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded transition text-sm"
                                        >
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="px-4 py-2 bg-primary hover:bg-accent text-white rounded transition text-sm"
                                        >
                                            Confirm Payment
                                        </button>
                                    </div>
                                </form>
                            </div>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
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

            
        <?php else: ?>
            <p class="text-center text-gray-500 dark:text-gray-400 mt-12">
                No users with penalties.
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
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/staff/penalties/users.blade.php ENDPATH**/ ?>