<?php include 'header.php'; ?>

<h3><?php _e($categ->name); ?> Jobs</h3>

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

    <?php foreach($jobs as $job): ?>
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
            <a type="button" class="btn btn-warning btn-xs" title="Deactivate" href="<?php _e(ADMIN_URL . "jobs/{$job->id}/deactivate/" . accessToken($job->id)); ?>">
                <span class="glyphicon glyphicon-minus"></span>
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

<ul class="pagination">
  <?php for($i=1;$i<=$number_of_pages;$i++): ?>  
  <li <?php if($current_page == $i) { _e(" class='disabled'"); } ?>>
      <?php if ($page_name == 'home'): ?>
        <a href="<?php _e(ADMIN_URL ."categories/{$categ->id}/{$categ->url}"); ?>"><?php _e($i); ?></a>
      <?php else: ?>
        <a href="<?php _e(ADMIN_URL ."categories/{$categ->id}/{$categ->url}/{$i}"); ?>"><?php _e($i); ?></a>
      <?php endif; ?>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>