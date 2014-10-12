<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<?php wp_nav_menu( array( 'theme_location' => 'footer', 'depth' => 1 ) ); ?>
		</div>
		<div class="site-info">
			<div class="container">
				<?php echo apply_filters( 'so_current_credits_siteorigin', sprintf( __( 'Theme by %1$s.', 'so-current' ), '<a href="http://siteorigin.com/" rel="designer">SiteOrigin</a>' ) ); ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>