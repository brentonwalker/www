<?php

/**
 * This function just gives active widgets a chance to enqueue their scripts
 */
function siteorigin_widgets_enqueue_widget_scripts() {
	global $wp_registered_widgets, $post;
	$active_widgets = array();

	if ( is_page() ) {
		$panel_widget_classes = array();
		$data = get_post_meta( $post->ID, 'panels_data', true );

		if ( !empty( $data['widgets'] ) ) {
			foreach ( $data['widgets'] as $widget ) {
				$panel_widget_classes[ ] = $widget['info']['class'];
			}
		}
	}

	foreach ( $wp_registered_widgets as $widget ) {
		if ( !empty( $widget['callback'][ 0 ] ) && is_object( $widget['callback'][ 0 ] ) ) {
			if ( is_active_widget( false, false, $widget['callback'][ 0 ]->id_base ) ) $active_widgets[ ] = $widget['callback'][ 0 ]->id_base;
			if ( !empty( $panel_widget_classes ) && in_array( get_class( $widget['callback'][ 0 ] ), $panel_widget_classes ) ) $active_widgets[ ] = $widget['callback'][ 0 ]->id_base;
		}
	}

	$active_widgets = array_unique( $active_widgets );

	foreach ( $active_widgets as $widget ) {
		do_action( 'siteorigin_enqueue_widget_scripts_' . $widget );
	}
}

add_action( 'wp_enqueue_scripts', 'siteorigin_widgets_enqueue_widget_scripts' );

/**
 * A call to action widget. Designed to be used on a home page panel
 */
class SiteOrigin_Widgets_CTA extends WP_Widget {
	function __construct() {
		parent::__construct(
			'call-to-action',
			__( 'Call To Action', 'siteorigin' ),
			array(
				'description' => __( 'A call to action block, generally for your home page.', 'siteorigin' ),
			)
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		echo $args['before_widget'];
		if ( !empty( $instance['headline'] ) ) echo '<h2 class="cta-headline">' . esc_html( $instance['headline'] ) . '</h2>';
		if ( !empty( $instance['text'] ) ) echo '<p class="cta-sub-text">' . esc_html( $instance['text'] ) . '</p>';
		if ( !empty( $instance['url'] ) ) {
			?>
		<a href="<?php echo esc_url( $instance['url'] ) ?>" class="button cta-button <?php if ( !empty( $instance['button_style'] ) ) echo esc_attr( 'button-' . $instance['button_style'] . ' cta-button-' . $instance['button_style'] ) ?>">
			<span><?php echo esc_html( $instance['button'] ) ?></span>
		</a>
		<?php
		}
		echo $args['after_widget'];
	}

	/**
	 * @param array $new
	 * @param array $old
	 * @return array|void
	 */
	function update( $new, $old ) {
		$new['headline'] = esc_html( $new['headline'] );
		$new['text'] = esc_html( $new['text'] );
		$new['button'] = esc_html( $new['button'] );
		$new['url'] = esc_url_raw( $new['url'] );
		return $new;
	}

	/**
	 * @param array $instance
	 * @return string|void
	 */
	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'headline' => '',
			'text' => '',
			'button' => '',
			'url' => '',
			'button_style' => false,
		) );

		/**
		 * This gives themes a chance to add their own button styles
		 */
		$button_styles = apply_filters( 'siteorigin_button_styles', array() );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'headline' ) ?>"><?php _e( 'Headline', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'headline' ) ?>" for="<?php echo $this->get_field_id( 'headline' ) ?>" value="<?php echo esc_attr( $instance['headline'] ) ?>">
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ) ?>"><?php _e( 'Text', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'text' ) ?>" id="<?php echo $this->get_field_id( 'text' ) ?>" value="<?php echo esc_attr( $instance['text'] ) ?>">
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'button' ) ?>"><?php _e( 'Button Text', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'button' ) ?>" for="<?php echo $this->get_field_id( 'button' ) ?>" value="<?php echo esc_attr( $instance['button'] ) ?>">
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ) ?>"><?php _e( 'Button URL', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'url' ) ?>" for="<?php echo $this->get_field_id( 'url' ) ?>" value="<?php echo esc_attr( $instance['url'] ) ?>">
		</p>
	
		<?php if ( !empty( $button_styles ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'button_style' ) ?>"><?php _e( 'Button Style', 'siteorigin' ) ?></label>
				<select name="<?php echo $this->get_field_name( 'button_style' ) ?>" for="<?php echo $this->get_field_id( 'button_style' ) ?>">
					<?php foreach ( $button_styles as $style => $name ) : ?>
					<option value="<?php echo esc_attr( $style ) ?>"><?php echo esc_html( $name ) ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php
		endif;
	}
}

