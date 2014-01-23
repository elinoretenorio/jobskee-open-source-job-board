<?php include 'header.php'; ?>

<h3>Ban List</h3>
<?php include 'flash.php'; ?>

<div class="row">
    <div class="col-md-9">
        
        <div class="table-responsive">
            <table class="table table-striped">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="20%">Type</th>
                <th width="45%">Value</th>
                <th width="15%">Date Added</th>
                <th width="15%">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($list as $ban): ?>
            <tr>
                <td><?php _e($ban->id); ?></td>
                <td><?php _e($ban->type); ?></td>
                <td><?php _e($ban->value); ?></td>
                <td><?php _e(niceDate($ban->created)); ?></td>
                <td>
                    <a type="button" class="btn btn-danger btn-xs" title="Delete" href="<?php _e(ADMIN_URL . "ban/delete/{$ban->id}"); ?>">
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
        <form class="form" role="form" method="post" action="<?php _e(ADMIN_URL . "ban"); ?>">
          <div class="form-group">
            <select name="type" id="type" class="form-control" required />
                <option value="email">Email Address</option>
                <option value="ip">IP Address</option>
            </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="value" placeholder="Value" required />
          </div>
          <button type="submit" class="btn btn-info">Add to Ban List</button>
        </form>
    </div>
</div>



<ul class="pagination">
  <?php for($i=1;$i<=$number_of_pages;$i++): ?>  
  <li <?php if($current_page == $i) { _e(" class='disabled'"); } ?>>
      <?php if ($page_name == 'ban'): ?>
        <a href="<?php _e(ADMIN_URL ."ban/"); ?>"><?php _e($i); ?></a>
      <?php else: ?>
        <a href="<?php _e(ADMIN_URL ."ban/{$i}"); ?>"><?php _e($i); ?></a>
      <?php endif; ?>
  </li>
  <?php endfor; ?>
</ul>

<?php include 'footer.php'; ?>