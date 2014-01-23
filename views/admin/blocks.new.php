<?php include 'header.php'; ?>

<?php include 'flash.php'; ?>

<div class="row">
  
  <div class="col-md-12">
      
      <form class="form-horizontal" role="form" action="<?php _e(ADMIN_URL); ?>blocks" method="post">
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2>Add New Block</h2>
            </div>
        </div>
       
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label input-lg">Block Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="name" name="name" required />
            </div>
        </div>

        <div class="form-group">
        <label for="url" class="col-sm-3 control-label input-lg">Slug URL</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="url" name="url" placeholder="use dash, no spaces" required />
              <code>The following slugs are not allowed: <br />jobs/*, admin/*, categories/*, cities/* </code>
            </div>
        </div>
          
        <div class="form-group">
            <label for="content" class="col-sm-3 control-label input-lg">Content</label>
            <div class="col-sm-8">
              <textarea id="content" class="form-control input-lg" name="content" rows="15" required ></textarea>
              <p class="help-block">accepts HTML5 tags</p>
            </div>
        </div>
          
        <div class="form-group">
            <div class="text-center">
              <input type="hidden" id="trap" name="trap" value="" />
              <input type="submit" class="btn btn-success btn-lg" value="Submit Block" />
            </div>
        </div>
    </form>
      
  </div>
 
</div>


<?php include 'footer.php'; ?>