/**
 * A call to action widget. Designed to be used on a home page panel
 */
class SiteOrigin_Widgets_Button extends WP_Widget {
	function __construct() {
		parent::__construct(
			'button',
			__( 'Button', 'siteorigin' ),
			array(
				'description' => __( 'Display a button.', 'siteorigin' ),
			)
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

		$instance = wp_parse_args( $instance, array(
			'url' => '#',
			'button' => __( 'Click Me', 'siteorigin' ),
			'align' => 'center',
		) );

		echo $args['before_widget'];
		echo '<div class="button-container align-' . esc_attr( $instance['align'] ) . '">';
		if ( !empty( $instance['url'] ) ) {
			?>
			<a href="<?php echo esc_url( $instance['url'] ) ?>" class="cta-button button <?php if ( !empty( $instance['button_style'] ) ) echo esc_attr( 'cta-button-' . $instance['button_style'] . ' button-' . $instance['button_style'] ) ?>">
				<span><?php echo esc_html( $instance['button'] ) ?></span>
			</a>
			<?php
		}
		echo '</div>';
		echo $args['after_widget'];
	}

	/**
	 * @param array $new
	 * @param array $old
	 * @return array
	 */
	function update( $new, $old ) {
		$new['button'] = strip_tags( $new['button'] );
		$new['url'] = esc_url_raw( $new['url'] );
		return $new;
	}

	/**
	 * @param array $instance
	 * @return string|void
	 */
	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'button' => '',
			'url' => '',
			'align' => 'center',
			'button_style' => false,
		) );

		/**
		 * This gives themes a chance to add their own button styles
		 */
		$button_styles = apply_filters( 'siteorigin_button_styles', array() );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'button' ) ?>"><?php _e( 'Button Text', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'button' ) ?>" for="<?php echo $this->get_field_id( 'button' ) ?>" value="<?php echo esc_attr( $instance['button'] ) ?>">
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ) ?>"><?php _e( 'Button URL', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'url' ) ?>" for="<?php echo $this->get_field_id( 'url' ) ?>" value="<?php echo esc_attr( $instance['url'] ) ?>">
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'align' ) ?>"><?php _e( 'Alignment', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'align' ) ?>" id="<?php echo $this->get_field_id( 'align' ) ?>">
				<option value="left" <?php selected( 'left', $instance['align'] ) ?>><?php esc_html_e( 'Left', 'siteorigin' ) ?></option>
				<option value="center" <?php selected( 'center', $instance['align'] ) ?>><?php esc_html_e( 'Center', 'siteorigin' ) ?></option>
				<option value="right" <?php selected( 'right', $instance['align'] ) ?>><?php esc_html_e( 'Right', 'siteorigin' ) ?></option>
				<option value="full" <?php selected( 'full', $instance['align'] ) ?>><?php esc_html_e( 'Full Width', 'siteorigin' ) ?></option>
			</select>
		</p>
	
		<?php if ( !empty( $button_styles ) ) : ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'button_style' ) ?>"><?php _e( 'Button Style', 'siteorigin' ) ?></label>
				<select name="<?php echo $this->get_field_name( 'button_style' ) ?>" for="<?php echo $this->get_field_id( 'button_style' ) ?>">
					<?php foreach ( $button_styles as $style => $name ) : ?>
					<option value="<?php echo esc_attr( $style ) ?>"><?php echo esc_html( $name ) ?></option>
					<?php endforeach; ?>
				</select>
			</p>
		<?php
		endif;
	}
}

/**
 * A widget that displays some text, a headline and an icon.
 */
