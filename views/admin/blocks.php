<?php include 'header.php'; ?>

<h3><?php echo $lang->t('admin|site_blocks'); ?></h3>
<?php include 'flash.php'; ?>

<p class="pull-right">
    <a type="submit" class="btn btn-info btn-md" href="<?php _e(ADMIN_URL . "blocks/new"); ?>"><?php echo $lang->t('admin|btn_add_new'); ?> <?php echo $lang->t('admin|site_blocks'); ?></a>
</p>

<div class="table-responsive">
    <table class="table table-striped">
    <thead>
    <tr>
        <th width="10%"><?php echo $lang->t('admin|tbl_id'); ?></th>
        <th width="25%"><?php echo $lang->t('admin|tbl_name'); ?></th>
        <th width="55%">PHP Embed</th>
        <th width="10%"><?php echo $lang->t('admin|tbl_action'); ?></th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($blocks as $block): ?>
    <tr>
        <td><a href="<?php _e(ADMIN_URL . "blocks/edit/{$block->id}"); ?>"><?php _e($block->id); ?></a></td>
        <td><a href="<?php _e(ADMIN_URL . "blocks/edit/{$block->id}"); ?>"><?php _e($block->name); ?></a></td>
        <td><code>Blocks::showBlockBySlug('<?php _e($block->url); ?>');</code><br /><code>Blocks::showBlockByID(<?php _e($block->id); ?>);</code></td>
        <td>
            <a type="button" class="btn btn-info btn-xs" title="Edit" href="<?php _e(ADMIN_URL . "blocks/edit/{$block->id}"); ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a type="button" class="btn btn-danger btn-xs" title="Delete" href="<?php _e(ADMIN_URL . "blocks/delete/{$block->id}"); ?>">
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
        <a href="<?php _e(ADMIN_URL ."blocks/"); ?>"><?php _e($i); ?></a>
      <?php else: ?>
        <a href="<?php _e(ADMIN_URL ."blocks/{$i}"); ?>"><?php _e($i); ?></a>
      <?php endif; ?>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>