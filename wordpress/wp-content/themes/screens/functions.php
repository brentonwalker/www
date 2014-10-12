<?php 
/*********************/
require_once ( get_template_directory() . '/inc/widgets.php' );
require_once ( get_template_directory() . '/inc/shortcode.php' );
require_once ( get_template_directory() . '/inc/screens-functions.php' );
require_once ( get_template_directory() . '/inc/screens-post-options.php' );
require_once ( get_template_directory() . '/theme-options.php' );
require_once ( get_template_directory() . '/inc/responsive-video-embeds.php' );
/*********************/
add_action( 'after_setup_theme', 'screens_setup' );

if ( ! function_exists( 'screens_setup' ) ):
	function screens_setup() {
/*********************/
if ( ! isset( $content_width ) ):
if (is_attachment()) {
	$content_width = 940;
} else {
	$content_width = 640;
}
endif;		
/*********************/
		load_theme_textdomain( 'screens', get_template_directory() . '/languages' );
/*********************/	
		add_theme_support( 'post-formats', array( 'aside', 'gallery','link','quote','image','video') );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 450, 450, true );
		add_image_size('box', 450, 450, true);
		set_post_thumbnail_size( 300, 300, true );
		add_image_size('s-gallery', 300, 300, true);
		set_post_thumbnail_size( 640, 300, true );
		add_image_size('post', 640, 300, true);
		/*********************/
		add_editor_style('/css/editor-style.css');
		/*********************/
		if (function_exists('wp_nav_menu')) {
		register_nav_menus(array('primary' =>__( 'Primary Navigation','screens' )));
		}
		/********************Default gallery style*/
		add_filter('use_default_gallery_style', '__return_false');
		/*********************/
		add_filter('widget_text', 'do_shortcode');
		/********************Widgets*/
