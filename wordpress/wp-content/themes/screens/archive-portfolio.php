<?php get_header(); ?>
<div id="wrapper">
<div class="container" id="home_portfolio">
<?php global $NHP_Options;
	$portfolio = $NHP_Options->get('portfolio1');
if ($portfolio) { ?>
<h1 class="sixteen columns title_headers"><?php
printf(__('%s', 'screens'), $portfolio);
?></h1>
<?php }
	global $NHP_Options;
	$portfoliotype = $NHP_Options->get('portfolio2');
	if ($portfoliotype =='1') :
	get_template_part('portfolio', 'slide');
	elseif ($portfoliotype =='2') :
	get_template_part('portfolio', '2col');
	else :
	get_template_part('portfolio', '4col');
	endif; wp_reset_query()
		?>
</div>
</div>
<?php get_footer(); ?>