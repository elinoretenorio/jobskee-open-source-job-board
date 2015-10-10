<?php include 'header.php'; ?>

<?php foreach($categories as $category): ?>
<a name="<?php _e($category->url); ?>"></a>
<h3><?php _e($category->name); ?> <?php echo $lang->t('jobs|jobs'); ?></h3>
<div class="list-group">
<?php foreach($jobs[$category->id] as $job): ?>
    <a class="list-group-item" href="<?php _e(BASE_URL ."jobs/{$job->id}/". slugify($job->title ." {$lang->t('jobs|at')} ". $job->company_name)); ?>">
    <h4>
        <span style="color: #269abc; text-decoration: underline;"><?php _e($job->title); ?></span>&nbsp;
        <span style="color: #000; font-weight: bold;"><?php _e($job->company_name); ?></span>
        <?php if ($job->is_featured): ?><span class="label label-warning">FEATURED</span><?php endif; ?>
        <span class="label label-default pull-right"><?php niceDate($job->created); ?></span>
    </h4>
    </a>
<?php endforeach; ?>
    <a class="list-group-item" href="<?php _e(BASE_URL ."categories/{$category->id}/{$category->url}"); ?>">
        <h5><?php echo $lang->t('jobs|view_all', $category->name); ?></h5>
    </a>
    
</div>
<p class="pull-right"><a href="#top"><?php echo $lang->t('jobs|back_to_top'); ?></a></p>

<?php endforeach; ?>

<?php include 'footer.php'; ?>