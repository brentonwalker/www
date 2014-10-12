<?php

class Focus_Post_Author_Widget extends WP_Widget {

	public function __construct() {
		// widget actual processes
		parent::__construct(
			'focus_post_author_widget', // Base ID
			'Focus_Post_Author_Widget', // Name
			array( 'description' => __( 'Displays the post author.', 'focus' ), ) // Args
		);
	}

	public function form( $instance ) {
		// outputs the options form on admin
		?><p><?php _e("This widget doesn't have any settings", 'focus') ?></p><?php
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		return $new_instance;
	}

	public function widget( $args, $instance ) {
		// outputs the content of the widget
		global $post;
		if(!empty($post));
		
		echo $args['before_widget'];
		echo get_avatar(get_the_author_meta('ID'), 40);
		
		?>
		<div class="author-text">
			<div class="title"><?php echo esc_html( siteorigin_setting( 'video_by_text', __('Video By', 'focus') ) ) ?></div>
			<div class="author"><?php the_author_meta( 'display_name' ) ?></div>
		</div>
		<div class="clear"></div>
		<div class="post-info"><?php focus_posted_on() ?></div>
		<?php
		echo $args['after_widget'];
		
	}

}
register_widget( 'Focus_Post_Author_Widget' );