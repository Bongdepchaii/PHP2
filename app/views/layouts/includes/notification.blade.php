@if (isset($_SESSION['success']) || isset($_SESSION['error']) || isset($_SESSION['warning']) || isset($_SESSION['info']))
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

            @if (isset($_SESSION['success']))
                Toast.fire({
                    icon: 'success',
                    title: "{{ $_SESSION['success'] }}"
                });
                <?php unset($_SESSION['success']); ?>
            @endif

            @if (isset($_SESSION['error']))
                Toast.fire({
                    icon: 'error',
                    title: "{{ $_SESSION['error'] }}"
                });
                <?php unset($_SESSION['error']); ?>
            @endif

            @if (isset($_SESSION['warning']))
                Toast.fire({
                    icon: 'warning',
                    title: "{{ $_SESSION['warning'] }}"
                });
                <?php unset($_SESSION['warning']); ?>
            @endif

            @if (isset($_SESSION['info']))
                Toast.fire({
                    icon: 'info',
                    title: "{{ $_SESSION['info'] }}"
                });
                <?php unset($_SESSION['info']); ?>
            @endif
        });
    </script>
@endif