class SiteOrigin_Widgets_IconText extends WP_Widget {
	function __construct() {
		parent::__construct(
			'icon-text',
			__( 'Icon and Text', 'siteorigin' ),
			array(
				'description' => __( 'A block of text with an icon.', 'siteorigin' ),
			)
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( !empty( $instance['headline'] ) ) {
			echo $args['before_title'] . $instance['headline'] . $args['after_title'];
		}

		if ( !empty( $instance['icon'] ) ) {
			?><div class="feature-icon"><?php echo wp_get_attachment_image($instance['icon'], 'thumbnail') ?></div><?php
		}

		if ( !empty( $instance['text'] ) ) {
			?><div class="widget-text entry-content"><?php echo wpautop( do_shortcode( $instance['text'] ) ) ?></div><?php
		}

		echo $args['after_widget'];
	}

	/**
	 * @param array $new
	 * @param array $old
	 * @return array|void
	 */
	function update( $new, $old ) {
		$instance = $new;

		$instance['headline'] = strip_tags( $instance['headline'] );
		if ( current_user_can( 'unfiltered_html' ) )
			$instance['text'] = $instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $instance['text'] ) ) );
		$instance['url'] = esc_url_raw( $instance['url'] );

		return $instance;
	}

	/**
	 * @param array $instance
	 * @return string|void
	 */
	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'headline' => '',
			'text' => '',
			'url' => '',
			'icon' => false,
		) ) ;
		
		$attachments = get_posts(array(
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'posts_per_page' => -1,
			'post_status' => 'any'
		));
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'headline' ) ?>"><?php _e( 'Headline', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'headline' ) ?>" id="<?php echo $this->get_field_id( 'headline' ) ?>" value="<?php echo esc_attr( $instance['headline'] ) ?>">
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ) ?>"><?php _e( 'Text', 'siteorigin' ) ?></label>
			<textarea class="widefat" rows="3" name="<?php echo $this->get_field_name( 'text' ) ?>" id="<?php echo $this->get_field_id( 'headline' ) ?>"><?php echo esc_textarea( $instance['text'] ) ?></textarea>
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'url' ) ?>"><?php _e( 'URL', 'siteorigin' ) ?></label>
			<input class="widefat" name="<?php echo $this->get_field_name( 'url' ) ?>" id="<?php echo $this->get_field_id( 'url' ) ?>" value="<?php echo esc_attr( $instance['url'] ) ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ) ?>"><?php _e( 'Icon', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'icon' ) ?>" id="<?php echo $this->get_field_id( 'icon' ) ?>">
				<option value="0" <?php selected( !empty($instance['icon']) ) ?>><?php echo esc_html_e('None') ?></option>
				<?php foreach ( $attachments as $attachment ) : ?>
					<option value="<?php echo $attachment->ID ?>" <?php selected( $instance['icon'], $attachment->ID ) ?>><?php echo esc_html( $attachment->post_title ) ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p class="description">
			<?php
			printf(
			//__('Upload icon images to your <a href="%$2s" onclick="return confirm(\'%$1s\')">media library</a>. Find <a href="%$3s" onclick="return confirm(\'%$1s\')">free icon packs.', 'siteorigin'),
				__('Upload icon images to your <a href="%s" target="_blank">media library</a>. Find <a href="%s" target="_blank">free icon packs</a>.', 'siteorigin'),
				admin_url('upload.php'),
				'http://support.siteorigin.com/icon-sets/'
			);
			?>
		</p>
		<?php
	}
}

class SiteOrigin_Widgets_PostList extends WP_Widget {
	function __construct() {
		WP_Widget::__construct(
			'postlist',
			__( 'Post List', 'siteorigin' ),
			array(
				'description' => __( 'Displays a list of posts.', 'siteorigin' ),
			)
		);
	}

	/**
	 *
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( !empty( $instance['headline'] ) ) {
			echo $args['before_title'] . $instance['headline'] . $args['after_title'];
		}

		$posts = get_posts( array(
			'numberposts' => $instance['numberposts'],
			'orderby' => $instance['orderby'],
			'order' => $instance['order'],
			'post_type' => $instance['post_type'],
		) );

		$thumbnail_size = apply_filters( 'siteorigin_widgets_postlist_thumbnail_size', 'post-thumbnail' );

		?><div class="flexslider-carousel"><ul class="posts slides"><?php

		global $post;
		foreach ( $posts as $post ) {
			setup_postdata( $post );
			?>
			<li id="post-<?php the_ID() ?>" <?php post_class( 'summary' ) ?>>
				<div class="thumbnail">
					<a href="<?php the_permalink() ?>">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( $thumbnail_size ) ?>
						<?php else : ?>
							<!-- Temporary thumbnail -->
							<img src="<?php echo get_template_directory_uri() ?>/images/thumbnail-placeholder.jpg" width="250" height="175" />
						<?php endif ?>
					</a>
				</div>

				<?php if ( $instance['show_titles'] ) : ?>
				<div class="post-info">
					<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
				</div>
				<?php endif; ?>
			</li>
			<?php
		}
		wp_reset_postdata();

		?></ul></div><?php

		echo $args['after_widget'];
	}

	/**
	 * @param array $new
	 * @param array $old
	 * @return array
	 */
	function update( $new, $old ) {
		$new['headline'] = esc_html( $new['headline'] );
		$new['show_titles'] = !empty( $new['show_titles'] );

		return $new;
	}

