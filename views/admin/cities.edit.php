<?php include 'header.php'; ?>

<h3>Manage Cities</h3>
<?php include 'flash.php'; ?>


<div class="row">
  <div class="col-md-9">
    
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
        <tr>
            <th width="5%">ID</th>
            <th width="20%">Name</th>
            <th width="40%">Meta Description</th>
            <th width="15%">URL</th>
            <th width="10%">Sort</th>
            <th width="10%">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($cits as $cit): ?>
        <tr>
            <td><?php _e($cit->id); ?></td>
            <td><?php _e($cit->name); ?></td>
            <td><?php _e($cit->description); ?></td>
            <td><?php _e($cit->url); ?></td>
            <td><?php _e($cit->sort); ?></td>
            <td>
                <a type="button" class="btn btn-info btn-xs" title="Edit" href="<?php _e(ADMIN_MANAGE . "/cities/{$cit->id}/edit"); ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a type="button" class="btn btn-danger btn-xs" title="Delete" href="<?php _e(ADMIN_MANAGE . "/cities/{$cit->id}/delete"); ?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>
        </table>
    </div>
      
  </div>
<div class="col-md-3">
    <h4><?php if ($city && $city->name) { echo 'Edit City '  . "<span class='pull-right'><a href='". ADMIN_MANAGE . '/cities' ."'>Add</a></span>"; } else { _e('Add City'); } ?></h4>
    <form class="form" role="form" method="post" action="<?php _e(ADMIN_MANAGE . '/cities'); ?>">
      <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php if ($city && $city->name) { _e($city->name); } ?>" required />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="description" placeholder="Meta Description" maxlength="150" value="<?php if ($city && $city->description) { _e($city->description); } ?>" required />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="url" placeholder="Slug URL (use dashes)" value="<?php if ($city && $city->url) { _e($city->url); } ?>" required />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="sort" placeholder="Sort" value="<?php if ($city && $city->sort) { _e($city->sort); } ?>" required />
      </div>
      <input type="hidden" name="id" value="<?php if ($city && $city->id) { _e($city->id); } ?>">
      <input type="hidden" name="<?php _e($csrf_key); ?>" value="<?php _e($csrf_token); ?>">
      <button type="submit" class="btn btn-info">Submit City</button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>