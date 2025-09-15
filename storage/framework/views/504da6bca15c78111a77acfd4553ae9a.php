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
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            <?php echo e($user->name); ?>'s Profile
        </h2>
     <?php $__env->endSlot(); ?>

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
    <?php if (isset($component)) { $__componentOriginal77fd9efcb5c702035bf9fe4d5e501c6e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal77fd9efcb5c702035bf9fe4d5e501c6e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('error-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal77fd9efcb5c702035bf9fe4d5e501c6e)): ?>
<?php $attributes = $__attributesOriginal77fd9efcb5c702035bf9fe4d5e501c6e; ?>
<?php unset($__attributesOriginal77fd9efcb5c702035bf9fe4d5e501c6e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal77fd9efcb5c702035bf9fe4d5e501c6e)): ?>
<?php $component = $__componentOriginal77fd9efcb5c702035bf9fe4d5e501c6e; ?>
<?php unset($__componentOriginal77fd9efcb5c702035bf9fe4d5e501c6e); ?>
<?php endif; ?>

    <div class="py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-background dark:bg-dark-secondary shadow rounded-xl p-6 flex flex-col items-center space-y-6 text-center">
                
                <?php if($user->profile?->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $user->profile->avatar)); ?>" alt="Avatar" class="w-36 h-36 rounded-full object-cover border-4 border-primary shadow-md">
                <?php else: ?>
                    <div class="w-36 h-36 rounded-full bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                        No Avatar
                    </div>
                <?php endif; ?>

                
                <div>
                    <h2 class="text-2xl font-bold text-gray-800"><?php echo e($user->name); ?></h2>
                    <p class="text-sm text-primary"><?php echo e($user->email); ?></p>
                </div>

                
                <div class="cursor-pointer text-sm" id="qr-code-container">
                    <div id="qrcode" class="w-[100px] h-[100px] mx-auto"></div>
                    <p class="mt-2 text-xs text-gray-500">Tap QR to copy Student ID</p>
                </div>

                
                <div x-data="{ open: false }" class="w-full mt-6">
                    <button @click="open = !open" class="w-full bg-primary text-white px-4 py-2 rounded-md font-medium hover:bg-opacity-80 transition">
                        <?php echo e(__('View Details')); ?>

                    </button>

                    <div x-show="open" x-collapse class="mt-4 space-y-2 text-left text-gray-700 dark:text-gray-200">
                        <p><span class="font-semibold">Student ID:</span> <?php echo e($user->profile?->qr_code ?? 'N/A'); ?></p>
                        <p><span class="font-semibold">Department:</span> <?php echo e($user->department->name ?? 'N/A'); ?></p>
                        <p><span class="font-semibold">Phone:</span> <?php echo e($user->profile?->phone ?? 'N/A'); ?></p>
                        <p>
                            <span class="font-semibold">Birthdate:</span>
                            <?php echo e($user->profile?->birthdate ? \Carbon\Carbon::parse($user->profile->birthdate)->format('F j, Y') : 'N/A'); ?>

                        </p>
                        <p><span class="font-semibold">Age:</span> <?php echo e($user->profile?->age ?? 'N/A'); ?></p>
                        <p><span class="font-semibold">Bio:</span> <?php echo e($user->profile?->bio ?? 'N/A'); ?></p>
                        <p>
                            <span class="font-semibold">Address:</span>
                            <?php echo e(implode(', ', array_filter([$user->profile?->barangay, $user->profile?->city, $user->profile?->province])) ?: 'N/A'); ?>

                        </p>
                        <p><span class="font-semibold">Penalty:</span> ₱<?php echo e(number_format($user->profile?->penalty ?? 0, 2)); ?></p>
                    </div>
                </div>

                <a href="<?php echo e(route('admin.users.index')); ?>" class="w-full mt-6">
                    <?php if (isset($component)) { $__componentOriginal3b0e04e43cf890250cc4d85cff4d94af = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3b0e04e43cf890250cc4d85cff4d94af = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.secondary-button','data' => ['class' => 'w-full text-base py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full text-base py-2']); ?>
                        ← Back to User List
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
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var qrData = <?php echo json_encode($user->profile?->qr_code ?? 'NO-STUDENT-ID', 15, 512) ?>;
            new QRCode(document.getElementById("qrcode"), {
                text: qrData,
                width: 100,
                height: 100,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            document.getElementById('qr-code-container').addEventListener('click', function () {
                navigator.clipboard.writeText(qrData).then(function () {
                    alert('Student ID copied to clipboard');
                });
            });
        });
    </script>
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
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/admin/users/show.blade.php ENDPATH**/ ?>