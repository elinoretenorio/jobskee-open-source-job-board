<?php include 'header.php'; ?>

<h3><?php _e($city->name); ?> <?php echo $lang->t('jobs|jobs'); ?></h3>

<div class="table-responsive">
    <table class="table table-striped">
    <thead>
    <tr>
        <th width="10%"><?php echo $lang->t('admin|tbl_date'); ?></th>
        <th width="20%"><?php echo $lang->t('admin|tbl_company'); ?></th>
        <th width="40%"><?php echo $lang->t('admin|tbl_title'); ?></th>
        <th width="15%"><?php echo $lang->t('admin|tbl_category'); ?></th>
        <th width="15%"><?php echo $lang->t('admin|tbl_action'); ?></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($jobs as $job): ?>
    <tr>
        <td><?php _e(niceDate($job->created)); ?></td>
        <td><?php _e($job->company_name); ?></td>
        <td><a href="<?php _e(ADMIN_URL ."jobs/{$job->id}"); ?>"><?php _e($job->title); ?></a></td>
        <td><?php _e($categories[$job->category]['name']); ?></td>
        <td>
            <a type="button" class="btn btn-info btn-xs" title="<?php echo $lang->t('admin|btn_edit'); ?>" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/edit/{$job->token}"); ?>">
                <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <?php if (!$job->is_featured): ?>
                <a type="button" class="btn btn-primary btn-xs" title="<?php echo $lang->t('admin|btn_feature_on'); ?>" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/feature/on/{$job->token}"); ?>">
                    <span class="glyphicon glyphicon-star"></span>
                </a>
            <?php else: ?>
                <a type="button" class="btn btn-default btn-xs" title="<?php echo $lang->t('admin|btn_feature_off'); ?>" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/feature/off/{$job->token}"); ?>">
                    <span class="glyphicon glyphicon-star"></span>
                </a>
            <?php endif; ?>
            <a type="button" class="btn btn-warning btn-xs" title="<?php echo $lang->t('admin|btn_deactivate'); ?>" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/deactivate/" . accessToken($job->id)); ?>">
                <span class="glyphicon glyphicon-minus"></span>
            </a>
            <a type="button" class="btn btn-danger btn-xs" title="<?php echo $lang->t('admin|btn_delete'); ?>" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/delete/{$job->token}"); ?>">
                <span class="glyphicon glyphicon-remove"></span>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

    </tbody>
    </table>
</div>

<ul class="pagination">
  <?php for($i=1;$i<=$number_of_pages;$i++): ?>  
  <li <?php if($current_page == $i) { _e(" class='disabled'"); } ?>>
      <?php if ($page_name == 'home'): ?>
        <a href="<?php _e(ADMIN_URL ."cities/{$city->id}/{$city->url}"); ?>"><?php _e($i); ?></a>
      <?php else: ?>
        <a href="<?php _e(ADMIN_URL ."cities/{$city->id}/{$city->url}/{$i}"); ?>"><?php _e($i); ?></a>
      <?php endif; ?>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>