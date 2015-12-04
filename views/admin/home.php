<?php include 'header.php'; ?>

<?php include 'flash.php'; ?>

<div class="row">
  <div class="col-md-6">
    <a class="twitter-timeline" href="https://twitter.com/jobskee_updates" data-widget-id="672612615797866496">Updates by @jobskee_updates</a>
  </div>
  <div class="col-md-6">
    <a class="twitter-timeline"  href="https://twitter.com/hashtag/jobskee" data-widget-id="672617235995725824">#jobskee Tweets</a>
  </div>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>

<h3><?php echo $lang->t('admin|inactive'); ?> <?php echo $lang->t('jobs|jobs'); ?></h3>
<?php foreach($categories as $category): ?>
    <strong><?php _e($category->name); ?> <?php echo $lang->t('jobs|jobs'); ?></strong>
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
            <th width="10%"><?php echo $lang->t('admin|tbl_date'); ?></th>
            <th width="20%"><?php echo $lang->t('admin|tbl_company'); ?></th>
            <th width="40%"><?php echo $lang->t('admin|tbl_title'); ?></th>
            <th width="15%"><?php echo $lang->t('admin|tbl_city'); ?></th>
            <th width="15%"><?php echo $lang->t('admin|tbl_action'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($jobs[$category->id] as $job): ?>
        <tr>
            <td><?php _e(niceDate($job->created)); ?></td>
            <td><?php _e($job->company_name); ?></td>
            <td><a href="<?php _e(ADMIN_URL ."jobs/{$job->id}"); ?>"><?php _e($job->title); ?></a></td>
            <td><?php _e($cities[$job->city]['name']); ?></td>
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
                <a type="button" class="btn btn-success btn-xs" title="<?php echo $lang->t('admin|btn_approve'); ?>" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/activate/" . accessToken($job->id)); ?>">
                    <span class="glyphicon glyphicon-ok"></span>
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
<?php endforeach; ?>

<?php include 'footer.php'; ?>