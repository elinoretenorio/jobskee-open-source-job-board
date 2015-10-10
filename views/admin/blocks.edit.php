<?php include 'header.php'; ?>

<?php include 'flash.php'; ?>

<div class="row">
  
  <div class="col-md-12">
      
      <form class="form-horizontal" role="form" action="<?php _e(ADMIN_URL); ?>blocks" method="post">
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2><?php echo $lang->t('admin|btn_edit'); ?> <?php echo $lang->t('admin|site_blocks'); ?></h2>
            </div>
        </div>
       
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label input-lg"><?php echo $lang->t('admin|block_name'); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="name" name="name" value="<?php _e($block->name); ?>" required />
            </div>
        </div>

        <div class="form-group">
        <label for="url" class="col-sm-3 control-label input-lg"><?php echo $lang->t('admin|slug_url'); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="url" name="url" placeholder="<?php echo $lang->t('admin|slug_placeholder'); ?>" value="<?php _e($block->url); ?>" required />
              <code><?php echo $lang->t('admin|slug_not_allowed'); ?></code>
            </div>
        </div>
          
        <div class="form-group">
            <label for="content" class="col-sm-3 control-label input-lg"><?php echo $lang->t('admin|content'); ?></label>
            <div class="col-sm-8">
              <textarea id="content" class="form-control input-lg" name="content" rows="15" required ><?php _e($block->content, 'input'); ?></textarea>
              <p class="help-block"><?php echo $lang->t('admin|content_html'); ?></p>
            </div>
        </div>
          
        <div class="form-group">
            <div class="text-center">
              <input type="hidden" id="trap" name="trap" value="" />
              <input type="hidden" id="id" name="id" value="<?php _e($block->id); ?>">
              <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
              <input type="submit" class="btn btn-success btn-lg" value="<?php echo $lang->t('admin|btn_submit'); ?>" />
            </div>
        </div>
    </form>
      
  </div>
 
</div>


<?php include 'footer.php'; ?>