	/**
	 * @param array $instance
	 * @return string|void
	 */
	function form( $instance ) {
		$types = get_post_types( array( 'public' => true ), 'objects' );
		unset( $types['attachment'] );

		$instance = wp_parse_args( $instance, array(
			'headline' => '',
			'post_type' => 'post',
			'numberposts' => '5',
			'orderby' => 'post_date',
			'order' => 'DESC',
			'show_titles' => true,
		) );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'headline' ) ?>"><?php _e( 'Headline', 'siteorigin' ) ?></label>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'headline' ) ?>" id="<?php echo $this->get_field_id( 'headline' ) ?>" value="<?php echo esc_attr( $instance['headline'] ) ?>" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ) ?>"><?php _e( 'Post Type', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'post_type' ) ?>" id="<?php echo $this->get_field_id( 'post_type' ) ?>">
				<?php foreach ( $types as $name => $o ) : ?>
				<option value="<?php echo esc_attr( $name ) ?>" <?php selected( $name, $instance['post_type'] ) ?>>
					<?php echo esc_html( isset( $o->labels->name ) ? $o->labels->name : ucfirst( $name ) ) ?>
				</option>
				<?php endforeach ?>
			</select>
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'numberposts' ) ?>"><?php _e( 'Post Count', 'siteorigin' ) ?>
			<input type="text" class="small-text" name="<?php echo $this->get_field_name( 'numberposts' ) ?>" id="<?php echo $this->get_field_id( 'numberposts' ) ?>" value="<?php echo esc_attr( intval( $instance['numberposts'] ) ) ?>" />
		</p>
	
		<p>
			<label><?php _e( 'Order By', 'siteorigin' ) ?></label>
			
			<select name="<?php echo $this->get_field_name( 'orderby' ) ?>">
				<option value="post_date" <?php selected( 'post_date', $instance['orderby'] ) ?>><?php esc_html_e( 'Post Date', 'siteorigin' ) ?></option>
				<option value="title" <?php selected( 'title', $instance['orderby'] ) ?>><?php esc_html_e( 'Post Title', 'siteorigin' ) ?></option>
				<option value="menu_order" <?php selected( 'menu_order', $instance['orderby'] ) ?>><?php esc_html_e( 'Menu Order', 'siteorigin' ) ?></option>
				<option value="rand" <?php selected( 'rand', $instance['orderby'] ) ?>><?php esc_html_e( 'Random', 'siteorigin' ) ?></option>
			</select>
	
			<select name="<?php echo $this->get_field_name( 'order' ) ?>">
				<option value="DESC" <?php selected( 'DESC', $instance['order'] ) ?>><?php esc_html_e( 'Descending', 'siteorigin' ) ?></option>
				<option value="ASC" <?php selected( 'ASC', $instance['order'] ) ?>><?php esc_html_e( 'Ascending', 'siteorigin' ) ?></option>
			</select>
		</p>
	
		<p>
			<label>
				<input name="<?php echo $this->get_field_name( 'show_titles' ) ?>" type="checkbox" <?php checked( $instance['show_titles'] ) ?>>
				<?php _e( 'Show Post Title', 'siteorigin' ) ?>
			</label>
		</p>
	
		<?php
	}
}


/**
 * Simply displays a headline
 */
class SiteOrigin_Widgets_Headline extends WP_Widget {
	function __construct() {
		parent::__construct(
			'headline',
			__( 'Headline', 'siteorigin' ),
			array(
				'description' => __( 'Displays a simple headline.', 'siteorigin' ),
			)
		);
	}

