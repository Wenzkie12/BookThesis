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
            <?php echo e(__('My Profile')); ?>

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
        <div class="max-w-lg mx-auto px-6">
            <div class="bg-background shadow-md rounded-2xl p-8 flex flex-col items-center space-y-4">
                
                <?php if($profile->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $profile->avatar)); ?>" alt="Avatar" class="w-32 h-32 rounded-full object-cover border">
                <?php else: ?>
                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-sm text-gray-500">
                        No Avatar
                    </div>
                <?php endif; ?>

                
                <h2 class="text-2xl font-semibold text-gray-800"><?php echo e($user->name); ?></h2>
                <p class="text-base text-primary"><?php echo e($user->email); ?></p>

                
                <div class="text-center text-gray-700 text-lg space-y-1">
                    <div><span class="font-semibold">Student ID:</span> <?php echo e($user->student_id ?? 'N/A'); ?></div>
                    <div><span class="font-semibold">Department:</span> <?php echo e($user->department->name ?? 'N/A'); ?></div>
                </div>

                
                <div class="p-2 bg-gray-100 rounded shadow mt-2 cursor-pointer" id="qr-code-container">
                    <div id="qrcode" class="w-[120px] h-[120px] mx-auto"></div>
                    <p class="mt-2 text-xs text-gray-500 text-center">Click QR to copy Student ID</p>
                </div>

                
                <div x-data="{ open: false }" class="w-full mt-4">
                    <button @click="open = !open"
                        class="w-full flex items-center text-center justify-between px-4 py-3 bg-secondary hover:bg-accent rounded text-lg font-semibold">
                        More Information
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                        <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 15l7-7 7 7" />
                        </svg>
                    </button>

                    <div x-show="open" x-collapse class="mt-4 space-y-3 text-gray-700 text-base">
                        <div><span class="font-semibold">Phone:</span> <?php echo e($profile->phone ?? 'N/A'); ?></div>
                        <div><span class="font-semibold">Birthdate:</span>
                            <?php echo e($profile->birthdate ? \Carbon\Carbon::parse($profile->birthdate)->format('F j, Y') : 'N/A'); ?>

                        </div>
                        <div><span class="font-semibold">Age:</span> <?php echo e($profile->age ?? 'N/A'); ?></div>
                        <div><span class="font-semibold">Bio:</span> <?php echo e($profile->bio ?? 'N/A'); ?></div>
                        <div>
                            <span class="font-semibold">Address:</span>
                            <?php echo e(implode(', ', array_filter([$profile->barangay, $profile->city, $profile->province])) ?: 'N/A'); ?>

                        </div>
                        <div><span class="font-semibold">Penalty:</span> ₱<?php echo e(number_format($profile->penalty ?? 0, 2)); ?></div>
                    </div>
                </div>

                
                <a href="<?php echo e(route('userprofile.edit')); ?>" class="w-full mt-6">
                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'w-full text-lg py-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full text-lg py-3']); ?>
                        Edit Profile
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
                </a>
            </div>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var qrData = <?php echo json_encode($profile->qr_code ?? 'NO-STUDENT-ID', 15, 512) ?>;
            new QRCode(document.getElementById("qrcode"), {
                text: qrData,
                width: 120,
                height: 120,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });

            document.getElementById('qr-code-container').addEventListener('click', function() {
                navigator.clipboard.writeText(qrData).then(function() {
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
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/userprofile/show.blade.php ENDPATH**/ ?>