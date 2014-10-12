<?php
/**
 * Template Name: Templat page - Archive
 **/
?>
<?php get_header();?>
<div id="wrapper">
<div class="container">
	<section class="sixteen columns content">
		<article <?php post_class('post entry') ?>>
			<?php the_title('<h1 class="title_headers">', '</h1>');?>
		<?php screens_breadcrumb(); ?>		
			<ul>
	<?php
$day_check = '';
query_posts( 'posts_per_page=-1' );
while (have_posts()) : the_post();
  $day = get_the_date('m');
  if ($day != $day_check) {
    if ($day_check != '') {
      echo '</ul></li>'; 
    }
    echo '<li>'. get_the_date('M Y') . '<ul>';
  }
?>
<li><a href="<?php the_permalink() ?>"><?php echo get_the_date(); ?> - <strong><?php the_title(); ?></strong></a></li>
<?php
$day_check = $day;
endwhile; ?>
</ul>
		</article>
	</section>
</div>
</div>
<?php get_footer();?>