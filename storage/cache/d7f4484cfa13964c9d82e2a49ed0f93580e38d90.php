<?php if(isset($_SESSION['success']) || isset($_SESSION['error']) || isset($_SESSION['warning']) || isset($_SESSION['info'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            <?php if(isset($_SESSION['success'])): ?>
                Toast.fire({
                    icon: 'success',
                    title: "<?php echo e($_SESSION['success']); ?>"
                });
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                Toast.fire({
                    icon: 'error',
                    title: "<?php echo e($_SESSION['error']); ?>"
                });
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['warning'])): ?>
                Toast.fire({
                    icon: 'warning',
                    title: "<?php echo e($_SESSION['warning']); ?>"
                });
                <?php unset($_SESSION['warning']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['info'])): ?>
                Toast.fire({
                    icon: 'info',
                    title: "<?php echo e($_SESSION['info']); ?>"
                });
                <?php unset($_SESSION['info']); ?>
            <?php endif; ?>
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/layouts/includes/notification.blade.php ENDPATH**/ ?>