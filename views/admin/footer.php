        
        <div class="row" id="footer">
            <hr />
            <div class="col-md-12">
                
                <p class="text-muted credit">&copy; <?php _e(APP_NAME); ?></p>
             </div>
        </div>
    
    </div> <!-- /container -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php _e(ADMIN_ASSETS); ?>js/bootstrap.min.js"></script>
    <script src="<?php _e(ADMIN_ASSETS); ?>js/holder.js"></script>
    
    <?php if (isset($filestyle)): ?>
        <script src="<?php _e(ADMIN_ASSETS); ?>js/bootstrap-filestyle.min.js"></script>
    <?php endif; ?>
    <?php if (isset($markdown)): ?>
        <script src="<?php _e(ASSET_URL); ?>bootstrap-markdown/js/markdown.js"></script>
        <script src="<?php _e(ASSET_URL); ?>bootstrap-markdown/js/to-markdown.js"></script>
        <script src="<?php _e(ASSET_URL); ?>bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <?php endif; ?>
  </body>
</html>