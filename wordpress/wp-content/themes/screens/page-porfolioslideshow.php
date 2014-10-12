<?php
/**
 * Template Name: Portfolio - Slideshowe
 ***/
?>
<?php get_header();?>
<div id="wrapper">
<div class="container" id="home_portfolio">
	<?php	the_title('<h1 class="sixteen columns title_headers">', '</h1>'); ?>		
</div>	
<div class="container" id="home_portfolio">
	<?php
			get_template_part('portfolio', 'slide');
	
		?>
</div>
</div>
<?php get_footer();?>