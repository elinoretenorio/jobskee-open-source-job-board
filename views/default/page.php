<?php include 'header.php'; ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h2><?php _e($content->name); ?></h2>
        <p class="lead"><?php echo Parsedown::instance()->parse($content->content); ?></p>
    </div>
    <div class="col-md-2"></div>
</div>
<?php include 'footer.php'; ?>