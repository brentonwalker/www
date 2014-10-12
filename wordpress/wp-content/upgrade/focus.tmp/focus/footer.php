<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package focus
 * @since focus 1.0
 */
?>

	</div><!-- #main .site-main -->

	<?php do_action('before_footer'); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div id="footer-widgets">
				<?php dynamic_sidebar('sidebar-footer') ?>
			</div>
			<div class="clear"></div>
			
			<div class="site-info">
				<?php do_action( 'focus_credits' ); ?>
			</div><!-- .site-info -->
			
		</div><!-- .container -->
	</footer><!-- #colophon .site-footer -->

	<?php do_action('after_footer'); ?>

</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>