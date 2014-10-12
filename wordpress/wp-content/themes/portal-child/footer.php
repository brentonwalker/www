<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package portal
 * @since portal 1.0
 * @license GPL 2.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="social-links">
			<?php
			$social = array(
				'twitter',
				'facebook',
				'dribbble',
				'flickr',
				'google',
				'youtube',
				'vimeo',
				'behance',
				'forrst',
				'github',
				'paypal',
				'wordpress',
			);
			foreach($social as $network){
				if(siteorigin_setting('social_'.$network) == '') continue;

				?><a href="<?php echo esc_url(siteorigin_setting('social_'.$network)) ?>" class="social-<?php echo $network ?>" <?php siteorigin_setting_editable('social_'.$network) ?>><img src="<?php echo get_template_directory_uri() ?>/images/social/<?php echo esc_attr($network) ?>.png" /></a><?php
			}
			?>
		</div>

<div class="site-info">
Copyright Brenton Walker
</div>
		<!-- <div class="site-info" <?php siteorigin_setting_editable('text_footer_copyright') ?>>
			<?php do_action( 'portal_credits' ); ?>
		</div><!-- .site-info --> -->


	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>

</body>
</html>