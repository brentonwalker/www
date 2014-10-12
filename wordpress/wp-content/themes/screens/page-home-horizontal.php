<?php
/**
 * Template Name: Home - horizontal
 **/
?>
<?php
global $NHP_Options;
$desc = $NHP_Options->get('home2');
$welcome = $NHP_Options->get('desc1');
$desc_title = $NHP_Options->get('desc2');
$desc_content = $NHP_Options->get('desc3');
$portfolio2 = $NHP_Options->get('home3');
$portfoliotitle = $NHP_Options->get('portfolio1');
$portfoliotype = $NHP_Options->get('portfolio2');
$blog4 = $NHP_Options->get('home4');
$blog_title = $NHP_Options->get('blog1');
$blog_link = $NHP_Options->get('blog2');
$contact5 = $NHP_Options->get('home5');
$contacttitle = $NHP_Options->get('contact1');
$contactleft = $NHP_Options->get('contact2');
$contactright = $NHP_Options->get('contact3');
$contactname = $NHP_Options->get('contact5');
$contacta1 = $NHP_Options->get('contact6');
$contacta2 = $NHP_Options->get('contact7');
$contactph1 = $NHP_Options->get('contact8');
$contactph2 = $NHP_Options->get('contact9');
$contacte = $NHP_Options->get('contact10');
?>
<?php get_header();?>




<div id="home" class="home_horizontal">
	<div id="home_list">
	<ul class="container">
		<?php
	if ($welcome && $desc) :
		echo '<li><a  class="toggle_header four columns" href="#home_desc">' . $welcome . '</a></li>';
	endif;
	?>	
		<?php
	if ($portfoliotitle && $portfolio2) :
		echo '<li><a class="toggle_header four columns" href="#home_portfolio">' . $portfoliotitle . '</a></li>';
 endif;
	?>	
		<?php
	if ($blog_title && $blog4) :
		echo '<li><a class="toggle_header four columns" href="#home_blog">' . $blog_title . '</a></li>';
	endif;
	?>
		<?php
	if ($contacttitle && $contact5) :
		echo '<li><a class="toggle_header four columns" href="#home_contact">' . $contacttitle . '</a></li>';
 endif;
	?>
</ul>
</div>
<?php if($desc):
/*********** DESCRIPTION ************/
?>

<div id="home_desc" class="toggle_viev">
	<div class="container">
		<div class="sixteen columns">
			<?php
if($desc_title || $desc_content):
			?>
			<div class="eleven offset-by-five  columns">
			<?php if ($desc_title) : echo '<h3>'.$desc_title.'</h3>'; endif; ?>
			<?php if ($desc_content) : echo '<p>'.$desc_content.'</p>'; endif; ?>	
			</div>
			<?php  endif;?>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php endif;?>

<?php if($portfolio2 ):
/***********PORTFOLIO************/
?>

<div id="home_portfolio" class="toggle_viev">
	<div class="container">
		<?php
		if ($portfoliotype =='1') :
			get_template_part('portfolio', 'slide');
		elseif ($portfoliotype =='2') :
			get_template_part('portfolio', '2col');
		else :
            get_template_part('portfolio', '4col');
		endif; 
		?>
	</div>
</div>
<?php endif;?>

<?php if($blog4 ):
/***********BLOG************/
?>

<div id="home_blog">		
	<?php get_template_part('blog', 'masonry');  wp_reset_query();?>
</div>
<?php endif;?>

<?php if($contact5):
/***********CONTACT************/
?>

<div id="home_contact" class="toggle_viev">
	<div class="container">
<?php if($contactleft):
	echo '<div class="seven columns">';
         echo do_shortcode($contactleft); 
    echo '</div>';
			endif;
			?>
	<?php if($contactname && $contacta1 && $contactph1 && $contacte):
			echo '<ul class="three columns vcard">';
			if($contactname): echo '<li class="fn"><h3>'.$contactname.'</h3></li>'; endif;
			if($contacta1): echo '<li  class="adr work"><em>'.__('Address:', 'screens').'</em> <br />'.$contacta1.'</li>'; endif;
			if($contacta2): echo '<li class="margin_bottom adr work">'.$contacta2.'</li>'; endif;
			if($contactph1): echo '<li  class="tel work"><em>'.__('Phone:', 'screens').'</em> <br />'.$contactph1.'</li>'; endif;
			if($contactph2): echo '<li class="margin_bottom tel work">'.$contactph2.'</li>'; endif;
			if($contacte): echo '<li  class="email"><em>'.__('E-mail:', 'screens').'</em> <br />'.$contacte.'</li>'; endif;
			echo '</ul>';
			endif;
			?>
			
			<?php if($contactright):
			echo '<div class="six columns">'.$contactright.'</div>';
			endif;
			?>
	</div>
</div>
<?php endif;?>
</div>
<?php wp_footer();?>
</body>
</html>