	function widget( $args, $instance ) {
		if ( empty( $instance['headline'] ) ) return;

		echo $args['before_widget'];
		echo $args['before_title'] . '<span class="size-' . $instance['size'] . ' align-' . $instance['align'] . '">' . $instance['headline'] . '</span>' . $args['after_title'];
		echo $args['after_widget'];
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, array(
			'headline' => '',
			'size' => 'large',
			'align' => 'center'
		) );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'headline' ) ?>"><?php _e( 'Headline Text', 'siteorigin' ) ?>
			<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'headline' ) ?>" id="<?php echo $this->get_field_id( 'headline' ) ?>" value="<?php echo esc_attr( $instance['headline'] ) ?>" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ) ?>"><?php _e( 'Size', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'size' ) ?>" id="<?php echo $this->get_field_id( 'size' ) ?>">
				<option value="small" <?php selected( 'small', $instance['size'] ) ?>><?php esc_html_e( 'Small', 'siteorigin' ) ?></option>
				<option value="medium" <?php selected( 'medium', $instance['size'] ) ?>><?php esc_html_e( 'Medium', 'siteorigin' ) ?></option>
				<option value="large" <?php selected( 'large', $instance['size'] ) ?>><?php esc_html_e( 'Large', 'siteorigin' ) ?></option>
				<option value="extra-large" <?php selected( 'extra-large', $instance['size'] ) ?>><?php esc_html_e( 'Extra Large', 'siteorigin' ) ?></option>
			</select>
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'align' ) ?>"><?php _e( 'Alignment', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'align' ) ?>" id="<?php echo $this->get_field_id( 'align' ) ?>">
				<option value="left" <?php selected( 'left', $instance['align'] ) ?>><?php esc_html_e( 'Left', 'siteorigin' ) ?></option>
				<option value="center" <?php selected( 'center', $instance['align'] ) ?>><?php esc_html_e( 'Center', 'siteorigin' ) ?></option>
				<option value="right" <?php selected( 'right', $instance['align'] ) ?>><?php esc_html_e( 'Right', 'siteorigin' ) ?></option>
			</select>
		</p>
		<?php
	}
}

class SiteOrigin_Widgets_Gallery extends WP_Widget {
	function __construct() {
		parent::__construct(
			'gallery',
			__( 'Gallery', 'siteorigin' ),
			array(
				'description' => __( 'Displays a gallery.', 'siteorigin' ),
			)
		);
	}

	function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		$shortcode_attr = array();
		foreach($instance as $k => $v){
			if(empty($v)) continue;
			$shortcode_attr[] = $k.'="'.esc_attr($v).'"';
		}
		
		echo do_shortcode('[gallery '.implode(' ', $shortcode_attr).']');
		
		echo $args['after_widget'];
	}

	function update( $new, $old ) {
		return $new;
	}

	function form( $instance ) {
		global $_wp_additional_image_sizes;

		$types = apply_filters('siteorigin_gallery_types', array());
		
		$instance = wp_parse_args($instance, array(
			'ids' => '',
			'image_size' => '',
			'type' => apply_filters('siteorigin_gallery_default_type', ''),
		));
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'ids' ) ?>"><?php _e( 'Gallery Images', 'siteorigin' ) ?></label>
			<a href="#" onclick="return false;" class="so-gallery-widget-select-attachments show-in-panels hidden"><?php _e('edit gallery', 'siteorigin') ?></a>
			<input type="text" class="widefat" value="<?php echo esc_attr($instance['ids']) ?>" name="<?php echo $this->get_field_name('ids') ?>" />
		</p>
		<p class="description">
			<?php _e("Comma separated attachment IDs. Defaults to all current page's attachments.") ?>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ) ?>"><?php _e( 'Image Size', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'size' ) ?>" id="<?php echo $this->get_field_id( 'size' ) ?>">
				<option value="" <?php selected(empty($instance['image_size'])) ?>><?php esc_html_e('Default', 'siteorigin') ?></option>
				<option value="large" <?php selected('large', $instance['image_size']) ?>><?php esc_html_e( 'Large', 'siteorigin' ) ?></option>
				<option value="medium" <?php selected('medium', $instance['image_size']) ?>><?php esc_html_e( 'Medium', 'siteorigin' ) ?></option>
				<option value="thumbnail" <?php selected('thumbnail', $instance['image_size']) ?>><?php esc_html_e( 'Thumbnail', 'siteorigin' ) ?></option>
				<option value="full" <?php selected('full', $instance['image_size']) ?>><?php esc_html_e( 'Full', 'siteorigin' ) ?></option>
				<?php foreach ( $_wp_additional_image_sizes as $name => $info ) : ?>
					<option value="<?php echo esc_attr( $name ) ?>" <?php selected($name, $instance['image_size']) ?>><?php echo esc_html( $name ) ?></option>
				<?php endforeach ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ) ?>"><?php _e( 'Gallery Type', 'siteorigin' ) ?></label>
			<select name="<?php echo $this->get_field_name( 'type' ) ?>" id="<?php echo $this->get_field_id( 'type' ) ?>">
				<option value="" <?php selected(empty($instance['type'])) ?>><?php esc_html_e('Default', 'siteorigin') ?></option>
				<?php foreach($types as $id => $name) : ?>
					<option value="<?php echo esc_attr( $id ) ?>" <?php selected($id, $instance['type']) ?>><?php echo esc_html( $name ) ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<?php
	}
}

