<?php if(isset($_SESSION['success'])): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?php echo e($_SESSION['success']); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   <?php echo e($_SESSION['error']); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>


<?php
unset($_SESSION['success']);
unset($_SESSION['error']);
?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/layouts/includes/alert.blade.php ENDPATH**/ ?>