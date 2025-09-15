<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo new \Illuminate\Support\EncodedHtmlString($user->name); ?>,

This is a reminder that your reservation for the book **<?php echo new \Illuminate\Support\EncodedHtmlString($reservation->book->title); ?>** is about to expire in 1 hour.

Please return the book by the due date to avoid penalties.

<?php $__env->startComponent('mail::panel'); ?>
If you have any questions, feel free to contact us.
<?php echo $__env->renderComponent(); ?>

Regards,  
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\Wendil Rey\Desktop\Libsys\Capstone\resources\views/emails/due-reminder.blade.php ENDPATH**/ ?>