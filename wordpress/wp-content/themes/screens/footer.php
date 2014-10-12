<footer id="footer">
    <div class="container">
<?php if (is_singular( 'page-portfolio' )) { ?>
		<ul id="portfolio-list">
			<?php
			$loop = new WP_Query( array('post_type' => 'page-portfolio', 'posts_per_page' => 4, 'orderby' => 'rand')); ?>
			<?php if ( $loop ) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<li class="four columns  all captionfull">
				<?php
				if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
					the_post_thumbnail('box');
				} else { echo '<img src="' . get_template_directory_uri() . '/images/post_thumb.jpg" />';
				}
				?>
				<div class="gallery_title"><h3><a title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?>&raquo;</a></h3></div>
				<?php endwhile; endif; wp_reset_postdata(); ?>
		</ul>

<?php } else {  if ( is_active_sidebar( 'first-footer-widget-area' ) && ! is_home()) :
 ?>
		<div class="eight columns">
			<ul class="widget">
				<?php dynamic_sidebar('first-footer-widget-area'); ?>
			</ul>
		</div>
		<?php  endif;
			if ( is_active_sidebar( 'second-footer-widget-area' ) && ! is_home() ) :
		?>
		<div class="eight columns">
			<ul class="widget">
				<?php dynamic_sidebar('second-footer-widget-area'); ?>
			</ul>
		</div>
<?php endif; } ?>

<div class="sixteen columns">
<?php
global $NHP_Options;
$footer_right = $NHP_Options -> get('code1');
$footer_left = $NHP_Options -> get('code3');
if ($footer_left) :
echo '<p class="alignleft footermenu">' . $footer_left . '</p>';?>
			<?php else : ?>
			<ul class="footermenu alignleft">
				<li>
					<?php wp_register('', ', '); ?>
				</li>
				<li>
					<?php wp_loginout(); ?>,
				</li>
				<li>
					<a href="<?php echo esc_url(__('http://wordpress.org/', 'screens')); ?>" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'screens'); ?>"><abbr title="WordPress">WP</abbr></a>,
				</li>
				<li>
					<a href="<?php echo esc_url(__('http://blankcanvas.eu/', 'screens')); ?>"> BC </a> 2012
				</li>
				<?php wp_meta(); ?>
			</ul>
			<?php	endif ?>
			<?php
			if ($footer_right != "")
				echo '<p class="alignright footermenu">' . $footer_right . '</p>';
			?>
		</div>
		</div>
	</footer>
<?php wp_footer(); ?>
</body>
</html>