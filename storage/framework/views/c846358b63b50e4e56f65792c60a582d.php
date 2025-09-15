<?php if($status === 'to_claim'): ?>
    <div class="flex flex-col sm:flex-row sm:items-start gap-2">

        <form action="<?php echo e(route('reservations.cancel', $reservation->id)); ?>" method="POST" onsubmit="return confirm('Cancel this reservation?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <?php if (isset($component)) { $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-button','data' => ['class' => 'bg-red-600 hover:bg-red-500 text-sm px-3 py-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg-red-600 hover:bg-red-500 text-sm px-3 py-1']); ?>
                Cancel
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $attributes = $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $component = $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
        </form>

        <?php if(!$reservation->pickup_date_edited): ?>
            <form action="<?php echo e(route('user.reservations.editPickupDate', $reservation->id)); ?>" method="POST" onsubmit="return confirm('Update pickup date?')" class="flex flex-col sm:flex-row gap-2">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <input 
                    type="date" 
                    name="pickup_date" 
                    class="pickup-date-input border rounded px-2 py-1 text-sm"
                    min="<?php echo e(now()->format('Y-m-d')); ?>" 
                    value="<?php echo e($reservation->pickup_date->format('Y-m-d')); ?>"
                    required
                />
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-1 rounded">
                    Update Pickup Date
                </button>
            </form>
        <?php else: ?>
            <span class="text-xs italic text-gray-400 block mt-1">Pickup date already edited</span>
        <?php endif; ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dateInputs = document.querySelectorAll('.pickup-date-input');
            dateInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const selectedDate = new Date(this.value);
                    const day = selectedDate.getDay();
                    if ([0, 5, 6].includes(day)) {
                        alert('You cannot select Friday, Saturday, or Sunday as the pickup date.');
                        this.value = '';
                    }
                });
            });
        });
    </script>
<?php elseif($status === 'to_return'): ?>
    <form action="<?php echo e(route('user.reservations.declareLost', $reservation->id)); ?>" method="POST" onsubmit="return confirm('Declare this book as lost?')">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        <?php if (isset($component)) { $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-button','data' => ['class' => 'bg-red-600 hover:bg-red-500 text-sm px-3 py-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg-red-600 hover:bg-red-500 text-sm px-3 py-1']); ?>
            Declare Lost
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $attributes = $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $component = $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
    </form>
<?php else: ?>
    <span class="text-gray-400 text-xs italic">No actions</span>
<?php endif; ?>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/user/reservations/partials/actions.blade.php ENDPATH**/ ?>