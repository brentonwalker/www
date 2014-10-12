<?php
/**
 * @package WordPress
 * @subpackage WPMedium
 * @since WPMedium 1.0
 */
?>

<?php if ( 'widget' == wpmedium_footer_sidebar_display() || 'both' == wpmedium_footer_sidebar_display() ) { get_sidebar(); } ?>

<?php if ( 'copyright' == wpmedium_footer_sidebar_display() || 'both' == wpmedium_footer_sidebar_display() ) : ?>
			<footer id="mastfoot" class="site-footer">

				<div class="footer-inner">

					<div class="footer-copyright">
						<span class="copyright"><?php wpmedium_copyright(); ?></span>
					</div>

					<div class="footer-credit">
						<span class="credit"><?php wpmedium_credits(); ?></span>
					</div>

				</div>

			</footer><!-- #footer -->
<?php endif; ?>

		</div><!-- .site -->

<?php wp_footer(); ?>

	</body>

</html>