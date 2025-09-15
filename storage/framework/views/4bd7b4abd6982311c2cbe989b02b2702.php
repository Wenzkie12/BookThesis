<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo new \Illuminate\Support\EncodedHtmlString($user->name); ?>,

Your payment has been successfully recorded.

**Amount Paid:** ₱<?php echo new \Illuminate\Support\EncodedHtmlString(number_format($payment->amount, 2)); ?>  
**Reference Number:** <?php echo new \Illuminate\Support\EncodedHtmlString($payment->reference_number); ?>  
**Date:** <?php echo new \Illuminate\Support\EncodedHtmlString($payment->payment_date->format('F d, Y h:i A')); ?>


<?php $__env->startComponent('mail::panel'); ?>
Thank you for settling your penalty.
<?php echo $__env->renderComponent(); ?>

Regards,  
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/emails/payment/receipt.blade.php ENDPATH**/ ?>