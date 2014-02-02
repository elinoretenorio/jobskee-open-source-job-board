<?php include 'header.php'; ?>
<?php include 'flash.php'; ?>

<form class="form-horizontal" role="form" method="post" action="<?php _e(BASE_URL .'admin/authenticate'); ?>">
  <div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-5">
      <h3>Login to <?php _e(APP_NAME); ?> Admin</h3>
    </div>
  </div>    
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>

<?php include 'footer.php'; ?>