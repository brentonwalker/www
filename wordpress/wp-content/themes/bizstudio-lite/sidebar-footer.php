<?php global $shortname; ?>
<div id="footer-widget-area" role="complementary">
  <div id="first" class="grid_8 widget-area">
    <ul class="xoxo">
      <?php	if ( ! dynamic_sidebar( 'first-footer-widget-area' ) ) : ?>
      <li id="archives" class="widget-container">
        <h3 class="widget-title">
          <?php _e( 'Archives','bizstudio'); ?>
        </h3>
        <ul>
          <?php wp_get_archives( 'type=monthly' ); ?>
        </ul>
      </li>
      <?php endif; // end first widget area ?>
    </ul>
  </div>
  
  <!-- #first .widget-area -->
  
  <div id="second" class=" grid_8 widget-area">
    <ul class="xoxo">
      <?php	if ( ! dynamic_sidebar( 'second-footer-widget-area' ) ) : ?>
      <li id="meta" class="widget-container">
        <h3 class="widget-title">
          <?php _e( 'Meta', 'bizstudio' ); ?>
        </h3>
        <ul>
          <?php wp_register(); ?>
          <li>
            <?php wp_loginout(); ?>
          </li>
          <?php wp_meta(); ?>
        </ul>
      </li>
      <?php endif; // end second widget area ?>
    </ul>
  </div>
  
  <!-- #second .widget-area -->
  
  <div id="third" class="grid_8 widget-area">
    <ul class="xoxo">
      <?php	if ( ! dynamic_sidebar( 'third-footer-widget-area' ) ) : ?>
      <li id="skt-categories" class="widget-container">
        <h3 class="widget-title">
          <?php _e( 'Categories', 'bizstudio' ); ?>
        </h3>
        <ul>
          <?php wp_list_categories(array('title_li' => __( '','bizstudio' ))); ?>
        </ul>
      </li>
      <?php endif; // end third widget area ?>
    </ul>
  </div>
  <!-- #third .widget-area --> 
</div>
<!-- #footer-widget-area --> 