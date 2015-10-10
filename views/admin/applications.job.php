<?php include 'header.php'; ?>
<h3><?php _e($count); ?> <?php echo $lang->t('admin|job_applications'); ?></h3>
<?php if (isset($title) && $title !='' ) :?> 
    <h4><?php echo $lang->t('apply|job_title'); ?>: <a href="<?php _e(ADMIN_URL . "jobs/{$id}"); ?>"><?php _e($title); ?></a></h4>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped">
    <thead>
    <tr>
        <th><?php echo $lang->t('admin|tbl_name'); ?></th>
        <th><?php echo $lang->t('admin|tbl_location'); ?></th>
        <th><?php echo $lang->t('admin|tbl_email'); ?></th>
        <th><?php echo $lang->t('admin|tbl_attachment'); ?></th>
        <th><?php echo $lang->t('admin|tbl_sent'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($applications as $apps): ?>
    <tr>
        <td><?php _e($apps->full_name); ?></td>
        <td><?php _e($apps->location); ?></td>
        <td><?php _e($apps->email); ?></td>
        <td>
            <?php if ($apps->attachment != ''): ?>
            <a href="<?php _e(ASSET_URL . "attachments/{$apps->attachment}"); ?>"><?php echo $lang->t('admin|download'); ?></a>
            <?php endif; ?>
        </td>
        <td><?php _e(niceDate($apps->created)); ?></td>
    </tr>
    <tr>
        <td colspan="6">
            <p><?php _e($apps->cover_letter,'r'); ?></p>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
</div>

<ul class="pagination">
  <?php for($i=1;$i<=$number_of_pages;$i++): ?>  
  <li <?php if($current_page == $i) { _e(" class='disabled'"); } ?>>
    <a href="<?php _e(ADMIN_URL ."applications/jobs/{$apps->job_id}/{$i}"); ?>"><?php _e($i); ?></a>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>