class SiteOrigin_Widgets_PostContent extends WP_Widget {
	function __construct() {
		parent::__construct(
			'post-content',
			__( 'Post Content', 'siteorigin' ),
			array(
				'description' => __( 'Displays some form of post content form the current post.', 'siteorigin' ),
			)
		);
	}

	function widget( $args, $instance ) {
		echo $args['before_widget'];
		$content = apply_filters('siteorigin_widget_post_content', $this->default_content($instance['type']));
		echo $content;
		echo $args['after_widget'];
	}

	/**
	 * The default content for post types
	 * @param $type
	 * @return string
	 */
	function default_content($type){
		global $post;
		if(empty($post)) return;
		
		switch($type) {
			case 'title' :
				return '<h1 class="entry-title">' . $post->post_title . '</h1>';
			case 'content' :
				return '<div class="entry-content">' . wpautop($post->post_content) . '</div>';
			case 'featured' :
				if(!has_post_thumbnail()) return '';
				return '<div class="featured-image">' . get_the_post_thumbnail($post->ID) . '</div>';
			default :
				return '';
		}
	}
	
	function update($new, $old){
		return $new;
	}

	function form( $instance ) {
		$instance = wp_parse_args($instance, array(
			'type' => 'content',
		));
		
		$types = apply_filters('siteorigin_widget_post_content_types', array(
			'title' => __('Title', 'siteorigin'),
			'content' => __('Content', 'siteorigin'),
			'featured' => __('Featured Image', 'siteorigin'),
			'tags' => __('Post Tags', 'siteorigin'),
			'categories' => __('Post Categories', 'siteorigin'),
		));
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ) ?>"><?php _e( 'Display Content', 'siteorigin' ) ?></label>
			<select id="<?php echo $this->get_field_id( 'type' ) ?>" name="<?php echo $this->get_field_name( 'type' ) ?>">
				<?php foreach ($types as $type_id => $title) : ?>
					<option value="<?php echo esc_attr($type_id) ?>" <?php selected($type_id, $instance['type']) ?>><?php echo esc_html($title) ?></option>
				<?php endforeach ?>
			</select>
		</p>
		<?php
	}
}

class SiteOrigin_Widgets_Image extends WP_Widget {
	function __construct() {
		parent::__construct(
			'siteorigin-image',
			__( 'Image', 'siteorigin' ),
			array(
				'description' => __( 'Displays a simple image.', 'siteorigin' ),
			)
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		if(!empty($instance['href'])) echo '<a href="' . $instance['href'] . '">';
		echo '<img src="'.esc_url($instance['src']).'" />';
		if(!empty($instance['href'])) echo '</a>';
		echo $args['after_widget'];
	}
	
	function update($new, $old){
		$new = wp_parse_args($new, array(
			'src' => '',
			'href' => '',
		));
		return $new;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args($instance, array(
			'src' => '',
			'href' => '',
		));
		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'src' ) ?>"><?php _e( 'Image URL', 'siteorigin' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'src' ) ?>" name="<?php echo $this->get_field_name( 'src' ) ?>" value="<?php echo esc_attr($instance['src']) ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'href' ) ?>"><?php _e( 'Destination URL', 'siteorigin' ) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'href' ) ?>" name="<?php echo $this->get_field_name( 'href' ) ?>" value="<?php echo esc_attr($instance['href']) ?>" />
		</p>
		<?php
	}
}

