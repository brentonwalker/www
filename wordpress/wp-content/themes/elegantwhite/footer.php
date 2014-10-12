<?php $elegantwhite_options = get_option('elegantwhite_options'); ?>
<div class="line-footer"></div>


<?php if ( has_nav_menu( 'footer-nav' ) ) { ?><div id="footer-nav"><?php wp_nav_menu( array('theme_location' => 'footer-nav', 'fallback_cb' => 'elegantwhite_fb_footer', 'depth' => 1, 'menu_class' => 'footer-menu' )); ?></div><?php } ?>

<?php if ( isset( $elegantwhite_options['footer_text'] ) && ! empty($elegantwhite_options['footer_text']) )
echo '<div id="footer-text">';
    echo esc_html( $elegantwhite_options['footer_text'] );
    echo '</div>'; ?>
    
    <div id="footer-credit"><?php elegantwhite_footer_text(); ?></div>
    
<?php wp_footer(); ?>
</body>
</html>