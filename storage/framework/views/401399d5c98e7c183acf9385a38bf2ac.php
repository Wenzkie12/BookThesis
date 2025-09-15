<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Library')); ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('image/logo.jpg')); ?>">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body
    x-data="{ open: false }"
    :class="{ 'overflow-hidden': open }"
    class="bg-background text-text overflow-y-auto"
>
    <div class="min-h-screen p-4 relative flex flex-col gap-4">
        <?php if(isset($header)): ?>
            <header 
                class="bg-background shadow rounded-xl px-4 py-2 flex items-center justify-between text-sm sticky top-0 z-50"
            >
          
                <div class="flex items-center gap-2">
                    <a href="/dashboard">
                        <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'w-8 h-8 fill-current text-gray-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-8 h-8 fill-current text-gray-500']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                    </a>
                    <span class="text-base font-semibold">Library System</span>
                </div>

                
                <div class="hidden md:flex items-center space-x-6">
                    <?php echo $__env->make('layouts.links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

               
                <div class="md:hidden">
                    <button @click="open = !open" class="focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path :class="{ 'hidden': open, 'block': !open }" class="block" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{ 'hidden': !open, 'block': open }" class="hidden" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

           
                <div 
                    x-show="open" 
                    x-cloak 
                    class="fixed inset-0 top-[4.5rem] bg-background z-40 p-6 overflow-y-auto md:hidden"
                >
                    <div class="flex flex-col space-y-4">
                        <?php echo $__env->make('layouts.links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </header>
        <?php endif; ?>

      
        <main class="flex-1 bg-background rounded-xl p-6 shadow z-0">
            <?php echo e($slot); ?>

        </main>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/layouts/app.blade.php ENDPATH**/ ?>