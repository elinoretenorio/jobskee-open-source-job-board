        
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
    <script src="<?php _e(THEME_ASSETS); ?>js/bootstrap.min.js"></script>
    <script src="<?php _e(THEME_ASSETS); ?>js/holder.js"></script>
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <?php if (isset($filestyle)): ?>
        <script src="<?php _e(THEME_ASSETS); ?>js/bootstrap-filestyle.min.js"></script>
    <?php endif; ?>
    <?php if (isset($markdown)): ?>
        <script src="<?php _e(ASSET_URL); ?>bootstrap-markdown/js/markdown.js"></script>
        <script src="<?php _e(ASSET_URL); ?>bootstrap-markdown/js/to-markdown.js"></script>
        <script src="<?php _e(ASSET_URL); ?>bootstrap-markdown/js/bootstrap-markdown.js"></script>
    <?php endif; ?>
    
    <?php if (GA_TRACKING != ''): ?>
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
        ga('create', '<?php _e(GA_TRACKING); ?>', 'auto');
        ga('send', 'pageview');
    </script>
    <?php endif; ?>
  </body>
</html>
