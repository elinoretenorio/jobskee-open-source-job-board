<?php include 'header.php'; ?>
<?php include 'search-form.php'; ?>

<?php include 'flash.php'; ?>
<h3><?php _e($city->name); ?> <?php echo $lang->t('jobs|jobs'); ?> <a href="<?php _e(BASE_URL ."cities/{$city->id}/{$city->url}/rss"); ?>" target="_blank" class="badge job-rss">RSS</a></h3>
<div class="list-group">
<?php foreach($jobs as $job): ?>
    <a class="list-group-item <?php if ($job->is_featured): ?>job-highlight<?php endif; ?>" href="<?php _e(BASE_URL ."jobs/{$job->id}/". slugify($job->title ." {$lang->t('jobs|at')} ". $job->company_name)); ?>">
    <h4>
        <span class="job-title"><?php _e($job->title); ?></span>&nbsp;
        <span class="job-company"><?php _e($job->company_name); ?></span>
        <span class="badge pull-right"><?php niceDate($job->created); ?></span>
    </h4>
    </a>
<?php endforeach; ?>  
</div>

<form class="form-inline" role="form" method="post" action="<?php _e(BASE_URL . "subscribe/new"); ?>">
  <div class="form-group">
    <input type="email" class="form-control input-lg" id="email" name="email" placeholder="<?php echo $lang->t('jobs|enter_email'); ?>" required />
    <input type="hidden" name="category_id" value="0" />
    <input type="hidden" name="city_id" value="<?php echo $city->id; ?>" />
    <input type="hidden" name="trap" value="" />
    <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
  </div>
  <button type="submit" class="btn btn-default btn-lg"><?php echo $lang->t('jobs|subscribe_to', $city->name); ?></button>
</form>

<ul class="pagination">
  <?php for($i=1;$i<=$number_of_pages;$i++): ?>  
  <li <?php if($current_page == $i) { _e(" class='disabled'"); } ?>>
      <?php if ($page_name == 'home'): ?>
        <a href="<?php _e(BASE_URL ."cities/{$city->id}/{$city->url}"); ?>"><?php _e($i); ?></a>
      <?php else: ?>
        <a href="<?php _e(BASE_URL ."cities/{$city->id}/{$city->url}/{$i}"); ?>"><?php _e($i); ?></a>
      <?php endif; ?>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>