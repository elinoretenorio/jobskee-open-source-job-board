<?php include 'header.php'; ?>
<?php include 'search-form.php'; ?>

<h4><?php _e($count); ?> jobs found for <?php _e($terms); ?></h4>
<?php foreach($categories as $category): ?>
<h3><?php _e($category->name); ?> Jobs</h3>
<div class="list-group">
<?php foreach($jobs[$category->id] as $job): ?>
    <a class="list-group-item" href="<?php _e(BASE_URL ."jobs/{$job->id}/". slugify($job->title .' at '. $job->company_name)); ?>">
    <h4>
        <span style="color: #269abc; text-decoration: underline;"><?php _e($job->title); ?></span>&nbsp;
        <span style="color: #000; font-weight: bold;"><?php _e($job->company_name); ?></span>
        <?php if ($job->is_featured): ?><span class="label label-warning">FEATURED</span><?php endif; ?>
        <span class="label label-default pull-right"><?php niceDate($job->created); ?></span>
    </h4>
    </a>
<?php endforeach; ?>
    <a class="list-group-item" href="<?php _e(BASE_URL ."categories/{$category->id}/{$category->url}"); ?>">
        <h5>View all <?php _e($category->name); ?> jobs &rarr;</h5>
    </a>
</div>
<div class="pull-right"><a href="#top">&#094; back to top</a></div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>