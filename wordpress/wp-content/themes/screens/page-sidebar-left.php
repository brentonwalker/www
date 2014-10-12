<?php
/**
 * Template Name: Templat page - Sidebar left side
 **/
?>
<?php get_header();?>
<div id="wrapper">
<div id="bg" class="container">
		<?php get_sidebar();?>
	<section class="eleven columns content">
	<?php screens_breadcrumb(); ?>
		<?php if (have_posts())  : the_post();
		?>
		<article <?php post_class('post') ?>>
			<header>
				<?php if ( is_front_page() ) {
				?>
				<?php the_title('<h2>', '</h2>');?>
				<?php } else {?>
				<?php the_title('<h1>', '</h1>');?>
				<?php }?>
			</header>
		<div class="entry">
			<?php	the_content(__('Continue reading &rarr;', 'screens'));?>
			<div class="clear"></div>
		</div>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'screens'), 'after' => '</div>'));?>
			<?php edit_post_link(__('Edit This', 'screens'));?>
		</article>
		<?php comments_template();?>
		<?php  endif;?>
	</section>
</div>
</div>
<?php get_footer();?>