<?php include 'header.php'; ?>

<div class="row">
  <div class="col-md-8">
        
       <?php include 'flash.php'; ?>
      
       <div class="form-group">
            <h3>Upload Jobs using CSV File</h3>
            <p>Use this form to bulk upload jobs using a CSV file. Each record is checked whether it has the correct number of fields. When the fields in the CSV do not match the prescribed number of fields, the record is skipped from being uploaded.</p>
            <p>The file should strictly follow the format below (all the fields should be in the same line per job record):</p>
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
                <input type="file" class="filestyle" data-classButton="btn btn-default btn-lg" name="csv" accept="text/csv" required /><br /><br />
                <input class="btn btn-info" type="submit" value="Upload and Import CSV Data" />
            </form>
        </div>
      
  </div>
</div>

<?php include 'footer.php'; ?>