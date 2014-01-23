<?php include 'header.php'; ?>

<h3>Pages</h3>
<?php include 'flash.php'; ?>

<p class="pull-right">
    <a type="submit" class="btn btn-info btn-md" href="<?php _e(ADMIN_URL . "pages/new"); ?>">Add New Page</a>
</p>

<div class="table-responsive">
    <table class="table table-striped">
    <thead>
    <tr>
        <th width="10%">ID</th>
        <th width="20%">Name</th>
        <th width="45%">Description</th>
        <th width="15%">URL</th>
        <th width="15%">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach($pages as $page): ?>
    <tr>
        <td><a href="<?php _e(ADMIN_URL . "pages/edit/{$page->id}"); ?>"><?php _e($page->id); ?></a></td>
        <td><a href="<?php _e(ADMIN_URL . "pages/edit/{$page->id}"); ?>"><?php _e($page->name); ?></a></td>
        <td><?php _e($page->description); ?></td>
        <td><a href="<?php _e(BASE_URL . $page->url); ?>" target="_blank"><?php _e($page->url); ?></a></td>
        <td>
            <a type="button" class="btn btn-info btn-xs" title="Edit" href="<?php _e(ADMIN_URL . "pages/edit/{$page->id}"); ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a type="button" class="btn btn-danger btn-xs" title="Delete" href="<?php _e(ADMIN_URL . "pages/delete/{$page->id}"); ?>">
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
        <a href="<?php _e(ADMIN_URL ."pages/"); ?>"><?php _e($i); ?></a>
      <?php else: ?>
        <a href="<?php _e(ADMIN_URL ."pages/{$i}"); ?>"><?php _e($i); ?></a>
      <?php endif; ?>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>