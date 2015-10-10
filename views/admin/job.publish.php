<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h3 class="text-center">
                <span class="label label-default"><?php echo $lang->t('jobs|step1'); ?></span>
                <span class="label label-default"><?php echo $lang->t('jobs|step2'); ?></span>
                <span class="label label-info"><?php echo $lang->t('jobs|step3'); ?></span>
            </h3>
            <hr />
        </div>
    </div>
    <div class="col-md-2"></div>
</div>      
    <div class="row">
        <div class="col-md-9">
            <h2><?php _e($job->title); ?></h2>
            <small class="muted"><?php echo $lang->t('jobs|posted'); ?> <?php niceDate($job->created); ?></small>
            <h4><?php _e($job->company_name); ?></h4>
            <h4><?php _e($city); ?> (<?php _e($category); ?>)</h4>
            <h4><a href="<?php _e($job->url); ?>"><?php _e($job->url); ?></a></h4>
        </div>
        <div class="col-md-3">
            <?php if ($job->logo != ''): ?>
            <img src="<?php echo ASSET_URL ."images/thumb_{$job->logo}"; ?>" alt="" class="img-thumbnail">
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <hr />
    </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="lead">
                <?php echo Parsedown::instance()->parse($job->description); ?>
            </div>
            <?php if ($job->perks != ''): ?>
                <h2><?php echo $lang->t('jobs|perks'); ?></h2>
                <div class="lead">
                    <?php _e($job->perks); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <?php if ($job->how_to_apply != ''): ?>
    <div class="well">
        <h2><?php echo $lang->t('jobs|how_to_apply'); ?></h2>
        <p class="lead"><?php _e($job->how_to_apply); ?></p>
    </div>
    <?php endif; ?>
<?php include 'footer.php'; ?>