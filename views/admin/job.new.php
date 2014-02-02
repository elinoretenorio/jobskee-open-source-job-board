<?php include 'header.php'; ?>

<div class="row">
  
  <div class="col-md-12">
      
      <form class="form-horizontal" role="form" action="<?php _e(ADMIN_URL); ?>jobs/review" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <h3 class="text-center">
                <span class="label label-info">Step 1: Create</span>
                <span class="label label-default">Step 2: Review</span>
                <span class="label label-default">Step 3: Publish</span>
            </h3>
        </div>
        <hr />
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2>Create your ad</h2>
              <p class="lead">Describe this position in details</p>
            </div>
        </div>
       
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label input-lg">Title</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="title" name="title" required />
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-3 control-label input-lg">Category</label>
            <div class="col-sm-6">
                <select name="category" id="category" class="form-control input-lg">
                    <?php foreach($categories as $category): ?>
                    <option value="<?php _e($category->id); ?>"><?php _e($category->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
          
        <div class="form-group">
            <label for="city" class="col-sm-3 control-label input-lg">City</label>
            <div class="col-sm-6">
                <select name="city" id="city" class="form-control input-lg">
                    <?php foreach($cities as $city): ?>
                    <option value="<?php _e($city->id); ?>"><?php _e($city->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
          
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label input-lg">Description</label>
            <div class="col-sm-8">
              <textarea id="description" data-provide="markdown" name="description" rows="15" required ></textarea>
              <p class="help-block">accepts <a href="http://daringfireball.net/projects/markdown/syntax" target="_blank">MarkDown</a> syntax</p>
            </div>
        </div>
          
        <div class="form-group">
        <label for="perks" class="col-sm-3 control-label input-lg">Perks</label>
            <div class="col-sm-8">
              <textarea id="perks" name="perks" class="form-control input-lg" rows="2"></textarea>
            </div>
        </div>
        <div class="form-group">
        <label for="how_to_apply" class="col-sm-3 control-label input-lg">How to Apply</label>
            <div class="col-sm-8">
              <textarea id="how_to_apply" name="how_to_apply" class="form-control input-lg" rows="2"></textarea>
            </div>
        </div>

        
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2>Your company</h2>
              <p class="lead">Provide your company information</p>
            </div>
        </div>

        <div class="form-group">
        <label for="company_name" class="col-sm-3 control-label input-lg">Company name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="company_name" name="company_name" required />
            </div>
        </div>

        <div class="form-group">
        <label for="logo" class="col-sm-3 control-label input-lg">Logo</label>
            <div class="col-sm-8">
              <input type="file" class="filestyle" data-classButton="btn btn-default btn-lg" id="logo" name="logo" accept="image/*" data-buttonText="Select your logo" />
            </div>
        </div>

        <div class="form-group">
        <label for="url" class="col-sm-3 control-label input-lg">Website</label>
            <div class="col-sm-8">
              <input type="url" class="form-control input-lg" id="url" name="url" />
            </div>
        </div>
        <div class="form-group">
        <label for="email" class="col-sm-3 control-label input-lg">Email</label>
            <div class="col-sm-8">
              <input type="email" class="form-control input-lg" id="email" name="email" required />
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2>Feature this ad</h2>
              <p class="lead"><input type="checkbox" id="is_featured" name="is_featured" /> Yes, feature this ad.</p>
            </div>
        </div>
          
        <div class="form-group">
            <div class="text-center">
              <input type="hidden" id="token" name="token" value="<?php _e($token); ?>" />
              <input type="hidden" id="trap" name="trap" value="" />
              <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
              <input type="submit" class="btn btn-success btn-lg" value="Review your ad" />
            </div>
        </div>
    </form>
      
  </div>
 
</div>

<?php include 'footer.php'; ?>