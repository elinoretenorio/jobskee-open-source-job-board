<?php include 'header.php'; ?>
<?php include 'search-form.php'; ?>

<h4><?php _e($count); ?> <?php echo $lang->t('search|jobs_found'); ?> "<?php _e($terms); ?>"</h4>
<?php foreach($categories as $category): ?>
<h3><?php _e($category->name); ?> <?php echo $lang->t('jobs|jobs'); ?></h3>
<div class="list-group">
<?php if (isset($jobs[$category->id])):
foreach($jobs[$category->id] as $job): ?>
    <a class="list-group-item <?php if ($job->is_featured): ?>job-highlight<?php endif; ?>" href="<?php _e(BASE_URL ."jobs/{$job->id}/". slugify($job->title ." {$lang->t('jobs|at')} ". $job->company_name)); ?>">
    <h4>
        <span class="job-title"><?php _e($job->title); ?></span>&nbsp;
        <span class="job-company"><?php _e($job->company_name); ?></span>
        <span class="badge pull-right"><?php niceDate($job->created); ?></span>
    </h4>
    </a>
<?php endforeach; 
endif; ?>
    <a class="list-group-item" href="<?php _e(BASE_URL ."categories/{$category->id}/{$category->url}"); ?>">
        <h5><?php echo $lang->t('jobs|view_all', $category->name); ?></h5>
    </a>
</div>
<div class="pull-right"><a href="#top"><?php echo $lang->t('jobs|back_to_top'); ?></a></div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>