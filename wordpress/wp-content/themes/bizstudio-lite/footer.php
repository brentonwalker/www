<?php global $shortname; ?>

<div class="clear"></div>
</div>

<!-- #main -->

<div class="clear"></div>
</div>

<!--wrappermid-->

<div id="wrapper-down" class="container_24 clearfix"> 
  
  <!-- #footer -->
  
  <div id="footer">
    <div id="colophon">
      <?php get_sidebar( 'footer' ); ?>
    </div>
    
    <!-- #colophon --> 
    
  </div>
  
  <!-- #footer --> 
  
</div>

<!--wrapperbottom--> 

<!-- #site-info -->

<div id="site-info" class="clearfix">
  <div class="container_24">
    <div class="left">
      <div class="copyright_text">
        <?php if(sketch_get_option($shortname."_copyright")){ echo (sketch_get_option($shortname."_copyright"));} ?>
      </div>
    </div>
    <div class="right">
      <?php _e('BizStudio by','bizstudio'); ?>
      <a  class="biz-link" href="http://www.sketchthemes.com/" target="_blank" title="Sketch Themes">
      <?php _e('Sketch Themes','bizstudio'); ?>
      </a></div>
  </div>
</div>

<!-- #site-info -->

</div>

<!-- #wrapper -->

<div class="clear"></div>
<?php wp_footer(); ?>
</body></html>