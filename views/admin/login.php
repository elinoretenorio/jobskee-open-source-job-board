<?php include 'header.php'; ?>
<?php include 'flash.php'; ?>

<form class="form-horizontal" role="form" method="post" action="<?php _e(BASE_URL .'admin/authenticate'); ?>">
  <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-5">
      <h3><?php echo $lang->t('admin|login_to_admin', APP_NAME); ?></h3>
    </div>
  </div>    
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label"><?php echo $lang->t('admin|email'); ?></label>
    <div class="col-sm-5">
      <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $lang->t('admin|email'); ?>" required />
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label"><?php echo $lang->t('admin|password'); ?></label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $lang->t('admin|password'); ?>" required />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
      <button type="submit" class="btn btn-default"><?php echo $lang->t('link|login'); ?></button>
    </div>
  </div>
</form>
<!-- Jobskee tracker -->
<img src="http://c.statcounter.com/9473250/0/77fcf0a4/1/">
<?php include 'footer.php'; ?>