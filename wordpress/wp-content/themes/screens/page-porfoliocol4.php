<?php
/**
 * Template Name: Portfolio - 4 Columns 
 ***/
?>
<?php get_header();?>
<div id="wrapper">
<div class="container">
	<?php	the_title('<h1 class="sixteen columns title_headers">', '</h1>'); ?>		
</div>	
<div class="container" id="home_portfolio">
	<?php get_template_part('portfolio', '4col'); ?>
</div>
</div>
<?php get_footer();?>