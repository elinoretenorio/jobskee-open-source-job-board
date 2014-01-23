<?php include 'header.php'; ?>

<?php include 'flash.php'; ?>
<h3>Inactive Jobs</h3>
<?php foreach($categories as $category): ?>
    <strong><?php _e($category->name); ?> Jobs</strong>
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
            <th width="10%">Date</th>
            <th width="20%">Company</th>
            <th width="40%">Title</th>
            <th width="15%">City</th>
            <th width="15%">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($jobs[$category->id] as $job): ?>
        <tr>
            <td><?php _e(niceDate($job->created)); ?></td>
            <td><?php _e($job->company_name); ?></td>
            <td><a href="<?php _e(ADMIN_URL ."jobs/{$job->id}"); ?>"><?php _e($job->title); ?></a></td>
            <td><?php _e($cities[$job->city]['name']); ?></td>
            <td>
                <a type="button" class="btn btn-info btn-xs" title="Edit" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/edit/{$job->token}"); ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <?php if (!$job->is_featured): ?>
                    <a type="button" class="btn btn-primary btn-xs" title="Feature On" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/feature/on/{$job->token}"); ?>">
                        <span class="glyphicon glyphicon-star"></span>
                    </a>
                <?php else: ?>
                    <a type="button" class="btn btn-default btn-xs" title="Feature Off" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/feature/off/{$job->token}"); ?>">
                        <span class="glyphicon glyphicon-star"></span>
                    </a>
                <?php endif; ?>
                <a type="button" class="btn btn-success btn-xs" title="Approve" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/activate/" . accessToken($job->id)); ?>">
                    <span class="glyphicon glyphicon-ok"></span>
                </a>
                <a type="button" class="btn btn-danger btn-xs" title="Delete" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/delete/{$job->token}"); ?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
        </table>
    </div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>