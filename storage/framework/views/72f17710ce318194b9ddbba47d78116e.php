<button <?php echo e($attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-4 py-2 bg-danger bg-opacity-100  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-200 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
])); ?>>
    <?php echo e($slot); ?>

</button>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/components/danger-button.blade.php ENDPATH**/ ?>