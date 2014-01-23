<?php include 'header.php'; ?>
<?php include 'search-form.php'; ?>

<?php include 'flash.php'; ?>
<?php foreach($categories as $category): ?>
<a name="<?php _e($category->url); ?>"></a>
<h3><?php _e($category->name); ?> Jobs</h3>
<div class="list-group">
<?php foreach($jobs[$category->id] as $job): ?>
    <a class="list-group-item <?php if ($job->is_featured): ?>job-highlight<?php endif; ?>" href="<?php _e(BASE_URL ."jobs/{$job->id}/". slugify($job->title .' at '. $job->company_name)); ?>">
    <h4>
        <span class="job-title"><?php _e($job->title); ?></span>&nbsp;
        <span class="job-company"><?php _e($job->company_name); ?></span>
        <span class="badge pull-right"><?php niceDate($job->created); ?></span>
    </h4>
    </a>
<?php endforeach; ?>
    <a class="list-group-item" href="<?php _e(BASE_URL ."categories/{$category->id}/{$category->url}"); ?>">
        <h5>View all <?php _e($category->name); ?> jobs &rarr;</h5>
    </a>
    
</div>
<p class="pull-right"><a href="#top">&#094; back to top</a></p>

<?php endforeach; ?>

<?php include 'footer.php'; ?>