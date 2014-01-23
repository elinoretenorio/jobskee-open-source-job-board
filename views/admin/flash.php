<!-- flash.php -->
<?php if (isset($flash['danger']) && $flash['danger'] != ''): ?>  
    <div class="alert alert-danger"><?php _e($flash['danger']); ?></div>
<?php elseif (isset($flash['success']) && $flash['success'] != ''): ?>
    <div class="alert alert-success"><?php _e($flash['success']); ?></div>
<?php endif; ?>