function screens_widgets_init() {
	    register_sidebar( array(
		'name' => __( 'Page - Widget is in the side panel', 'screens'),
		'id' => 'sidebar-page',
		'description' => __( 'Widget in the sidebar on the page.', 'screens' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		
	    register_sidebar( array(
		'name' => __( 'Blog - Widget is in the side panel', 'screens'),
		'id' => 'sidebar-blog',
		'description' => __( 'Widget in the sidebar on the blog.', 'screens' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
		'name' => __( 'Portfolio - Widget is in the side panel', 'screens'),
		'id' => 'sidebar-portfolio',
		'description' => __( 'Widget in the sidebar on the portfolio.', 'screens' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );		
				
		register_sidebar( array(
		'name' => __( 'Widget in the footer', 'screens' ),
		'id' => 'first-footer-widget-area',
		'description' => __( ' Widget is in the left part of the footer.', 'screens' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => __( 'Widget in the footer', 'screens' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Widget  in the right part of the footer.', 'screens' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		}
add_action( 'widgets_init', 'screens_widgets_init' );
/*********************/
function screens_comment_reply_script() {
	if ( comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'screens_comment_reply_script' );
/*********************/
function screens_css(){
	if ( ! is_admin() ){
		wp_enqueue_style( 'typo-style', get_stylesheet_uri() );
		wp_register_style('skeleton', get_template_directory_uri() . '/css/skeleton.css', '', '1.0');
		wp_enqueue_style('skeleton');		
}
}
add_action('wp_print_styles', 'screens_css');
/*********************/	
function screens_html5() {
 global $is_IE;
	if (! is_admin() && $is_IE){?>	
	<!--[if (lt IE 9)]>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/html5.js"></script>
	<![endif]-->	
	<?php }
}
add_action( 'wp_head', 'screens_html5' );
/*********************/
function screens_print_css(){
	if ( ! is_admin() ){
echo'<style>@media print {
* { background: transparent !important; color: black !important; text-shadow: none !important; filter:none !important; -ms-filter: none !important; } /* Black prints faster: h5bp.com/s */
article a[href^="http://"]:after, article a[href^="https://"]:after {
content: " (" attr(href) ")";word-wrap: break-word; color:#000; text-decoration: underline;}
body {background: none; font: 7pt  Cambria, Times, "Times New Roman", serif!important;}
h1, h2 {font: 11pt  Verdana, Geneva, Arial, Helvetica, sans-serif!important;}
h3, h4, h5, h6 {font: 9pt  Verdana, Geneva, Arial, Helvetica, sans-serif!important;}
ul, ol, li {margin: 0 0 2pt 10pt; padding: 0 !important;}
th, td {padding: 2px 3px; border: 1px solid #000}
.nocomments, .format_post, #footer, #header, #nav, .wp-pagenavi, #respond, .reply, #footermenu{ display: none;}
.sidebar_meta{display: block}
.depth-2, .depth-3, .depth-4, .depth-5, .depth-6 {margin:0!important;}
}</style>';
}
}
add_action('wp_head', 'screens_print_css');
/*********************/
function screens_scripts(){
if ( ! is_admin() ){	 
		wp_enqueue_script('jquery');
		
		wp_register_script('plugins', get_template_directory_uri() .'/js/plugins.js', array('jquery'));					
        wp_enqueue_script('plugins');
		
		wp_register_script('carou', get_template_directory_uri() .'/js/jquery.carouFredSel-5.5.3-packed.js', array('jquery'));
		
		wp_register_script('masonry', get_template_directory_uri() .'/js/jquery.masonry.min.js', array('jquery'));	
		
		wp_register_script('quick', get_template_directory_uri() .'/js/jquery.quicksand.js', array('jquery'));

		wp_register_script('ui', get_template_directory_uri() .'/js/jquery-ui-1.8.21.custom.min.js', array('jquery'));																	

}
}
add_action('wp_enqueue_scripts', 'screens_scripts');
/*********************/	
function screens_superfish() {
if (! is_admin()) {
echo '<script>jQuery(document).ready(function($) {
$("ul.primery_nav").superfish();
$().UItoTop({ easingType: \'easeOutQuart\' });
		$(".gallery-icon a").attr("rel", \'gallery\');	
		$(" .gallery-icon a[href$=\'.jpg\']").colorbox({current:"'.__('Image {current} of {total}', 'screens').'" ,previous: \''.__('Previous', 'screens').'\',next: \''.__('Next', 'screens').'\', maxHeight:"99%", rel:\'gallery\'});
		$(" .gallery-icon a[href$=\'.jpeg\']").colorbox({current:"'.__('Image {current} of {total}', 'screens').'" ,previous: \''.__('Previous', 'screens').'\',next: \''.__('Next', 'screens').'\', maxHeight:"99%", rel:\'gallery\'});
		$(" .gallery-icon a[href$=\'.png\']").colorbox({current:"'.__('Image {current} of {total}', 'screens').'" ,previous: \''.__('Previous', 'screens').'\',next: \''.__('Next', 'screens').'\', maxHeight:"99%", rel:\'gallery\'});
		$(" .gallery-icon a[href$=\'.gif\']").colorbox({current:"'.__('Image {current} of {total}', 'screens').'" ,previous: \''.__('Previous', 'screens').'\',next: \''.__('Next', 'screens').'\', maxHeight:"99%", rel:\'gallery\'});
		
		$(".wp-caption a[href$=\'.jpg\'], .wp-caption a[href$=\'.jpeg\'], .wp-caption a[href$=\'.gif\'], .wp-caption a[href$=\'.png\']").colorbox({ maxHeight:"99%"});	
		$(".lightbox_large a").colorbox({ maxHeight:"99%"});	
});
</script>';
}}
add_action('wp_head', 'screens_superfish');
/*********************/
function screens_toggle() {
if (! is_admin()) {
global $NHP_Options;
$panels = $NHP_Options->get('home1');
if ($panels != '2') :
echo '<script>jQuery(document).ready(function($) {
	$("#home").accordion({autoHeight: false , header: ".toggle_header", ';
if ($panels == '3') : echo '	active: 0 ';
elseif ($panels == '4') : echo '	active: 1 '; 
elseif ($panels == '5') : echo '	active: 2 '; 
elseif ($panels == '6') : echo '	active: 3 '; 
else  : echo '	active: false '; 
		endif;
echo '	});
});</script>';
endif;
}}
/*********************/
function screens_portfolio_js() {
if (! is_admin()) { ?>
<script>jQuery(document).ready(function($) {
		function portfolio_quicksand() {
		var $filter;
		var $containerClone;
		var $filteredItems
		$filter = $('.filter li.active a').attr('class');
		$containerClone = $('ul.filterable-grid').clone();
		$('.filter li a').click(function(e) {
			$('.filter li').removeClass('active');
			$filter = $(this).attr('class').split(' ');
			$(this).parent().addClass('active');
			if ($filter == 'all') {
				$filteredItems = $containerClone.find('li');
			} else {
				$filteredItems = $containerClone.find('li[data-type~=' + $filter + ']');
			}
			$('ul.filterable-grid').quicksand($filteredItems, {
				duration : 750, easing : 'swing', adjustHeight : 'dynamic' 
			});	     
		});
	}		
	if(jQuery().quicksand) {
		portfolio_quicksand();	
	}
	});</script>
<?php
}}
add_action('wp_head', 'screens_portfolio_js');
/*********************/
function screens_gallery_hover() {
if (! is_admin()) { ?>
<script>jQuery(document).ready(function($) {
	$().UItoTop({ easingType: 'easeOutQuart' }); //UItoTop PLUGINS
				$(".masonry_box").hover(function() {
					$(".cover", this).stop().animate({
						top : "0px"
					}, {queue : false, duration : 600 });
				}, function() {
					$(".cover", this).stop().animate({
						top : "-45px"
					}, {queue : false, duration : 600 });
				});
				$("#masonry_container").masonry({itemSelector : ".masonry_box"});
			}); </script>	
<?php
}}
add_action('wp_footer', 'screens_gallery_hover');
/*********************/
function screens_tabs_horizontal() {
if (is_page_template('page-home-horizontal.php')) {
wp_enqueue_script('ui');
echo '<script>jQuery(document).ready(function($) {
		$( "#home" ).tabs();
	});</script>';
}}
add_action('wp_footer', 'screens_tabs_horizontal');
/*********************/		
function screens_colorbox_js() {
global $NHP_Options;
$pimaryimage = $NHP_Options->get('primary4');	
				if (! is_admin() ){	
if($pimaryimage =='2' ):
		wp_register_style('colorbox_css', get_template_directory_uri() . '/gallery/example2/colorbox.css', '', '1.0');
		wp_enqueue_style('colorbox_css');	
elseif($pimaryimage =='3' ):
		wp_register_style('colorbox_css', get_template_directory_uri() . '/gallery/example3/colorbox.css', '', '1.0');
		wp_enqueue_style('colorbox_css');		
elseif($pimaryimage =='4' ):
		wp_register_style('colorbox_css', get_template_directory_uri() . '/gallery/example4/colorbox.css', '', '1.0');
		wp_enqueue_style('colorbox_css');			
elseif($pimaryimage =='5' ):
		wp_register_style('colorbox_css', get_template_directory_uri() . '/gallery/example5/colorbox.css', '', '1.0');
		wp_enqueue_style('colorbox_css');	
else :
		wp_register_style('colorbox_css', get_template_directory_uri() . '/gallery/example1/colorbox.css', '', '1.0');
		wp_enqueue_style('colorbox_css');		
endif;
		}
		}	
add_action('wp_print_styles', 'screens_colorbox_js');
/*********************/
		function screens_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
		add_action( 'widgets_init', 'screens_recent_comments_style' );
/*********************/
		if ( ! function_exists( 'screens_date' ) ) :
		function screens_date() {
			if (is_singular()){
$author_text = __('<div class="time_meta"><span>%4$s</span> %5$s %6$s</div>', 'screens' );					
			}else {
$author_text = __('<div class="time_meta"><a href="%1$s" title="%7$s" rel="bookmark"> <span>%4$s</span> %5$s %6$s </a></div>', 'screens' );					
			}		
		printf( $author_text,
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date('d') ),
		esc_html( get_the_date('M') ),
		esc_html( get_the_date('y') ),
		esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0')))
		);
		}
		endif;
/*********************/
		if ( ! function_exists( 'screens_author' ) ) :
		function screens_author() {
		$author_text = __('<span class="author vcard"><a class="url fn n" href="%1$s" title="%4$s" rel="author">%3$s</a></span>', 'screens' );					
		printf( $author_text,
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'screens' ), get_the_author() ),
		esc_html( get_the_author() ),
		esc_attr(sprintf(__('View all posts by %s', 'screens'), get_the_author()))
		);
		}
		endif;
/*********************/
		if ( ! function_exists( 'screens_cat' ) ) :
		function screens_cat() {
		printf(__('<li class="meta_cat">%1$s</li>', 'screens'), get_the_category_list(__(', ', 'screens')));
		}
		endif;
/*********************/
		if ( ! function_exists( 'screens_tag' ) ) :
		function screens_tag() {	
		printf(__('%1$s', 'screens'), get_the_tag_list(__(' <p class="meta_post">Tags: ', 'screens'),', ',  '</p>'));
		}
		endif;
/*********************/
function screens_continue_reading_link() {
	return ' <a class="link_more" href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading &rarr;', 'screens' ) . '</a>';
}
/*********************/
function screens_auto_excerpt_more( $more ) {
	return '&hellip;' . screens_continue_reading_link();
}
add_filter( 'excerpt_more', 'screens_auto_excerpt_more' );
/*********************/	
function screens_body_classes( $classes ) {
	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';
	if ( is_singular() && ! is_home())
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'screens_body_classes' );	
/*********************/	
function screens_filter_wp_title( $title ) {
    $site_name = get_bloginfo( 'name' );
    $filtered_title =  $title.' '.$site_name ;
    if ( is_front_page() ) {
        $site_description = get_bloginfo( 'description' );
        $filtered_title .= ' | '.$site_description;
    }
    return $filtered_title;
}
add_filter( 'wp_title', 'screens_filter_wp_title' );		
/*********************/
}
endif;
	/*********************/
	// end screens_setup
	/********************Paginations*/
	if ( ! function_exists('screens_pagination') ) {
	function screens_pagination() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
	'base' => @add_query_arg('paged','%#%'),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'show_all' => false,
	'mid_size' => 4,
	'end_size'     => 2,
	'type' => 'plain'
	);

	if( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
	$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	echo '<div class="wp-pagenavi">' .paginate_links($pagination).'</div>' ;
	}
	}
	/*********************/
	if ( ! function_exists( 'screens_breadcrumb' ) ) {
	function screens_breadcrumb(){
		if(function_exists('bcn_display'))
    { echo '<p id="breadcrumbs">';
        bcn_display();
		echo '</p>';
    }
	elseif (function_exists('yoast_breadcrumb')) {
	yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
	} 
	}
	}
	/*********************/
	if ( ! function_exists( 'custom_comments' ) ) :
	function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case '' :
?>
	<li <?php	comment_class(); ?> id="li-comment-<?php	comment_ID(); ?>">
		<article id="comment-<?php	comment_ID(); ?>">
		<header  class="comment-author vcard">
			<?php	echo get_avatar($comment, 60); ?>
				<div class="comment-meta commentmetadata"><a href="<?php	echo esc_url(get_comment_link($comment -> comment_ID)); ?>">
			<?php	/* translators: 1: date, 2: time */
					printf(__('%1$s at %2$s', 'screens'), get_comment_date(), get_comment_time());
				?></a><?php	edit_comment_link(__('(Edit)', 'screens'), ' '); ?><br />		
			<?php	printf(__('<em>%s <span class="says">says:</span></em>', 'screens'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
				<div class="reply">
			<?php	comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div><!-- .reply -->
	</div>		
		<!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php	_e('Your comment is awaiting moderation.', 'screens'); ?></em>			
		<?php	endif; ?>
		<!-- .comment-meta .commentmetadata -->
</header>
		<div class="comment-body">
		<?php	comment_text(); ?>
		</div>
	</article><!-- #comment-##  -->

	<?php
	break;
	case 'pingback'  :
	case 'trackback' :
?>
	<li <?php	comment_class(); ?>>
		<?php	_e('Pingback:', 'screens'); ?> <?php	comment_author_link(); ?><?php	edit_comment_link(__('(Edit)', 'screens'), ' '); ?>
<?php
break;
endswitch;
}
endif;
/*********************/
function screens_menu_args( $args = '' )
{
if ( has_nav_menu('primary') ) {
$args['walker'] = new s_walker();
return $args;
} else {
$args['walker'] = false;
return $args;
}

} // function
add_filter( 'wp_nav_menu_args', 'screens_menu_args' );
/*********************/
class s_walker extends Walker_Nav_Menu
{
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
global $wp_query;
$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

$class_names = $value = '';

$classes = empty( $item->classes ) ? array() : (array) $item->classes;
$classes[] = 'menu-item-' . $item->ID;

$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
$class_names = ' class="' . esc_attr( $class_names ) . '"';

$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

$output .= $indent . '<li' . $id . $value . $class_names .'>';

$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

$item_output = $args->before;
$item_output .= '<a'. $attributes .'>';
$item_output .= '<strong>' .$args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after.'</strong>' ;
if ($item->description) {
$item_output .= '<span>' . $item->description . '</span>';
}
$item_output .= '</a>';
$item_output .= $args->after;

$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

}

/*********************/
		add_action('init', 'screens_custom_init');
		function screens_custom_init()
		{
		$labels = array(
		'name' => __('Portfolio', 'screens'),
		'singular_name' => __('Portfolio', 'screens'),
		'add_new' => __('Add New', 'screens'),
		'add_new_item' => __('Add New Project', 'screens'),
		'edit_item' => __('Edit Project', 'screens'),
		'new_item' => __('New Portfolio', 'screens'),
		'view_item' => __('View Portfolio', 'screens'),
		'search_items' => __('Search Portfolio', 'screens'),
		'not_found' =>  __('No portfolio found', 'screens'),
		'not_found_in_trash' => __('No portfolio found in Trash', 'screens'),
		'menu_name' => 'Portfolio'

		);

		$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
		);
		register_post_type('page-portfolio',$args);

		$labels = array(
		'name' => __( 'Projects', 'screens' ),
		'singular_name' => __( 'Projects', 'screens' ),
		'all_items' => __( 'All Projects', 'screens' ),
		'parent_item' => __( 'Parent Project', 'screens' ),
		'parent_item_colon' => __( 'Parent Project:', 'screens' ),
		'edit_item' => __( 'Edit Project', 'screens' ),
		'update_item' => __( 'Update Project', 'screens' ),
		'add_new_item' => __( 'Add New Project', 'screens' ),
		'new_item_name' => __( 'New Project Name', 'screens' ),
		);
		// Custom taxonomy for Project
		register_taxonomy('projects',array('page-portfolio'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'projects' ),
		));

		}
	?>