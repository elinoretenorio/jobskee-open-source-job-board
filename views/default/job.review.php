<?php include 'header.php'; ?>

<div class="row">
  <div class="col-md-12">
      
      <form class="form-horizontal" role="form" action="<?php _e(BASE_URL . "jobs/{$job->id}/publish/{$job->token}"); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <h3 class="text-center">
                <span class="label label-default"><?php echo $lang->t('jobs|step1'); ?></span>
                <span class="label label-info"><?php echo $lang->t('jobs|step2'); ?></span>
                <span class="label label-default"><?php echo $lang->t('jobs|step3'); ?></span>
            </h3>
        </div>
        <hr />
        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2><?php echo $lang->t('jobs|review_ad'); ?></h2>
              <p class="lead"><?php echo $lang->t('jobs|describe_position'); ?></p>
            </div>
        </div>
       
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|title'); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="title" name="title" value="<?php _e($job->title); ?>" required />
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|category'); ?></label>
            <div class="col-sm-6">
                <select name="category" id="category" class="form-control input-lg">
                    <?php foreach($categories as $category): ?>
                    <option value="<?php _e($category->id); ?>" <?php if($category->id == $job->category) { _e("selected"); } ?>><?php _e($category->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
          
        <div class="form-group">
            <label for="city" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|city'); ?></label>
            <div class="col-sm-6">
                <select name="city" id="city" class="form-control input-lg">
                    <?php foreach($cities as $city): ?>
                    <option value="<?php _e($city->id); ?>" <?php if($city->id == $job->city) { _e("selected"); } ?>><?php _e($city->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
          
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|description'); ?></label>
            <div class="col-sm-8">
              <textarea id="description" data-provide="markdown" name="description" rows="15" required ><?php _e($job->description, 'input'); ?></textarea>
            </div>
        </div>
          
        <div class="form-group">
        <label for="perks" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|perks'); ?></label>
            <div class="col-sm-8">
              <textarea id="perks" name="perks" class="form-control input-lg" rows="2"><?php _e($job->perks, 'input'); ?></textarea>
            </div>
        </div>
        <div class="form-group">
        <label for="how_to_apply" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|how_to_apply'); ?></label>
            <div class="col-sm-8">
              <textarea id="how_to_apply" name="how_to_apply" class="form-control input-lg" rows="2"><?php _e($job->how_to_apply, 'input'); ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3"></div>
            <div class="col-sm-8">
              <h2><?php echo $lang->t('jobs|company'); ?></h2>
              <p class="lead"><?php echo $lang->t('jobs|company_info'); ?></p>
            </div>
        </div>

        <div class="form-group">
        <label for="company_name" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|company_name'); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="company_name" name="company_name" value="<?php _e($job->company_name); ?>" required />
            </div>
        </div>
        
        <?php if ($job->logo != ''): ?>
        <div class="form-group">
        <label for="current_logo" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|logo'); ?></label>
            <div class="col-sm-8">
              <img src="<?php echo ASSET_URL ."images/thumb_{$job->logo}"; ?>" alt="" class="img-thumbnail">
            </div>
        </div>
        <?php endif; ?>
        
        <div class="form-group">
        <label for="logo" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|logo'); ?></label>
            <div class="col-sm-8">
              <input type="file" class="filestyle" data-classButton="btn btn-default btn-lg" id="logo" name="logo" accept="image/*" data-buttonText="<?php echo $lang->t('jobs|btn_logo'); ?>" />
            </div>
        </div>

        <div class="form-group">
        <label for="url" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|website'); ?></label>
            <div class="col-sm-8">
              <input type="url" class="form-control input-lg" id="url" name="url" value="<?php _e($job->url); ?>" />
            </div>
        </div>
        <div class="form-group">
        <label for="email" class="col-sm-3 control-label input-lg"><?php echo $lang->t('jobs|email'); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control input-lg" id="email_muted" name="email_muted" value="<?php _e($job->email); ?>" disabled />
            </div>
        </div>
          
        <div class="form-group">
            <div class="text-center">
                <input type="hidden" name="id" value="<?php _e($job->id); ?>" />
                <input type="hidden" name="token" value="<?php _e($job->token); ?>" />
                <input type="hidden" name="trap" value="" />
                <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
                <input type="submit" class="btn btn-success btn-lg" value="<?php echo $lang->t('jobs|btn_submit'); ?>" />
            </div>
        </div>
    </form>
      
  </div>
  
</div>

<?php include 'footer.php'; ?>