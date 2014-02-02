<?php include 'header.php'; ?>

<?php include 'flash.php'; ?>

<div class="row">
  
  <div class="col-md-12">
      
      <form class="form-horizontal" role="form" action="<?php _e(ADMIN_URL); ?>pages" method="post">
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2>Edit Page</h2>
            </div>
        </div>
       
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label input-lg">Page Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="name" name="name" value="<?php _e($page->name); ?>" required />
            </div>
        </div>

        <div class="form-group">
        <label for="description" class="col-sm-3 control-label input-lg">SEO Meta Description</label>
            <div class="col-sm-8">
              <textarea id="description" name="description" class="form-control input-lg" rows="2" required ><?php _e($page->description); ?></textarea>
            </div>
        </div>
          
        <div class="form-group">
        <label for="url" class="col-sm-3 control-label input-lg">Slug URL</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="url" name="url" placeholder="use dash, no spaces" value="<?php _e($page->url); ?>" required />
            </div>
        </div>
          
        <div class="form-group">
            <label for="content" class="col-sm-3 control-label input-lg">Content</label>
            <div class="col-sm-8">
              <textarea id="content" data-provide="markdown" name="content" rows="15" required ><?php _e($page->content, 'input'); ?></textarea>
              <p class="help-block">accepts <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">MarkDown</a> syntax</p>
            </div>
        </div>
          
        <div class="form-group">
            <div class="text-center">
              <input type="hidden" id="trap" name="trap" value="" />
              <input type="hidden" id="id" name="id" value="<?php _e($page->id); ?>">
              <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
              <input type="submit" class="btn btn-success btn-lg" value="Submit Page" />
            </div>
        </div>
    </form>
      
  </div>
 
</div>


<?php include 'footer.php'; ?>