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
        <h2 class="font-semibold text-xl text-light-text dark:text-dark-text leading-tight">
            <?php echo e(__('QR Timelog Scanner')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-light-secondary dark:bg-dark-secondary">
        <div class="max-w-xl mx-auto bg-background dark:bg-dark-accent shadow rounded p-6 space-y-6">

            <div class="flex space-x-2">
                <button onclick="openScanner('time-in')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded w-full">
                    Time In
                </button>
                <button onclick="openScanner('time-out')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded w-full">
                    Time Out
                </button>
            </div>

            <div id="scanner-container" class="hidden">
                <div id="qr-reader" style="width: 100%;" class="border rounded"></div>
                <p id="scan-status" class="mt-2 text-sm text-center text-gray-700"></p>
            </div>

            <div class="space-y-2">
                <input type="text" id="manual-qr" placeholder="Enter Student ID" class="w-full border rounded px-4 py-2 text-gray-800" />
                <button onclick="submitManual()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full">
                    Submit Manually
                </button>
            </div>

            <p id="manual-status" class="text-sm text-center text-gray-700"></p>

        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        let html5QrCode;
        let currentAction = null;

        function openScanner(action) {
            currentAction = action;
            document.getElementById('scanner-container').classList.remove('hidden');
            document.getElementById('scan-status').innerText = `Scanning for ${action.replace('-', ' ').toUpperCase()}...`;

            if (html5QrCode) {
                html5QrCode.clear();
            }

            html5QrCode = new Html5Qrcode("qr-reader");

            Html5Qrcode.getCameras().then(devices => {
                if (devices.length === 0) {
                    document.getElementById('scan-status').innerText = 'No camera found.';
                    return;
                }

                html5QrCode.start(
                    devices[0].id,
                    { fps: 10, qrbox: 250 },
                    (decodedText) => {
                        html5QrCode.stop().then(() => {
                            submitScan(decodedText);
                        });
                    },
                    (errorMessage) => {
                        // Ignore scan errors
                    }
                );
            }).catch(err => {
                document.getElementById('scan-status').innerText = 'Camera error: ' + err;
            });
        }

        function submitScan(qr_code) {
            fetch(`/scan/${currentAction}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ qr_code })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('scan-status').innerText = data.success || data.error || 'Unknown response.';
            })
            .catch(() => {
                document.getElementById('scan-status').innerText = 'Submission error.';
            });
        }

        function submitManual() {
            const qr_code = document.getElementById('manual-qr').value.trim();
            if (!qr_code) {
                document.getElementById('manual-status').innerText = 'Please enter a Student ID.';
                return;
            }

            if (!currentAction) {
                document.getElementById('manual-status').innerText = 'Please select Time In or Time Out first.';
                return;
            }

            document.getElementById('manual-status').innerText = 'Submitting...';

            fetch(`/scan/${currentAction}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ qr_code })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('manual-status').innerText = data.success || data.error || 'Unknown response.';
            })
            .catch(() => {
                document.getElementById('manual-status').innerText = 'Submission error.';
            });
        }
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
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/timelog/scanner.blade.php ENDPATH**/ ?>