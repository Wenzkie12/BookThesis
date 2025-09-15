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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Profile')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ tab: localStorage.getItem('profile-tab') || 'profile' }" x-init="$watch('tab', value => localStorage.setItem('profile-tab', value))">
 
            
            <div class="sm:hidden p-4">
                <label for="tabs" class="sr-only">Select section</label>
                <select
                    id="tabs"
                    class="block w-full rounded-md border-primary text-gray-700 focus:border-primary focus:ring-primary"
                    x-model="tab"
                >
                    <option value="profile"><?php echo e(__('Account')); ?></option>
                    <option value="password"><?php echo e(__('Update Password')); ?></option>
                    <option value="delete"><?php echo e(__('Delete Account')); ?></option>
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
                            <?php echo e(__('Account')); ?>

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
                            <?php echo e(__('Update Password')); ?>

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
                            <?php echo e(__('Delete Account')); ?>

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
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </section>

                <section
                    x-show="tab === 'password'"
                    x-cloak
                    role="tabpanel"
                    aria-labelledby="password-tab"
                    id="password-panel"
                >
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </section>

                <section
                    x-show="tab === 'delete'"
                    x-cloak
                    role="tabpanel"
                    aria-labelledby="delete-tab"
                    id="delete-panel"
                >
                    <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </section>
            </div>
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
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/profile/edit.blade.php ENDPATH**/ ?>