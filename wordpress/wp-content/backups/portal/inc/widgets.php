<?php

Class Portal_Widget_MegaTitle extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mega_title', // Base ID
			__('Mega Headline', 'portal'), // Name
			array( 'description' => __( 'A huge headline like the default home page title.', 'portal' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		?>
		<h1 <?php if(!empty($instance['editable'])) siteorigin_setting_editable($instance['editable']['title']) ?>>
			<?php echo esc_html($instance['title']) ?>
		</h1>
		<h2 <?php if(!empty($instance['editable'])) siteorigin_setting_editable($instance['editable']['title']) ?>>
			<?php echo esc_html($instance['subtitle']) ?>
			<div class="decoration"></div>
		</h2>
		<?php

		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		$instance['editable'] = false;

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args($instance, array(
			'title' => __('This is Huge', 'portal'),
			'subtitle' => __('But this is smaller', 'portal'),
		));

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'portal' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Sub Title:', 'portal' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $instance['subtitle'] ); ?>" />
		</p>
		<?php
	}
}

function portal_init_widgets(){
	register_widget('Portal_Widget_MegaTitle');
}
add_action( 'widgets_init', 'portal_init_widgets' );