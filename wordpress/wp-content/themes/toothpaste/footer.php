<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package toothpaste
 * @since toothpaste 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">

			<div class="wrapper">
				<div id="footer-widgets">
					<?php dynamic_sidebar( 'sidebar-footer' ) ?>
				</div>
			</div>

			<?php $credits = apply_filters( 'toothpaste_site_info', siteorigin_setting('general_footer_copyright') ); ?>
			
			<?php if(!empty($credits)) : ?>
				<div class="site-info">
					<?php echo $credits ?>
				</div><!-- .site-info -->
			<?php endif; ?>
			
		</div><!-- .container -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>