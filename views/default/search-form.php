<!-- search -->
<div class="well">
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" method="post" action="<?php _e(BASE_URL . 'search/'); ?>">
            	<input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
                <input type="text" class="form-control input-lg" name="terms" placeholder="<?php echo $lang->t('search|search_for'); ?>">
            </form>
        </div>
        <div class="col-md-4">
            <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
            <a type="button" class="btn btn-info btn-lg btn-block" href="<?php _e(BASE_URL); ?>jobs/new" <?php if (ALLOW_JOB_POST == INACTIVE) { echo 'disabled'; } ?>>
            <?php echo $lang->t('jobs|post_job'); ?>  
            </a>
        </div>
    </div>
</div>