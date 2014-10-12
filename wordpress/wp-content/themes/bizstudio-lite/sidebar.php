<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
*/
?>
<div id="primary" class="widget-area" role="complementary">
  <ul class="xoxo">
    <?php
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
    <li id="archives" class="widget-container">
      <h3 class="widget-title">
        <?php _e( 'Archives','bizstudio' ); ?>
      </h3>
      <ul>
        <?php wp_get_archives( 'type=monthly' ); ?>
      </ul>
    </li>
    <li id="meta" class="widget-container">
      <h3 class="widget-title">
        <?php _e( 'Meta','bizstudio' ); ?>
      </h3>
      <ul>
        <?php wp_register(); ?>
        <li>
          <?php wp_loginout(); ?>
        </li>
        <?php wp_meta(); ?>
      </ul>
    </li>
    <?php endif; // end primary widget area ?>
  </ul>
</div>

<!-- #primary .widget-area -->

<div id="secondary" class="widget-area" role="complementary">
  <ul class="xoxo">
    <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
  </ul>
</div>
<!-- #secondary .widget-area --> 