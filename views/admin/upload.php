<?php include 'header.php'; ?>

<div class="row">
  <div class="col-md-8">
        
       <?php include 'flash.php'; ?>
      
       <div class="form-group">
            <h3><?php echo $lang->t('admin|upload_title'); ?></h3>
            <p><?php echo $lang->t('admin|upload_text1'); ?></p>
            <p><?php echo $lang->t('admin|upload_text2'); ?></p>
            <p><code>
                    "Title", 
                    "Category ID", 
                    "City ID", 
                    "Description", 
                    "Perks (optional)",
                    "How to Apply",<br />
                    "Company Name",
                    "Website", 
                    "Email Address",
                    "Featured (use the word 'featured' to indicate)"
                </code></p>
            <form class="form-horizontal" role="form" action="<?php _e(ADMIN_URL .'jobs/upload'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
                <input type="file" class="filestyle" data-classButton="btn btn-default btn-lg" name="csv" accept="text/csv" data-buttonText="<?php echo $lang->t('jobs|btn_file'); ?>" required /><br /><br />
                <input class="btn btn-info" type="submit" value="<?php echo $lang->t('admin|btn_upload'); ?>" />
            </form>
        </div>
      
  </div>
</div>

<?php include 'footer.php'; ?>