class SiteOrigin_Widgets_PostLoop extends WP_Widget{
	function __construct() {
		parent::__construct(
			'siteorigin-postloop',
			__( 'Post Loop', 'siteorigin' ),
			array(
				'description' => __( 'Displays a post loop.', 'siteorigin' ),
			)
		);
	}

	function widget( $args, $instance ) {
		$template = $instance['template'];
		$query_args = $instance;
		unset($query_args['template']);
		unset($query_args['additional']);
		unset($query_args['sticky']);
		
		$query_args = wp_parse_args($instance['additional'], $query_args);
		
		global $wp_query;
		$query_args['paged'] = $wp_query->get('paged');
		
		switch($instance['sticky']){
			case 'ignore' :
				$query_args['ignore_sticky_posts'] = 1;
				break;
			case 'only' :
				$query_args['post__in'] = get_option( 'sticky_posts' );
				break;
			case 'exclude' :
				$query_args['post__not_in'] = get_option( 'sticky_posts' );
				break;
		}
		
		// Create the query
		query_posts($query_args);
		
		locate_template($instance['template'], true, false);
		
		// Reset everything
		wp_reset_query();
		wp_reset_postdata();
	}

	function update($new, $old){
		return $new;
	}
	
	function get_loop_templates(){
		$templates = array();
		
		$files = glob(get_template_directory().'/loop*.php');
		foreach($files as $file){
			$templates[] = basename($file);
		}
		$files = glob(get_stylesheet_directory().'/loop*.php');
		foreach($files as $file){
			$templates[] = basename($file);
		}
		$templates = array_unique($templates);
		sort($templates);
		
		return $templates;
	}

