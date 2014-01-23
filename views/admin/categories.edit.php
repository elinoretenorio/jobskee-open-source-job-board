<?php include 'header.php'; ?>

<h3>Manage Categories</h3>
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

        <?php foreach($categs as $cat): ?>
        <tr>
            <td><?php _e($cat->id); ?></td>
            <td><?php _e($cat->name); ?></td>
            <td><?php _e($cat->description); ?></td>
            <td><?php _e($cat->url); ?></td>
            <td><?php _e($cat->sort); ?></td>
            <td>
                <a type="button" class="btn btn-info btn-xs" title="Edit" href="<?php _e(ADMIN_MANAGE . "/categories/{$cat->id}/edit"); ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a type="button" class="btn btn-danger btn-xs" title="Delete" href="<?php _e(ADMIN_MANAGE . "/categories/{$cat->id}/delete"); ?>">
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
    <h4><?php if ($category && $category->name) { echo 'Edit Category ' . "<span class='pull-right'><a href='". ADMIN_MANAGE . '/categories' ."'>Add</a></span>"; } else { _e('Add Category'); } ?></span></h4>
    <form class="form" role="form" method="post" action="<?php _e(ADMIN_MANAGE . '/categories'); ?>">
      <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name" value="<?php if ($category && $category->name) { _e($category->name); } ?>" required />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="description" placeholder="Meta Description" maxlength="150" value="<?php if ($category && $category->description) { _e($category->description); } ?>" required />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="url" placeholder="Slug URL (use dashes)" value="<?php if ($category && $category->url) { _e($category->url); } ?>" required />
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="sort" placeholder="Sort" value="<?php if ($category && $category->sort) { _e($category->sort); } ?>" required />
      </div>
      <input type="hidden" name="id" value="<?php if ($category && $category->id) { _e($category->id); } ?>">
      <button type="submit" class="btn btn-info">Submit Category</button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>