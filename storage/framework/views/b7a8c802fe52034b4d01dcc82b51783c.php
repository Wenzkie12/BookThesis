<?php if(session('error')): ?>
    <div id="error-alert"
         class="fixed inset-0 flex items-center justify-center pointer-events-none z-50">
        <div
            class="bg-danger bg-opacity-80 text-white px-10 py-6 rounded-lg shadow-xl text-center font-semibold pointer-events-auto transition-opacity duration-500 text-xl max-w-xl"
            style="opacity: 1;">
            <?php echo e(session('error')); ?>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alert = document.getElementById('error-alert');
            if (alert) {
                setTimeout(() => {
                    alert.firstElementChild.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 2000);
            }
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/components/error-alert.blade.php ENDPATH**/ ?>