	function form( $instance ) {
		$instance = wp_parse_args($instance, array(
			'template' => 'loop.php',
			
			// Query args
			'post_type' => 'post',
			'posts_per_page' => '',
			
			'order' => 'DESC',
			'orderby' => 'date',
			
			'sticky' => '',
			
			'additional' => '',
		));
		
		// Get all the loop template files
		$templates = $this->get_loop_templates();
		$post_types = get_post_types(array('public' => true));
		$post_types = array_values($post_types);
		$post_types = array_diff($post_types, array('attachment', 'revision', 'nav_menu_item'));
		
		?>
		<p>
			<label <?php $this->get_field_id('template') ?>><?php _e('Template', 'siteorigin') ?></label>
			<select id="<?php echo $this->get_field_id( 'template' ) ?>" name="<?php echo $this->get_field_name( 'template' ) ?>">
				<?php foreach($templates as $template) : ?>
					<option value="<?php echo esc_attr($template) ?>" <?php selected($instance['template'], $template) ?>><?php echo esc_html($template) ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label <?php $this->get_field_id('post_type') ?>><?php _e('Post Type', 'siteorigin') ?></label>
			<select id="<?php echo $this->get_field_id( 'post_type' ) ?>" name="<?php echo $this->get_field_name( 'post_type' ) ?>" value="<?php echo esc_attr($instance['post_type']) ?>">
				<?php foreach($post_types as $type) : ?>
					<option value="<?php echo esc_attr($type) ?>" <?php selected($instance['post_type'], $type) ?>><?php echo esc_html($type) ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label <?php $this->get_field_id('posts_per_page') ?>><?php _e('Posts Per Page', 'siteorigin') ?></label>
			<input type="text" class="small-text" id="<?php echo $this->get_field_id( 'posts_per_page' ) ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ) ?>" value="<?php echo esc_attr($instance['posts_per_page']) ?>" />
		</p>

		<p>
			<label <?php $this->get_field_id('orderby') ?>><?php _e('Order By', 'siteorigin') ?></label>
			<select id="<?php echo $this->get_field_id( 'orderby' ) ?>" name="<?php echo $this->get_field_name( 'orderby' ) ?>" value="<?php echo esc_attr($instance['orderby']) ?>">
				<option value="none" <?php selected($instance['orderby'], 'none') ?>><?php esc_html_e('None', 'siteorigin') ?></option>
				<option value="ID" <?php selected($instance['orderby'], 'ID') ?>><?php esc_html_e('Post ID', 'siteorigin') ?></option>
				<option value="author" <?php selected($instance['orderby'], 'author') ?>><?php esc_html_e('Author', 'siteorigin') ?></option>
				<option value="name" <?php selected($instance['orderby'], 'name') ?>><?php esc_html_e('Name', 'siteorigin') ?></option>
				<option value="name" <?php selected($instance['orderby'], 'name') ?>><?php esc_html_e('Name', 'siteorigin') ?></option>
				<option value="date" <?php selected($instance['orderby'], 'date') ?>><?php esc_html_e('Date', 'siteorigin') ?></option>
				<option value="modified" <?php selected($instance['orderby'], 'modified') ?>><?php esc_html_e('Modified', 'siteorigin') ?></option>
				<option value="parent" <?php selected($instance['orderby'], 'parent') ?>><?php esc_html_e('Parent', 'siteorigin') ?></option>
				<option value="rand" <?php selected($instance['orderby'], 'rand') ?>><?php esc_html_e('Random', 'siteorigin') ?></option>
				<option value="comment_count" <?php selected($instance['orderby'], 'comment_count') ?>><?php esc_html_e('Comment Count', 'siteorigin') ?></option>
				<option value="menu_order" <?php selected($instance['orderby'], 'menu_order') ?>><?php esc_html_e('Menu Order', 'siteorigin') ?></option>
				<option value="menu_order" <?php selected($instance['orderby'], 'menu_order') ?>><?php esc_html_e('Menu Order', 'siteorigin') ?></option>
			</select>
		</p>

		<p>
			<label <?php $this->get_field_id('order') ?>><?php _e('Order', 'siteorigin') ?></label>
			<select id="<?php echo $this->get_field_id( 'order' ) ?>" name="<?php echo $this->get_field_name( 'order' ) ?>" value="<?php echo esc_attr($instance['order']) ?>">
				<option value="DESC" <?php selected($instance['order'], 'DESC') ?>><?php esc_html_e('Descending', 'siteorigin') ?></option>
				<option value="ASC" <?php selected($instance['order'], 'ASC') ?>><?php esc_html_e('Ascending', 'siteorigin') ?></option>
			</select>
		</p>

		<p>
			<label <?php $this->get_field_id('sticky') ?>><?php _e('Sticky Posts', 'siteorigin') ?></label>
			<select id="<?php echo $this->get_field_id( 'sticky' ) ?>" name="<?php echo $this->get_field_name( 'sticky' ) ?>" value="<?php echo esc_attr($instance['sticky']) ?>">
				<option value="" <?php selected($instance['sticky'], '') ?>><?php esc_html_e('Default', 'siteorigin') ?></option>
				<option value="ignore" <?php selected($instance['sticky'], 'ignore') ?>><?php esc_html_e('Ignore Sticky', 'siteorigin') ?></option>
				<option value="exclude" <?php selected($instance['sticky'], 'exclude') ?>><?php esc_html_e('Exclude Sticky', 'siteorigin') ?></option>
				<option value="only" <?php selected($instance['sticky'], 'only') ?>><?php esc_html_e('Only Sticky', 'siteorigin') ?></option>
			</select>
		</p>

		<p>
			<label <?php $this->get_field_id('additional') ?>><?php _e('Additional ', 'siteorigin') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'additional' ) ?>" name="<?php echo $this->get_field_name( 'additional' ) ?>" value="<?php echo esc_attr($instance['additional']) ?>" />
			<small><?php printf(__('Additional query arguments. See <a href="%s" target="_blank">query_posts</a>.', 'siteorigin'), 'http://codex.wordpress.org/Function_Reference/query_posts') ?></small>
		</p>
		<?php
	}
}

/**
 * Initialize the SiteOrigin widgets. This can be called on widgets_init
 */
function siteorigin_widgets_init() {
	register_widget( 'SiteOrigin_Widgets_CTA' );
	register_widget( 'SiteOrigin_Widgets_Button' );
	register_widget( 'SiteOrigin_Widgets_IconText' );
	register_widget( 'SiteOrigin_Widgets_PostList' );
	register_widget( 'SiteOrigin_Widgets_Headline' );
	register_widget( 'SiteOrigin_Widgets_Gallery' );
	register_widget( 'SiteOrigin_Widgets_PostContent' );
	register_widget( 'SiteOrigin_Widgets_Image' );
	register_widget( 'SiteOrigin_Widgets_PostLoop' );
}
