<?php include 'header.php'; ?>

<h3><?php _e($count); ?> <?php echo $lang->t('admin|user_subscriptions'); ?></h3>
<?php include 'flash.php'; ?>

<div class="table-responsive">
    <table class="table table-striped">
    <thead>
    <tr>
        <th><?php echo $lang->t('admin|tbl_id'); ?></th>
        <th><?php echo $lang->t('admin|tbl_email'); ?></th>
        <th><?php echo $lang->t('admin|tbl_category'); ?></th>
        <th><?php echo $lang->t('admin|tbl_city'); ?></th>
        <th><?php echo $lang->t('admin|tbl_last_sent'); ?></th>
        <th><?php echo $lang->t('admin|tbl_action'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php _e($user->id); ?></td>
        <td><a href="mailto:<?php _e($user->email); ?>"><?php _e($user->email); ?></a></td>
        <td><?php if ($user->category_id > 0) { _e($categories[$user->category_id]->name); } ?></td>
        <td><?php if ($user->city_id > 0) { _e($cities[$user->city_id]->name); } ?></td>
        <td><?php _e(niceDate($user->last_sent)); ?></td>
        <td>
            <?php if (!$user->is_confirmed): ?>
                <a type="button" class="btn btn-success btn-xs" title="<?php echo $lang->t('admin|btn_approve'); ?>" href="<?php _e(ADMIN_URL . "subscribers/{$user->id}/approve/{$user->token}"); ?>">
                    <span class="glyphicon glyphicon-ok"></span>
                </a>
            <?php else: ?>
                <a type="button" class="btn btn-warning btn-xs" title="<?php echo $lang->t('admin|btn_deactivate'); ?>" href="<?php _e(ADMIN_URL . "subscribers/{$user->id}/deactivate/{$user->token}"); ?>">
                    <span class="glyphicon glyphicon-minus"></span>
                </a>
            <?php endif; ?>
            <a type="button" class="btn btn-danger btn-xs" title="<?php echo $lang->t('admin|btn_delete'); ?>" href="<?php _e(ADMIN_URL . "subscribers/{$user->id}/delete/{$user->token}"); ?>">
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
    <a href="<?php _e(ADMIN_URL ."subscribers/{$i}"); ?>"><?php _e($i); ?></a>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>