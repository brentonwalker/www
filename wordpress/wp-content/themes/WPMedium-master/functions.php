<?php
/**
 * WPMedium
 *
 * @package   WPMedium
 * @author    Charlie MERLAND <contact@caercam.org>
 * @license   GPL-3.0+
 * @link      http://www.caercam.org/
 * @copyright 2013 CaerCam.org
 */

add_action( 'after_setup_theme', 'wpmedium_setup' );

	/**
	 * WPMedium setup
	 * 
	 * Load textdomain, various options and supports, sidebar, menus…
	 * 
	 * @since    1.4
	 */
	function wpmedium_setup()
	{
		// Adds locales
		load_theme_textdomain( 'wpmedium', get_template_directory() . '/lang' );

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Dummy sidebar
		register_sidebar(
			array(
				'name'          => __( 'Footer Sidebar', 'wpmedium' ),
				'id'            => 'footer-sidebar',
				'description'   => '',
				'class'         => '',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>'
			)
		);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'wpmedium' ) );

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );

		// This theme uses a custom header image
		add_theme_support( 'custom-header', array(
				'default-image'          => get_template_directory_uri() . '/img/wpmedium-header.jpg',
				'height'                 => 420,
				'width'                  => 800,
				'max-width'              => 2000,
			)
		);

		// Custom images sizes
		add_image_size( 'large-featured-image', 640, 9999 );
		add_image_size( 'medium-featured-image', 464, 9999 );

		if ( !isset( $content_width ) )
			$content_width = 900;

		// Add a sidebar to the header
		register_sidebar(
			array(
				'name'          => __( 'Header Sidebar', 'wpmedium' ),
				'id'            => 'header-sidebar',
				'description'   => __( 'Header Sidebar help', 'wpmedium' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		// Load settings or register new ones
		wpmedium_settings();

		add_action ( 'edit_category_form_fields', 'wpmedium_add_taxonomy_image' );
		add_action ( 'edit_tag_form_fields', 'wpmedium_add_taxonomy_image' );
		add_action ( 'edited_term', 'wpmedium_save_image' );

		add_action( 'wp_enqueue_scripts', 'wpmedium_wp_head' );
		add_action( 'admin_enqueue_scripts', 'wpmedium_admin_enqueue_scripts' );

		add_action( 'admin_menu', 'wpmedium_theme_menu' );
		add_action( 'admin_menu', 'wpmedium_customizer_menu_item' );
		add_action( 'admin_init', 'wpmedium_theme_initialize_options' ); 

		add_action( 'wp_ajax_load_posts', 'wpmedium_ajax_load_posts' );
		add_action( 'wp_ajax_no_priv_load_posts', 'wpmedium_ajax_load_posts' );

		add_action( 'customize_register', 'wpmedium_theme_customizer' );
	}

	/**
	 * WPMedium settings
	 * 
	 * If there are no available settings, or if $force is set to true,
	 * load and save default settings, load settings if previously saved.
	 *
	 * @since    1.4
	 * 
	 * @param    boolean    $force 
	 */
	function wpmedium_settings( $force = false ) {

		$default_settings  = array(
			'authorized_taxonomy'        => array( 'category', 'post_tag' ),
			'ajax_load'                  => true,
			'default_taxonomy'           => 'post_tag',
			'use_post_thumbnail'         => true,
			'default_post_thumbnail'     => get_template_directory_uri() . '/img/wpmedium-post-thumbnail.jpg',
			'logo'                       => get_template_directory_uri() . '/img/WPMedium-logo-simple-128.png',
			'w'                          => get_template_directory_uri() . '/img/WPMedium-logo-simple-64.png',
			'social' => array(
				'facebook_profile'   => '',
				'twitter_profile'    => '',
				'google+_profile'    => '',
				'flickr_profile'     => '',
				'deviantart_profile' => '',
				'blogger_profile'    => '',
				'tumblr_profile'     => '',
				'reddit_profile'     => '',
				'lastfm_profile'     => '',
				'vimeo_profile'      => '',
				'youtube_profile'    => ''
			)
		);

		$settings = get_option( '_wpmedium_settings', $default_settings );

		if ( ( false === $settings || ! is_array( $settings ) ) || true == $force ) {
			delete_option( '_wpmedium_settings' );
			add_option( '_wpmedium_settings', $default_settings );
			$settings = $default_settings;
		}

		return $settings;
	}

	/**
	 * Built-in option finder/modifier
	 * Default behavior with no empty search and value params results in
	 * returning the complete WPMedium options' list.
	 * 
	 * If a search query is specified, navigate through the options'
	 * array and return the asked option if existing, empty string if it
	 * doesn't exist.
	 * 
	 * If a replacement value is specified and the search query is valid,
	 * update WPMedium options with new value.
	 * 
	 * Return can be string, boolean or array. If search, return array or
	 * string depending on search result. If value, return boolean true on
	 * success, false on failure.
	 * 
	 * @param    string        Search query for the option: 'aaa-bb-c'. Default none.
	 * @param    string        Replacement value for the option. Default none.
	 * 
	 * @return   string|boolean|array        option array of string, boolean on update.
	 *
	 * @since    1.4
	 */
	function wpmedium_o( $search = '', $value = null ) {

		$default   = wpmedium_settings();
		$theme_mod = get_theme_mod( 'wpmedium_' . $search, $default[ $search ] );

		if ( '' !== $theme_mod )
			return $theme_mod;

		$options = get_option( '_wpmedium_settings', $default );

		if ( '' != $search && is_null( $value ) ) {
			$s = explode( '-', $search );
			$o = $options;
			while ( count( $s ) ) {
				$k = array_shift( $s );
				if ( isset( $o[ $k ] ) )
					$o = $o[ $k ];
				else
					$o = '';
			}
		}
		else if ( '' != $search && ! is_null( $value ) ) {
			$s = explode( '-', $search );
			wpmedium_o_( $options, $s, $value );
			$o = update_option( '_wpmedium_settings', $options );
		}
		else {
			$o = $options;
		}

		return $o;
	}

	/**
	 * Built-in option modifier
	 * Navigate through WPMedium options to find a matching option and
	 * update its value.
	 * 
	 * @param    array        Options array passed by reference
	 * @param    string        key list to match the specified option
	 * @param    string        Replacement value for the option. Default none
	 *
	 * @since    1.4
	 */
	function wpmedium_o_( &$array, $key, $value = '' ) {
		$a = &$array;
		foreach ( $key as $k )
			$a = &$a[ $k ];
		$a = $value;
	}


	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                         WPMedium Basic Methods
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	* Get shorter excerpt. Some times we just need less than 55 words
	* 
	* @since    1.0
	*
	* @param    string        $excerpt post default excerpt.
	* @param    int        $length new maximum length.
	* 
	* @return string        New shorten excerpt.
	*/
	function wpmedium_get_short_excerpt( $excerpt, $length = 15 ) {
		return implode( ' ', array_slice( explode( ' ', strip_shortcodes( strip_tags( $excerpt ) ) ), 0, $length ) ) . ' [...]';
	}

	/**
	* Get longer excerpt. Some times we just need more than 55 words
	* 
	* @since    1.0
	*
	* @param    string        $excerpt post default excerpt.
	* @param    int        $length new maximum length.
	* 
	* @return    string        New longuer excerpt.
	*/
	function wpmedium_get_long_excerpt( $excerpt, $length = 125 ) {
		return implode( ' ', array_slice( explode( ' ', strip_shortcodes( strip_tags( $excerpt ) ) ), 0, $length ) ) . ' [...]';
	}

	/**
	* Display shorter excerpt.
	* 
	* @since    1.0
	*
	* @param    string        $excerpt post default excerpt.
	* @param    int        $length new maximum length.
	*/
	function wpmedium_the_short_excerpt( $excerpt, $length = 15 ) {
		echo wpmedium_get_short_excerpt( $excerpt, $length );
	}

	/**
	* Display longer excerpt.
	* 
	* @since    1.0
	*
	* @param    string        $excerpt post default excerpt.
	* @param    int        $length new maximum length.
	*/
	function wpmedium_the_long_excerpt( $excerpt, $length = 125 ) {
		echo wpmedium_get_long_excerpt( $excerpt, $length );
	}

	/**
	* Return the header image path. If no header image is defined,
	* use the default one.
	* 
	* @since    1.0
	*
	* @return   string        Header image URL.
	*/
	function wpmedium_get_header_image() {
		$header_image = get_header_image();
		return ( ! empty( $header_image ) ? $header_image : get_template_directory_uri() . '/img/wpmedium-header.jpg' );
	}

	/**
	* Display header image path
	* 
	* @since    1.0
	*/
	function wpmedium_the_header_image() {
		echo wpmedium_get_header_image();
	}

	/**
	* Get Post entry meta.
	* 
	* Alter Meta display if Post doesn't have a taxonomy set. This is
	* mainly to avoid clumsy display with empty taxonomy after author name. 
	* 
	* @since    1.4
	*/
	function wpmedium_get_post_entry_meta() {

		$terms  = wpmedium_get_the_taxonomy_list( wpmedium_o( 'default_taxonomy' ) );
		$author = sprintf( '<span class="by-author">%s</span>', sprintf( __( 'By %s', 'wpml' ) ,get_the_author() ) );
		$edit   = get_edit_post_link();

		$ret = $author;

		if ( '' != $terms )
			$ret = sprintf( '%s %s <span class="in-taxonomy">%s</span>', $ret, __( 'In', 'wpmedium' ), $terms );

		if ( '' != $edit )
			$ret = sprintf( '%s | <span class="edit-link"><a href="%s">%s</a></span>', $ret, $edit, __( 'Edit', 'wpmedium' ) );

		return $ret;
	}

	/**
	* Display Post entry meta.
	* 
	* @since    1.4
	*/
	function wpmedium_post_entry_meta() {
		echo wpmedium_get_post_entry_meta();
	}

	/**
	* Display WPMedium Credits.
	* 
	* @since    1.4.1
	*/
	function wpmedium_credits() {
		$default = wpmedium_default();
		$default = $default['Basics']['credit'];

		echo get_theme_mod( 'wpmedium_credits', $default );
	}

	/**
	* Display WPMedium Copyright.
	* 
	* @since    1.4.1
	*/
	function wpmedium_copyright() {
		$default = wpmedium_default();
		$default = $default['Basics']['copyright'];

		echo get_theme_mod( 'wpmedium_copyright', $default );
	}

	/**
	* Display Footer Sidebar.
	* 
	* @since    1.4.1
	*/
	function wpmedium_footer_sidebar_display() {
		$default = wpmedium_default();
		$default = $default['Basics']['footer_display'];

		return get_theme_mod( 'wpmedium_footer_display', $default );
	}

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                       WPMedium Thumbnail Handling
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	* Return the post's thumbnail if available, default image else
	* 
	* @since    1.0
	* 
	* @param    int       $post_it Post ID (optional)
	* @param    string    $size Default attachment size (optional)
	* 
	* @return   string    Post's thumbnail HTML code.
	*/
	function wpmedium_get_post_thumbnail( $post_id = 0, $size = 'large-featured-image' ) {

		if ( !$post_id ) {
			global $post;
			$post_id = $post->ID;
		}
		
		if ( has_post_thumbnail( $post_id ) ) {

			$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

			if ( $attachment[1] > $attachment[2] ) {
				if ( $attachment[1] / ( $attachment[2] / 245 ) < 370 )
					$class = "landscape-fit";
				else
					$class = "landscape";
			}
			else if ( $attachment[1] < $attachment[2] )
				$class = "portrait";
			else
				$class = "default";
			
			$ret = '<img src="'.$attachment[0].'" alt="'.get_the_title( $post_id ) . '" class="attachment-post-thumbnail wp-post-image '.$class.'" />';
		}
		else if ( wpmedium_o( 'use_post_thumbnail' ) && '' != wpmedium_o( 'default_post_thumbnail' ) ) {
			$ret = '<img src="'.esc_url( wpmedium_o( 'default_post_thumbnail' ) ) . '" alt="'.get_the_title( $post_id ) . '" class="attachment-post-thumbnail wp-post-image default" />';
		}
		else {
			$ret = '';
		}

		return $ret;
	}

	/**
	* Display thumbnail support
	* 
	* @since    1.0
	*/
	function wpmedium_the_post_thumbnail( $post_id = 0, $size = 'large-featured-image' ) {
		echo wpmedium_get_post_thumbnail( $post_id, $size );
	}

	/**
	* If available, returns the post thumbnail's description
	* if no description is found, return empty
	* 
	* @since    1.0
	*
	* @return   string        Post's thumbnail credit
	*/
	function wpmedium_post_thumbnail_credit() {

		global $post;

		$ret = '';

		if ( has_post_thumbnail( $post->ID ) ) {
			if ( get_post( get_post_thumbnail_id( $post->ID ) )->post_content != '' )
			    $ret = sprintf( '<span class="entry-thumb-credit">%s</span>', get_post( get_post_thumbnail_id( $post->ID ) )->post_content );
			else
			    $ret = '';
		}

		return $ret;
	}

	/**
	* Display post thumbnail's description
	* 
	* @since    1.0
	*/
	function wpmedium_the_post_thumbnail_credit() {
		echo wpmedium_post_thumbnail_credit();
	}


	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                     WPMedium Taxonomy Support
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	* Get the taxonomy's number of posts
	* 
	* @since    1.0
	*
	* @return   string        Taxonomy count.
	*/
	function wpmedium_get_taxonomy_count() {

		global $term;

		$r = '';

		if ( !in_array( $term->taxonomy, wpmedium_o( 'authorized_taxonomy' ) ) )
			return false;

		$taxonomy = get_term_by( 'id', $term->term_id, $term->taxonomy );
		return $taxonomy->count;
	}

	/**
	* Get the taxonomy list
	* 
	* @since    1.0
	*
	* @param    string        $taxonomy_type what taxonomy we're handling
	* @param    int        $limit returned list's max number of elements to be displayed
	* 
	* @return   string        the taxonomy list, commat separated
	*/
	function wpmedium_get_the_taxonomy_list( $taxonomy_type = 'category', $limit = 3 ) {

		global $post;

		$r = '';

		if ( !in_array( $taxonomy_type, wpmedium_o( 'authorized_taxonomy' ) ) )
			return false;

		$taxonomy = get_the_term_list( $post->ID, $taxonomy_type, '', ', ', '' );
		$t = explode( ', ', $taxonomy );

		if ( count( $t ) > $limit )
			$taxonomy = implode( ', ', array_slice( $t, 0, $limit ) ) . ', <a href="'.get_permalink() . '">...</a>';

		return $taxonomy;
	}

	/**
	* Get the post's taxonomy.
	* General alternative to the_tags() and the_category() methods.
	* 
	* @since    1.0
	*
	* @param    string        $before taxonomy prefix.
	* @param    string        $sep Optional separator.
	* @param    string        $after taxonomy suffix.
	* 
	* @return   string        Taxonomy
	*/
	function wpmedium_get_the_taxonomy( $before = '', $sep = ', ', $after = '' ) {

		global $post;

		$r = array();

		if ( 'category' == wpmedium_o( 'default_taxonomy' ) )
			$taxonomy_type = 'post_tag';
		else if ( 'post_tag' == wpmedium_o( 'default_taxonomy' ) )
			$taxonomy_type = 'category';

		$terms = get_the_terms( $post->ID, $taxonomy_type );

		foreach( $terms as $term )
			$r[] = '<a href="'.get_term_link( $term->slug, $taxonomy_type ) . '">'.$term->name.'</a>';

		$terms = implode( $sep, $r );

		return $before . $terms . $after;
	}

	/**
	* Display the post's taxonomy.
	* 
	* @since    1.0
	*
	* @param    string        $before taxonomy prefix.
	* @param    string        $sep Optional separator.
	* @param    string        $after taxonomy suffix.
	*/
	function wpmedium_the_taxonomy( $before = '', $sep = ', ', $after = '' ) {
		echo wpmedium_get_the_taxonomy( $before, $sep, $after );
	}

	/**
	* Return the custom taxonomy image
	* If no image is properly defined, fallback to the latest taxonomy's post
	* thumbnail. If the taxonomy is empty, use the theme's logo
	* 
	* @since    1.0
	*
	* @return   string        The taxonomy image.
	*/
	function wpmedium_get_the_taxonomy_image() {

		global $term;

		$ret = wpmedium_o( 'logo' );

		if ( !in_array( $term->taxonomy, wpmedium_o( 'authorized_taxonomy' ) ) )
			return false;

		if ( $term ) {

			$taxonomy_images = get_option( 'wpmedium_taxonomy_images' );
			$taxonomy_image  = '';
			
			if ( is_array( $taxonomy_images ) && array_key_exists( $term->term_id, $taxonomy_images ) && $taxonomy_images[$term->term_id] != '' ) {
				$ret = $taxonomy_images[$term->term_id];
			}
			else {
				$query = new WP_Query(
					array(
						'post_type' => 'post',
						'tax_query' => array(
							array(
								'taxonomy' => $term->taxonomy,
								'field' => 'id',
								'terms' => $term->term_id,
							),
						),
					)
				);
				$post_ = $query->posts[0];
				
				if ( has_post_thumbnail( $post_->ID ) ) {
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_->ID ), 'medium' );
					$ret = $thumbnail[0];
				}
			}
		}

		return $ret;
	}

	/**
	* Display the custom taxonomy image
	* 
	* @since    1.0
	*/
	function wpmedium_the_taxonomy_image() {
		echo wpmedium_get_the_taxonomy_image();
	}

	/**
	* Add custom images to display along with category description and title
	* selection/upload using WP media-upload
	* 
	* @since    1.0
	*
	* @param    string        $taxonomy 
	*/
	function wpmedium_add_taxonomy_image( $taxonomy ) {

		/*$taxonomy_images = get_option( 'wpmedium_taxonomy_images' );
		$taxonomy_image = '';

		if ( is_array( $taxonomy_images ) && array_key_exists( $taxonomy->term_id, $taxonomy_images ) )
			$taxonomy_image = $taxonomy_images[ $taxonomy->term_id ] ;

		if ( '' != $taxonomy_image )
			$style = 'style="width: 100px;"';
		else
			$style = 'style="display:none;width: 100px;"';
	?>
		<table class="form-table">
			<tr class="form-field form-required">
				<th scope="row" valign="top">
					<label for="auteur_revue_image"><?php _e( 'Taxonomy Image', 'wpmedium' ); ?></label>
				</th>
				<td>
					<div id="upload_taxonomy_image_preview" style="">
	<?php ?>
	<?php if ( '' != $taxonomy_image ) { ?>
						<img style="max-width:100%;" src="<?php echo $taxonomy_image; ?>" />
	<?php } ?>
					</div>
					
					<input type="hidden" id="wpmedium_taxonomy_image" name="wpmedium_taxonomy_image" value="<?php echo $taxonomy_image; ?>" class="image_url" />
					<input id="upload_taxonomy_image" type="button" class="button-primary" value="<?php _e( 'Upload Image', 'wpmedium' ); ?>" style="width: 100px;" />
					<input id="delete_taxonomy_image" name="wpmedium_taxonomy_image_delete" type="submit" class="button-primary" value="<?php _e( 'Delete Image', 'wpmedium' ); ?>" <?php echo $style; ?> />
					<p class="description"><?php _e( 'Taxonomy Image Help', 'wpmedium' ); ?></p>
				</td>
			</tr>
	<?php */
	}

	/**
	* Save previously selected custom category images
	* 
	* @since    1.0
	*
	* @param    int        $term_id taxonomy ID.
	*/
	function wpmedium_save_image( $term_id ){
		/*if ( isset( $_POST['wpmedium_taxonomy_image'] ) ) {
			$taxonomy_images = get_option( 'wpmedium_taxonomy_images' );
			$taxonomy_images[$term_id] = $_POST['wpmedium_taxonomy_image'];
			update_option( 'wpmedium_taxonomy_images', $taxonomy_images );
		}*/
	}

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                    WPMedium Menus & Pagination
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	* WPMedium default primary menu.
	* If no primary menu is set, fallback to default taxonomy terms list.
	* 
	* @since    1.4.1
	*/
	function wpmedium_primary_menu() {

		if ( 'category' == wpmedium_o( 'default_taxonomy' ) ) {
			wp_list_categories( array( 'title_li' => '', 'hierarchical' => 0 ) );
		}
		else if ( 'post_tag' == wpmedium_o( 'default_taxonomy' ) ) {

			$tags = get_tags(
				array(
					'orderby' =>'count',
					'order'   => 'DESC',
					'number'  => 8
				)
			);
			
			foreach ( $tags as $tag )
			    printf( '<li id="menu-item-%d" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-%d"><a href="%s">%s</a></li>', $tag->term_id, $tag->term_id, get_tag_link( $tag->term_id ), $tag->name );
		}

	}

	/**
	* Get the archive control menu links.
	* 
	* @since    1.0
	*
	* @return   string The archive menu.
	*/
	function wpmedium_get_archive_controls() {

		$newest = '';
		$oldest = '';

		if ( isset( $_GET['order'] ) && 'ASC' == $_GET['order'] ) {
			$newest .= '<li class="archive-newest-posts"><a href="?order=DESC" class="">' . __( 'Newest', 'wpmedium' ) . '</a></li>';
			$oldest .= '<li class="archive-oldest-posts"><a href="?order=ASC" class="active">' . __( 'Oldest', 'wpmedium' ) . '</a></li>';
		}
		else {
			$newest .= '<li class="archive-newest-posts"><a href="?order=DESC" class="active">' . __( 'Newest', 'wpmedium' ) . '</a></li>';
			$oldest .= '<li class="archive-oldest-posts"><a href="?order=ASC" class="">' . __( 'Oldest', 'wpmedium' ) . '</a></li>';
		}

		return $newest."\n".$oldest;
	}

	/**
	* Get the index control menu links.
	* 
	* @since    1.0
	*/
	function wpmedium_the_archive_controls() {
		echo wpmedium_get_archive_controls();
	}

	/**
	* Display the archive control menu links.
	* 
	* @since    1.0
	*
	* @return   string        The index menu.
	*/
	function wpmedium_get_index_controls() {

		$newest = '';
		$oldest = '';

		if ( isset( $_GET['order'] ) && 'ASC' == $_GET['order'] ) {
			$newest .= '<li class="site-categories-newest"><a href="?order=DESC">' . __( 'Newest', 'wpmedium' ) . '</a></li>';
			$oldest .= '<li class="site-categories-oldest"><a href="?order=ASC" class="active">' . __( 'Oldest', 'wpmedium' ) . '</a></li>';
		}
		else {
			$newest .= '<li class="site-categories-newest"><a href="?order=DESC" class="active">' . __( 'Newest', 'wpmedium' ) . '</a></li>';
			$oldest .= '<li class="site-categories-oldest"><a href="?order=ASC">' . __( 'Oldest', 'wpmedium' ) . '</a></li>';
		}

		return $newest."\n".$oldest;
	}

	/**
	* Display the index control menu links.
	* 
	* @since    1.0
	*/
	function wpmedium_the_index_controls() {
		echo wpmedium_get_index_controls();
	}

	/**
	* WordPress Post nav link.
	* 
	* If AJAX Posts Load is active, return a simple loading button to
	* trigger AJAX. Fall back to default nav_link if setting not set.
	* 
	* @since    1.4
	* 
	* @return   string      HTML formatted links
	*/
	function wpmedium_get_nav_link() {
		return ( wpmedium_o( 'ajax_load' ) ? '<a id="loadmore" href="#">' . __( 'Load More', 'wpmedium' ) . '</a>' : posts_nav_link( ' &#183; ', sprintf( '<span class="pagination-left">%s</span>', __( 'Prev page', 'wpmedium' ) ), sprintf( '<span class="pagination-right">%s</span>', __( 'Next page', 'wpmedium' ) ) ) );
	}

	/**
	* Display custome Post nav_links.
	* 
	* @since    1.4
	* 
	* @return   string      HTML formatted links
	*/
	function wpmedium_nav_link() {
		echo wpmedium_get_nav_link();
	}


	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                       WPMedium Theme Images
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	* Get the site logo
	* If no logo is set in the theme's options, use default WP-Badge as logo 
	* 
	* @since    1.0
	*
	* @return   string        The site logo URL.
	*/
	function wpmedium_get_site_logo() {
		$site_logo = wpmedium_o( 'logo' );
		if ( isset( $site_logo ) && '' != $site_logo )
			return '<img class="site-avatar" src="'.esc_url( $site_logo ) . '" alt="" />';
		else if ( file_exists( get_template_directory() . '/img/wp-badge.png' ) )
			return '<img class="site-avatar" src="'.get_template_directory_uri() . '/img/wp-badge.png" alt="" style="height:auto;margin:-22px 0 0 -42px;" />';
	}

	/**
	* Display the site logo
	* 
	* @since    1.0
	*/
	function wpmedium_the_site_logo() {
		echo wpmedium_get_site_logo();
	}

	/**
	* Get the WPMedium "W" link image
	* 
	* @since    1.1
	*/
	function wpmedium_get_W() {
		$W_image = wpmedium_o( 'w' );
		if ( isset( $W_image ) && '' != $W_image )
			$ret = '<img src="' . esc_url( $W_image ) . '" alt="W" />';
		else
			$ret = '';

		return $ret;
	}

	/**
	* Display the WPMedium "W" link image
	* 
	* @since    1.1
	*/
	function wpmedium_the_W() {
		echo wpmedium_get_W();
	}

	/**
	* 
	* @since    1.0
	*
	* @return   string        .
	*/
	function wpmedium_get_social_links() {

		$ret = '';
		$networks = get_option( 'wpmedium_social_options' );

		if ( count( $networks ) > 0 ) {
			foreach ( $networks as $network => $url ) {
				if ( $url != '' )
					$ret .= '<a href="'.esc_url( $url ) . '"><i class="'.str_replace( '_profile', '', $network ) . '" style="background-image:url('.get_template_directory_uri() . '/img/icons/picon_social/'.str_replace( '_profile', '', $network ) . '.png)"></i></a> ';
			}
		}

		return $ret;
	}

	/**
	* 
	* 
	* @since    1.0
	*/
	function wpmedium_the_social_links() {
	    echo wpmedium_get_social_links();
	}

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                     WPMedium Styles & Scripts
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */


	/**
	* Add the theme's custom settings to <head>, overriding default stylesheets 
	* and loading more scripts
	* 
	* @since    1.0
	*/
	function wpmedium_wp_head() {
		wpmedium_wp_head_styles();
		wpmedium_wp_head_scripts();
	}

	/**
	* Add custom styles the theme based on custom options
	* 
	* @since    1.1
	*/
	function wpmedium_wp_head_styles() {

		echo '<style type="text/css">'."\n";

		// Background Color
		if ( get_theme_mod( 'wpmedium_background' ) != '' )
			echo 'body, .site {background:'.get_theme_mod( 'wpmedium_background' ) . ' !important;} ';
		// W Background Color
		if ( get_theme_mod( 'wpmedium_w_background' ) != '' )
			echo '#WP {background:'.get_theme_mod( 'wpmedium_w_background' ) . ' !important;} ';
		// Text Color
		if ( get_theme_mod( 'wpmedium_text' ) != '' )
			echo 'body, .site {color:'.get_theme_mod( 'wpmedium_text' ) . ' !important;} ';
		// Link Color
		if ( get_theme_mod( 'wpmedium_link' ) != '' )
			echo '.hentry a:link, .hentry a:visited {color:'.get_theme_mod( 'wpmedium_link' ) . ' !important;} ';
		// Link Hover Color
		if ( get_theme_mod( 'wpmedium_link_hover' ) != '' )
			echo '.hentry a:hover {color:'.get_theme_mod( 'wpmedium_link_hover' ) . ' !important;} ';
		// Header Overlay Color
		if ( get_theme_mod( 'wpmedium_header_overlay' ) != '' )
			echo '.site-header-overlay {background:'.get_theme_mod( 'wpmedium_header_overlay' ) . ' !important;} ';
		// Header Sidebar Color
		if ( get_theme_mod( 'wpmedium_header_sidebar' ) != '' )
			echo '.header-sidebar {color:'.get_theme_mod( 'wpmedium_header_sidebar' ) . ' !important;} ';
		// Title Color
		if ( get_theme_mod( 'wpmedium_header_title' ) != '' )
			echo '.entry-header .entry-title a {color:'.get_theme_mod( 'wpmedium_header_title' ) . ' !important;} ';
		// Title Hover Color
		if ( get_theme_mod( 'wpmedium_header_title_hover' ) != '' )
			echo '.entry-header .entry-title a:hover {color:'.get_theme_mod( 'wpmedium_header_title_hover' ) . ' !important;} ';
		//  Footer Text Color
		if ( get_theme_mod( 'wpmedium_footer' ) != '' )
			echo '.site-footer {color:'.get_theme_mod( 'wpmedium_footer' ) . ' !important;} ';
		//  Footer Background Color
		if ( get_theme_mod( 'wpmedium_footer_background' ) != '' )
			echo '.footer-sidebar {background:'.get_theme_mod( 'wpmedium_footer_background' ) . ' !important;} ';
		//  Footer Titles Color
		if ( get_theme_mod( 'wpmedium_footer_widgettitle' ) != '' )
			echo '.footer-inner .widgettitle {color:'.get_theme_mod( 'wpmedium_footer_widgettitle' ) . ' !important;} ';

		echo '    </style>'."\n";
	}

	/**
	* Add custom scripts the theme
	* 
	* @since    1.1
	*/
	function wpmedium_wp_head_scripts() {
		wp_register_script( 'wpmedium', get_template_directory_uri() . '/js/jquery.wpmedium.js', array( 'jquery' ) );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-masonry' );
		wp_enqueue_script( 'wpmedium' );

		wp_localize_script( 'wpmedium', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'loadmore' => __( 'Load More', 'wpmedium' ) ) );
	}



	/**
	* Add custom style to the theme options page
	* 
	* @since    1.0
	*/
	function wpmedium_admin_enqueue_scripts() {

		wp_register_style( 'style-admin', get_template_directory_uri() . '/css/admin.css', array(), '', 'all' );
		wp_register_style( 'pt-sans-narrow', 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow', array(), '', 'all' );

		wp_enqueue_style( 'style-admin' );
		wp_enqueue_style( 'pt-sans-narrow' );

		wp_enqueue_media();
	}

	function wpmedium_ajax_load_posts() {

		$offset = ( isset( $_GET['offset'] ) && '' != $_GET['offset'] ? $_GET['offset'] : 0 );
		$html = '';

		$query = new WP_Query(
			array(
				'offset' => $offset
			)
		);

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'content', get_post_format() );
			}
		}

		wp_reset_postdata();

		die();
	}

	/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	*
	*                  WPMedium Theme Menu & Option Page
	* 
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	/**
	* Theme options page
	* 
	* @since    1.0
	*/
	function wpmedium_theme_menu() {
	    global $wpmedium_options;
	    
	    add_theme_page(
		// The title to be displayed in the browser window for this page.
		'WPMedium options',
		// The text to be displayed for this menu item
		'WPMedium options',
		// Which type of users can see this menu item
		'administrator',
		// The unique ID - that is, the slug - for this menu item
		'wpmedium_theme_options',
		// The name of the function to call when rendering this menu's page
		'wpmedium_theme_display'
	    );
	}

	/**
	* Display theme options page
	* 
	* @since    1.0
	*/
	function wpmedium_theme_display() {

	?>
	    <div class="wrap theme_options">
		
		<h1><?php _e( 'WPMedium Theme Options', 'wpmedium' ); ?></h1>

	    </div>
	    
	    <div class="theme_options_content">
	    
		<div id="settings_errors"><?php settings_errors(); ?></div>
		
		<form id="social_options" class="theme_options_panel" method="post" action="options.php">
		<?php settings_fields( 'wpmedium_social_options' ); ?>
		<?php do_settings_sections( 'wpmedium_social_options' ); ?>
		<?php submit_button( '', 'button-primary theme-panel-submit', 'submit', true, array( 'id' => 'submit_social_options' ) ); ?>  
		</form>

	    </div>
	<?php
	}

	/**
	* Settings Registration
	* 
	* @since    1.0
	*/
	function wpmedium_theme_initialize_options() {

		$options = array(
			array(
				'_id'         => 'facebook_profile',
				'_title'      => __( 'Facebook Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'twitter_profile',
			    '_title'      => __( 'Twitter Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'google+_profile',
			    '_title'      => __( 'Google+ Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'flickr_profile',
			    '_title'      => __( 'Flickr Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'deviantart_profile',
			    '_title'      => __( 'DeviantArt Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'blogger_profile',
			    '_title'      => __( 'Blogger Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'tumblr_profile',
			    '_title'      => __( 'Tumblr Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'reddit_profile',
			    '_title'      => __( 'Reddit Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'lastfm_profile',
			    '_title'      => __( 'LastFm Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'vimeo_profile',
			    '_title'      => __( 'Vimeo Profile', 'wpmedium' ),
			),
			array(
			    '_id'         => 'youtube_profile',
			    '_title'      => __( 'Youtube Profile', 'wpmedium' ),
			)
		);

		add_option( 'wpmedium_social_options' );

		add_settings_section(
			'wpmedium_social_settings_section',
			__( 'Social Settings', 'wpmedium' ),
			'',
			'wpmedium_social_options'
		);

		foreach ( $options as $o ) {
			add_settings_field(  
				$o['_id'],
				$o['_title'],
				'wpmedium_options_callback', 
				'wpmedium_social_options',
				'wpmedium_social_settings_section',
				array(
					'id'    => $o['_id'],
					'title' => $o['_title']
				)
			);
		}

		register_setting(  
			'wpmedium_social_options',
			'wpmedium_social_options'
		);

	}

	/**
	* Section Callback
	* 
	* @since    1.0
	*
	* @param string $section Option section to handle
	*/
	function wpmedium_options_callback( $section ) {
		$default = wpmedium_settings();
		$value   = get_option( 'wpmedium_social_options', $default['social'] );
		$value   = $value[ $section['id'] ];
?>
			<input type="text" id="<?php echo $section['id']; ?>" name="wpmedium_social_options[<?php echo $section['id']; ?>]" value="<?php echo esc_attr( $value ); ?>" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/icons/social_media/_social_<?php echo str_replace( '_profile', '', $section['id'] ); ?>.png);" />
<?php
	}


/** * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* 
*                        WordPress Customization API
* 
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

/**
 * Theme default values
 * 
 * @since    1.0
 * 
 * @return   array    default values
 */
function wpmedium_default() {

	$defaults = array(
		// WPMedium basic options and default values
		'Basics' => array(
			'description'      => '<strong>WPMedium</strong>, a <em>nice</em> WordPress blog theme based on Medium.com, by <a href="http://www.caercam.org/">Charlie MERLAND</a>.',
			'logo'             => get_template_directory_uri() . '/img/WPMedium-logo-simple-32.png',
			'post_thumbnail'   => get_template_directory_uri() . '/img/wpmedium-post-thumbnail.jpg',
			'copyright'        => sprintf( '&copy; %s &mdash; <a href="%s">%s</a>', date( 'Y' ), home_url(), get_bloginfo( 'name' ) ),
			'credit'           => sprintf( '%s <a href="http://wordpress.org">WordPress</a> &mdash; %s <a href="http://www.caercam.org/wpmedium">WPMedium</a> %s <a href="http://www.caercam.org/">CaerCam</a>', __( 'Proudly Powered By', 'wpmedium' ), __( 'Theme', 'wpmedium' ), __( 'By', 'wpmedium' ) ),
			'footer_display'   => 'none'
		),
		// Color theme
		'Colors' => array(
			'background' => array(
				'color'       => '#f9f9f9',
				'label'       => __( 'Background Color', 'wpmedium' ),
			),
			'w_background' => array(
				'color'       => '#dfdfdf',
				'label'       => __( 'W Background Color', 'wpmedium' ),
			),
			'text' => array(
				'color'       => '#1d1d1d',
				'label'       => __( 'Text Color', 'wpmedium' ),
			),
			'header_overlay' => array(
				'color'       => '#000000',
				'label'       => __( 'Header Overlay Color', 'wpmedium' ),
			),
			'header_sidebar' => array(
				'color'       => '#ffffff',
				'label'       => __( 'Header Sidebar Color', 'wpmedium' ),
			),
			'header_title' => array(
				'color'       => '#444444',
				'hover'       => '#45568c',
				'label'       => __( 'Title Color', 'wpmedium' ),
				'label_hover' => __( 'Title Hover Color', 'wpmedium' ),
			),
			'link' => array(
				'color'       => '#5765ad',
				'hover'       => '#45568c',
				'label'       => __( 'Link Color', 'wpmedium' ),
				'label_hover' => __( 'Link Hover Color', 'wpmedium' ),
			),
			'footer' => array(
				'color'       => '#aaa',
				'label'       => __( 'Footer Text Color', 'wpmedium' ),
			),
			'footer_background' => array(
				'color'       => '#d6d6d6',
				'label'       => __( 'Footer Background Color', 'wpmedium' ),
			),
			'footer_widgettitle' => array(
				'color'       => '#424242',
				'label'       => __( 'Footer Titles Color', 'wpmedium' ),
			),
		),
		// Default Images 
		'Images' => array(
			'logo' => array(
				'url'   => wpmedium_o( 'logo' ),
				'label' => __( 'Logo', 'wpmedium' ),
			),
			'w' => array(
				'url'   => wpmedium_o( 'w' ),
				'label' => __( 'W Image', 'wpmedium' ),
			),
			'post_thumbnail' => array(
				'url'   => wpmedium_o( 'default_post_thumbnail' ),
				'label' => __( 'Default Post Thumbnail', 'wpmedium' ),
			),
		),
	);

	return $defaults;
}


/**
 * Add a menu item for the theme customizer
 *
 * @since    1.4
 */
function wpmedium_customizer_menu_item() {
	add_theme_page( __( 'Customize' ), __( 'Customize' ), 'edit_theme_options', 'customize.php' );
}


/**
 * Theme customizer with real-time update
 * Very helpful: http://ottopress.com/2012/theme-customizer-part-deux-getting-rid-of-options-pages/
 *
 * @since    1.4
 */
function wpmedium_theme_customizer( $wp_customize ) {

	$options = wpmedium_default();

	foreach ( $options['Colors'] as $slug => $color ) {

	    $wp_customize->add_setting(
		    'wpmedium_'.$slug,
		    array(
			    'default'   => $color['color'],
			    'transport' => 'postMessage',
		    )
	    );

	    $wp_customize->add_control(
		    new WP_Customize_Color_Control(
			    $wp_customize,
			    'wpmedium_'.$slug,
			    array(
				    'label'    => $color['label'],
				    'section'  => 'colors',
				    'settings' => 'wpmedium_'.$slug,
			    )
		    )
	    );

	    if ( isset( $color['hover'] ) ) {

		$wp_customize->add_setting(
			'wpmedium_'.$slug.'_hover',
			array(
				'default'   => $color['hover'],
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'wpmedium_'.$slug.'_hover',
				array(
					'label'    => $color['label_hover'],
					'section'  => 'colors',
					'settings' => 'wpmedium_'.$slug.'_hover',
				)
			)
		);

	    }

	}

	$wp_customize->add_section(
		'wpmedium_images_section',
		array(
			'title'       => __( 'Images', 'wpmedium' ),
			'priority'    => 30,
			'description' => '',
		)
	);

	foreach ( $options['Images'] as $slug => $image ) {

		$wp_customize->add_setting(
			'wpmedium_'.$slug,
			array(
				'default'   => $image['url'],
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'wpmedium_'.$slug,
				array(
					'label'      => $image['label'],
					'section'    => 'wpmedium_images_section',
					'settings'   => 'wpmedium_'.$slug,
				)
			)
		);

	}

	/*
	 * WPMedium Settings Section
	 */
	$wp_customize->add_section(
		'wpmedium_settings_section',
		array(
			'title'       => __( 'WPMedium', 'wpmedium' ),
			'priority'    => 90,
			'description' => '',
		)
	);

	/* AJAX loading */
	$wp_customize->add_setting(
		'wpmedium_ajax_load',
		array(
			'default'   => true,
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wpmedium_ajax_load',
		array(
			'settings' => 'wpmedium_ajax_load',
			'label'    => __( 'AJAX Posts Load', 'wpmedium' ),
			'section'  => 'wpmedium_settings_section',
			'type'     => 'checkbox',
		)
	);

	/* Post Thumbnails */
	$wp_customize->add_setting(
		'wpmedium_use_post_thumbnail',
		array(
			'default'   => true,
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wpmedium_use_post_thumbnail',
		array(
			'settings' => 'wpmedium_use_post_thumbnail',
			'label'    => __( 'Use Default Post Thumbnail', 'wpmedium' ),
			'section'  => 'wpmedium_settings_section',
			'type'     => 'checkbox',
		)
	);

	/* Default Taxonomy */
	$wp_customize->add_setting(
		'wpmedium_default_taxonomy',
		array(
			'default'   => 'category',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wpmedium_default_taxonomy',
		array(
			'label'   => 'Default Taxonomy',
			'section' => 'wpmedium_settings_section',
			'type'    => 'select',
			'choices'    => array(
				'category' => __( 'Category', 'wpmedium' ),
				'post_tag' => __( 'Post Tag', 'wpmedium' )
			),
		)
	);

	/* Footer Section */
	$wp_customize->add_section(
		'wpmedium_footer_section',
		array(
			'title'       => __( 'Footer', 'wpmedium' ),
			'priority'    => 90,
			'description' => '',
		)
	);

	/* Footer Display */
	$wp_customize->add_setting(
		'wpmedium_footer_display',
		array(
			'default'   => $options['Basics']['footer_display'],
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wpmedium_footer_display',
		array(
			'label'   => 'Default Footer Display',
			'section' => 'wpmedium_footer_section',
			'type'    => 'select',
			'choices'    => array(
				'none'      => __( 'None', 'wpmedium' ),
				'copyright' => __( 'Copyright & Credits', 'wpmedium' ),
				'widget'    => __( 'Widget Area', 'wpmedium' ),
				'both'      => __( 'Both', 'wpmedium' )
			),
		)
	);

	/* WPMedium Credits */
	$wp_customize->add_setting(
		'wpmedium_credits',
		array(
			'default'   => $options['Basics']['credit'],
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wpmedium_credits',
		array(
			'settings' => 'wpmedium_credits',
			'label'    => __( 'WPMedium Credits Line', 'wpmedium' ),
			'section'  => 'wpmedium_footer_section',
			'type'     => 'text',
		)
	);

	/* WPMedium Credits */
	$wp_customize->add_setting(
		'wpmedium_copyright',
		array(
			'default'   => $options['Basics']['copyright'],
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wpmedium_copyright',
		array(
			'settings' => 'wpmedium_copyright',
			'label'    => __( 'WPMedium Copyright Line', 'wpmedium' ),
			'section'  => 'wpmedium_footer_section',
			'type'     => 'text',
		)
	);

	// Set site name and description to be previewed in real-time
	$wp_customize->get_setting('blogname')->transport='postMessage';
	$wp_customize->get_setting('blogdescription')->transport='postMessage';
	$wp_customize->get_setting('wpmedium_logo')->transport='postMessage';

	// Enqueue scripts for real-time preview
	wp_enqueue_script( 'wpmedium-customizer', get_template_directory_uri() . '/js/wpmedium-customizer.js', array( 'jquery' ) );
}

?>