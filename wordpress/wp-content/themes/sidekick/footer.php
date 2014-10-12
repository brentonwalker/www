<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Sidekick
 */
?>

	</div><!-- #main .site-main -->

	<div id="colophon-wrap">
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'superhero_credits' ); ?>
			<!-- <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'sidekick' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'sidekick' ), 'WordPress' ); ?></a> -->
			<span class="sep"> Copyright Brenton Walker and all that good stuff</span>
			<!-- <?php printf( __( 'Theme: %1$s by %2$s.', 'sidekick' ), 'Sidekick', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?> -->
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
	</div><!-- #colophon-wrap -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>
</body>
</html>