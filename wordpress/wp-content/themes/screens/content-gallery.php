<?php if (have_posts()) : the_post();
?>
<section class="eleven columns">
	<?php screens_breadcrumb(); ?>
	<article <?php post_class('post') ?>>				
			<?php	the_title('<h1>', '</h1>'); ?>
		<div class="entry">
			<?php	the_content(); ?>
			<?php	if ( function_exists( 'screens_desc' ) ) screens_desc(); ?>
			<div class="clear"></div>
		</div>
		<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('<em>Pages</em>:', 'screens'), 'after' => '</div>')); ?>
	</article>
	<div class="wp-pagenavi">
		<?php previous_post_link('<div class="alignleft">' . __('Previous Post', 'screens') . ' <br />%link</div>'); ?>
		<?php next_post_link('<div class="alignright">' . __('Next Post', 'screens') . ' <br />%link</div>'); ?>
		<div class="clear"></div>
	</div>
	<?php comments_template('', true); ?>
</section>
<?php  endif; ?>
<?php get_sidebar(); ?>