<?php

/**
 * Display the premium admin menu
 *
 * @action admin_menu
 */
function siteorigin_premium_admin_menu() {
	// Don't display this page if the user has already upgraded to premium
	if ( defined( 'SITEORIGIN_IS_PREMIUM' ) ) return;

	add_theme_page( __( 'Premium Upgrade', 'siteorigin' ), __( 'Premium Upgrade', 'siteorigin' ), 'switch_themes', 'premium_upgrade', 'siteorigin_premium_page_render' );
}

add_action( 'admin_menu', 'siteorigin_premium_admin_menu' );

/**
 * Render the premium page
 */
function siteorigin_premium_page_render() {
	$theme = basename( get_template_directory() );
	define('SITEORIGIN_PREMIUM_SUPPORTED_COST', 10);

	if ( isset( $_GET['action'] ) ) $action = $_GET['action'];
	else $action = 'view';

	switch ( $action ) {
		case 'view':
			$premium = apply_filters( 'siteorigin_premium_content', array() );

			if ( empty( $premium ) ) {
				?>
				<div class="wrap" id="theme-upgrade">
					<h2><?php _e( 'Premium Upgrade', 'siteorigin' ) ?></h2>
					<p>
						<?php printf(__( "There's a premium version of %s coming soon.", 'siteorigin' ),ucfirst( $theme )); ?>
					</p>
				</div>
				<?php
				return;
			}

			?>
			<div class="wrap" id="theme-upgrade">
				<form id="theme-upgrade-info" method="post" action="<?php echo esc_url( add_query_arg( 'action', 'enter-order' ) ) ?>">
					<p>
						<?php
						printf(
							__( "After you pay for %s Premium, we'll email you a download link and an order number to your <strong>PayPal email address</strong>. ", 'siteorigin' ) ,
							ucfirst( $theme )
						);
						printf(
							__( "Use <a href='%s' target='_blank'>this form</a> if you don't receive your order number in the next 15 minutes. ", 'siteorigin' ) ,
							'http://siteorigin.com/orders/'
						);
						_e( 'Be sure to check your spam folder.', 'siteorigin' );
						?>
					</p>

					<label><strong><?php _e( 'Order Number', 'siteorigin' ) ?></strong></label>
					<input type="text" class="regular-text" name="order_number" />
					<input type="submit" value="<?php esc_attr_e( 'Enable Upgrade', 'siteorigin' ) ?>" />
					<?php wp_nonce_field( 'save_order_number', '_upgrade_nonce' ) ?>
				</form>
				
				<a href="#" id="theme-upgrade-already-paid" class="button"><?php _e( 'Already Paid?', 'siteorigin' ) ?></a>
				<?php if ( isset( $premium['premium_title'] ) ) : ?><h2><?php echo $premium['premium_title'] ?></h2><?php endif; ?>
				<?php if ( isset( $premium['premium_summary'] ) ) : ?><p><?php echo $premium['premium_summary'] ?></p><?php endif; ?>

				<?php if ( isset( $premium['buy_url'] ) ) : ?>
				<p class="download">
					<span class="buy-button-wrapper">
						<a href="<?php echo esc_url( $premium['buy_url'] ) ?>" class="buy-button <?php echo !empty($premium['buy_url_supported']) ? 'has-support-choices' : '' ?>">
							<span><?php _e('Buy Upgrade', 'siteorigin') ?></span><em><?php echo '$'.$premium['buy_price'] ?></em>
						</a>
					</span>
					<?php if ( isset( $premium['buy_message_1'] ) ) : ?><span class="info"><?php echo $premium['buy_message_1'] ?></span><?php endif; ?>
				</p>
				<?php endif; ?>

				<?php if ( !empty( $premium['featured'] ) ) : ?>
					<p id="promo-image">
						<img src="<?php echo esc_url( $premium['featured'][ 0 ] ) ?>" width="<?php echo intval( $premium['featured'][ 1 ] ) ?>" height="<?php echo intval( $premium['featured'][ 2 ] ) ?>" class="magnify" />
					</p>
				<?php endif; ?>
				<div class="content">
					<?php if ( !empty( $premium['features'] ) ) : foreach ( $premium['features'] as $feature ) : ?>
						<?php if(!empty($feature['image'])) echo '<div class="feature-image-wrapper"><img src="'.esc_url($feature['image']).'" width="220" height="120" class="feature-image" /></div>' ?>
						<h3><?php echo $feature['heading'] ?></h3>
						<p><?php echo $feature['content'] ?></p>
						<div class="clear"></div>
					<?php endforeach; endif; ?>
				</div>
				
				<?php if ( isset( $premium['buy_url'] ) ) : ?>
				<p class="download">
					<span class="buy-button-wrapper">
						<a href="<?php echo esc_url( $premium['buy_url'] ) ?>" class="buy-button <?php echo !empty($premium['buy_url_supported']) ? 'has-support-choices' : '' ?>">
							<span><?php _e('Buy Upgrade', 'siteorigin') ?></span><em><?php echo '$'.$premium['buy_price'] ?></em>
						</a>
					</span>
					<?php if ( isset( $premium['buy_message_2'] ) ) : ?><span class="info"><?php echo $premium['buy_message_2'] ?></span><?php endif; ?>
				</p>
				<?php endif; ?>
				
				<?php if(!empty($premium['testimonials'])): ?>
					<h3 class="testimonials-heading"><?php _e('Some of our User Comments', 'siteorigin') ?></h3>
					<ul class="testimonials">
						<?php foreach($premium['testimonials'] as $testimonial) : ?>
							<li>
								<div class="avatar" style="background-image: url(http://www.gravatar.com/avatar/<?php echo esc_attr($testimonial['gravatar']) ?>?d=identicon&s=55)"></div>
								<div class="text">
									<div class="content"><?php echo $testimonial['content'] ?></div>
									<div class="name"><?php echo $testimonial['name'] ?></div>
								</div>
								<div class="clear"></div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if(!empty($premium['buy_url_supported'])) : ?>
					<div id="support-choice">
						<h2><?php _e('What Level of Support Do You Need?', 'siteorigin') ?></h2>

						<div class="support-price-table">
							<div class="column column-standard">
								<div class="title-wrapper">
									<div class="title">
										<h3><?php echo '$' . ( $premium['buy_price'] ) ?></h3>
									</div>
								</div>

								<div class="feature"><strong><?php _e('Premium theme with lifetime updates', 'siteorigin') ?></strong></div>
								<div class="feature"><?php _e('Standard email support', 'siteorigin') ?></div>
								<div class="feature"><?php _e('1-2 day response time', 'siteorigin') ?></div>
								<div class="feature"><?php _e('Theme setup support', 'siteorigin') ?></div>
								<div class="feature"><?php _e('Help from SiteOrigin support staff', 'siteorigin') ?></div>
								<div class="feature"><?php _e('90 days of support', 'siteorigin') ?></div>


								<div class="buy-wrapper">
									<a href="<?php echo esc_url($premium['buy_url']) ?>" class="buy-button"><?php _e('Standard Support', 'siteorigin') ?></a>
								</div>
							</div>

							<div class="column column-recommended">
								<div class="recommended"><?php _e('Recommended', 'siteorigin') ?></div>
								<div class="title-wrapper">
									<div class="title">
										<h3><?php echo '$' . ( SITEORIGIN_PREMIUM_SUPPORTED_COST + $premium['buy_price'] ) ?></h3>
									</div>
								</div>

								<div class="feature"><strong><?php _e('Premium theme with lifetime updates', 'siteorigin') ?></strong></div>
								<div class="feature"><?php _e('<strong>Fast</strong> email support', 'siteorigin') ?></div>
								<div class="feature"><?php _e('<strong>4hr response</strong> during <abbr title="9am-6pm, Monday-Friday GMT 2+">office hours</a>', 'siteorigin') ?></div>
								<div class="feature"><?php _e('<strong>Basic customization</strong> and setup support', 'siteorigin') ?></div>
								<div class="feature"><?php _e('Help from our <strong>WordPress developers</strong>', 'siteorigin') ?></div>
								<div class="feature"><?php _e('A <strong>full year</strong> of theme support', 'siteorigin') ?></div>

								<div class="buy-wrapper">
									<a href="<?php echo esc_url($premium['buy_url_supported']) ?>" class="buy-button"><?php _e('Priority Support', 'siteorigin') ?></a>
								</div>
							</div>
						</div>

						<p class="extra-info">
							<?php printf(__('%1$s Premium includes email support.', 'siteorigin'), ucfirst($theme)) ?>
							<?php printf(__("For an extra <strong>%s</strong>, you get faster replies and more detailed answers. Perfect if you're on a deadline.", 'siteorigin'), '$'.(SITEORIGIN_PREMIUM_SUPPORTED_COST)) ?>
							<?php _e("You're free to use our premium themes on as many sites as you like.", 'siteorigin') ?>
						</p>

					</div>
					<div id="support-choice-overlay"></div>
				<?php endif; ?>
			</div>
			<div id="magnifier">
				<div class="image"></div>
			</div>
			
			<?php
			break;

		case 'enter-order' :
			$option_name = 'siteorigin_order_number_' . $theme;
			if ( isset( $_POST['_upgrade_nonce'] ) && wp_verify_nonce( $_POST['_upgrade_nonce'], 'save_order_number' ) && isset( $_POST['order_number'] ) ) {
				update_option( $option_name, trim( $_POST['order_number'] ) );
			}

			// Validate the order number
			$result = wp_remote_get(
				add_query_arg( array(
					'order_number' => get_option( $option_name ),
					'action' => 'validate_order_number',
				), SITEORIGIN_THEME_ENDPOINT . '/premium/' . $theme . '/' )
			);
			$valid = null;
			if ( !is_wp_error( $result ) ) {
				$validation_result = unserialize( $result['body'] );
				$valid = isset( $validation_result['valid'] ) ? $validation_result['valid'] : null;
				if ( $valid ) {
					// Trigger a refresh of the theme update information
					set_site_transient( 'update_themes', null );
				}
			}

			?>
			<div class="wrap" id="theme-upgrade">
				<h2><?php printf(__('Your Order Number Is [%s]', 'siteorigin'), get_option( $option_name )) ?></h2>

				<?php if ( is_null( $valid ) ) : ?>
				<p>
					<?php _e( "There was a problem contacting our validation servers.", 'siteorigin' ) ?>
					<?php _e( "Please try again later, or upgrade manually using the ZIP file we sent you.", 'siteorigin' ) ?>
				</p>
				<?php elseif ( $valid ) : ?>
				<p>
					<?php _e( "We've validated your order number.", 'siteorigin' ) ?>
					<?php
					printf(
						__( 'You can update now, or later on your <a href="%s">Themes page</a>.', 'siteorigin' ),
						admin_url( 'themes.php' )
					);
					?>
					<?php _e( 'This update will add all the premium features.', 'siteorigin' ) ?>
				</p>
				<p class="submit">
					<?php
					$update_url = wp_nonce_url( admin_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $theme ) ), 'upgrade-theme_' . $theme );
					$update_onclick = 'onclick="if ( confirm(\'' . esc_js( __( "Updating this theme will lose any code customizations (CSS, PHP, Javascript, etc) you have made to the free version. You will not lose your content, images or settings. 'Cancel' to stop, 'OK' to update.", 'siteorigin' ) ) . '\') ) {return true;}return false;"';
					?>
					<a href="<?php echo esc_url( $update_url ) ?>" <?php echo $update_onclick ?> class="button-primary">
						<?php _e( 'Update Theme', 'siteorigin' ) ?>
					</a>
				</p>
				<?php else : ?>
				<p>
					<?php _e( "We couldn't validate your order number.", 'siteorigin' ) ?>
					<?php _e( "There might be a problem with our validation server.", 'siteorigin' ) ?>
					<?php _e( "Please try again later, or upgrade manually using the ZIP file we sent you.", 'siteorigin' ) ?>
				</p>
				<?php endif; ?>
			</div>
			<?php
			break;
	}
}

/**
 * Enqueue admin scripts
 *
 * @param $prefix
 * @return mixed
 *
 * @action admin_enqueue_scripts
 */
function siteorigin_premium_admin_enqueue( $prefix ) {
	// Ignore this for premium themes
	if(defined( 'SITEORIGIN_IS_PREMIUM' )) return;
	
	if ( $prefix == 'appearance_page_premium_upgrade' ) {
		wp_enqueue_script( 'siteorigin-magnifier', get_template_directory_uri() . '/extras/premium/js/magnifier.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'siteorigin-cycle', get_template_directory_uri() . '/extras/premium/js/cycle.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'siteorigin-premium-upgrade', get_template_directory_uri() . '/extras/premium/js/premium.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		
		wp_enqueue_style( 'siteorigin-premium-upgrade', get_template_directory_uri() . '/extras/premium/css/premium.css', array(), SITEORIGIN_THEME_VERSION );
	}

	$screen = get_current_screen();
	$teaser_required = false;
	
	// Check if this is a required post type
	if( ( $prefix == 'post.php' || $prefix == 'post-new.php' ) && siteorigin_premium_teaser_get_support('post-type', $screen->id) ) $teaser_required = true;
	if( siteorigin_premium_teaser_get_support('page', $prefix) || $prefix == 'appearance_page_theme_settings_page') $teaser_required = true;
	
	if($teaser_required){
		wp_enqueue_style( 'siteorigin-premium-teaser', get_template_directory_uri() . '/extras/premium/css/premium-teaser.css', array(), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'siteorigin-premium-teaser', get_template_directory_uri() . '/extras/premium/js/premium-teaser.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
	}

	// Enqueue the page templates teaser, which works slightly differently
	if( siteorigin_premium_teaser_get_support('page-templates') ){
		wp_enqueue_script( 'siteorigin-premium-teaser-templates', get_template_directory_uri() . '/extras/premium/js/premium-teaser-templates.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		
		wp_localize_script( 'siteorigin-premium-teaser-templates', 'siteoriginTeaserTemplates' , array(
			'code' => '<p>'.siteorigin_premium_teaser(
				__('Get Additional Templates', 'siteorigin'),
				array(
					'description' => sprintf(__('%s Premium includes additional templates', 'siteorigin'), ucfirst(get_option('stylesheet')))
				),
				true
			).'</p>'
		) );
	}
}

add_action( 'admin_enqueue_scripts', 'siteorigin_premium_admin_enqueue' );

/**
 * Adds one or more post types to the list that are requesting the premium teaser scripts.
 * 
 * @param $post_types
 */
function siteorigin_premium_teaser_post_types( $post_types ) {
	$post_types = (array)$post_types;
	if ( empty( $GLOBALS[ 'siteorigin_premium_teaser_post_types' ] ) )
		$GLOBALS[ 'siteorigin_premium_teaser_post_types' ] = array();

	$GLOBALS[ 'siteorigin_premium_teaser_post_types' ] = array_merge(
		$GLOBALS[ 'siteorigin_premium_teaser_post_types' ],
		$post_types
	);
}

function siteorigin_premium_call_function($callback, $param_array, $args = array()){
	if(function_exists($callback) && defined('SITEORIGIN_IS_PREMIUM')){
		call_user_func_array($callback, $param_array);
	}
	else{
		$theme = basename( get_template_directory() );
		if(!empty($args['before'])) echo $args['before'];
		?>
		<a class="siteorigin-premium-teaser" href="<?php echo admin_url( 'themes.php?page=premium_upgrade' ) ?>" target="_blank">
			<em></em>
			<?php printf( __( 'Only available in <strong>%s Premium</strong> - <strong class="upgrade">Upgrade Now</strong>', 'siteorigin' ), ucfirst($theme) ) ?>
			<?php if(!empty($args['teaser-image'])) : ?>
				<div class="teaser-image"><img src="<?php echo esc_url($args['teaser-image']) ?>" width="220" height="120" /><div class="pointer"></div></div>
			<?php endif; ?>
		</a>
		<?php if(!empty($args['description'])) : ?>
			<div class="siteorigin-premium-teaser-description"><?php echo $args['description'] ?></div>
		<?php
		endif;
		if(!empty($args['after'])) echo $args['after'];
	}
}

function siteorigin_premium_teaser($text, $args = null, $return = false){
	if(defined('SITEORIGIN_IS_PREMIUM')) return;
	
	if($return) ob_start();
	
	?>
	<a class="siteorigin-premium-teaser" href="<?php echo admin_url( 'themes.php?page=premium_upgrade' ) ?>" target="_blank">
		<em></em>
		<?php echo $text ?>
		<?php if(!empty($args['teaser-image'])) : ?>
			<div class="teaser-image"><img src="<?php echo esc_url($args['teaser-image']) ?>" width="220" height="120" /><div class="pointer"></div></div>
		<?php endif; ?>
	</a>
	<?php if(!empty($args['description'])) : ?>
		<div class="siteorigin-premium-teaser-description"><?php echo $args['description'] ?></div>
	<?php
	endif;
	
	if($return) return ob_get_clean();
}

/**
 * Check if we support a specific type of teaser
 * 
 * @param $type
 * @param $sub
 * @return bool
 */
function siteorigin_premium_teaser_get_support($type, $sub = false){
	if(defined('SITEORIGIN_IS_PREMIUM')) return false;

	$teaser = get_theme_support( 'siteorigin-premium-teaser' );
	if(empty($teaser)) return false;
	$teaser = $teaser[0];
	
	// If we're teasing page templates, then include the page post type
	if(empty($teaser['post-type'])) $teaser['post-type'] = array();
	if(!empty($teaser['page-templates'])) $teaser['post-type'][] = 'page';
	$teaser['post-type'] = array_unique($teaser['post-type']);

	// Return the result
	if(!empty($teaser[$type]) && is_array($teaser[$type]) && !empty($sub)){
		return in_array($sub, $teaser[$type]);
	}
	else{
		return !empty($teaser[$type]);
	}
}

/**
 * Enqueue scripts for the customizer
 */
function siteorigin_premium_teaser_customizer_enqueue(){
	if(!siteorigin_premium_teaser_get_support('customizer')) return;
	
	wp_enqueue_style( 'siteorigin-premium-teaser', get_template_directory_uri() . '/extras/premium/css/premium-teaser.css', array(), SITEORIGIN_THEME_VERSION );
	wp_enqueue_script( 'siteorigin-premium-teaser', get_template_directory_uri() . '/extras/premium/js/premium-teaser.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
}
add_action('customize_controls_enqueue_scripts', 'siteorigin_premium_teaser_customizer_enqueue');

function siteorigin_premium_teaser_customizer(){
	if(!siteorigin_premium_teaser_get_support('customizer')) return;
	
	/**
	 * @var WP_Customize_Manager
	 */
	global $wp_customize;
	$teaser_customizer = new SiteOrigin_Premium_Teaser_Customizer($wp_customize, 'siteorigin-premium-teaser');
	$wp_customize->add_section($teaser_customizer);
}
add_action('customize_controls_init', 'siteorigin_premium_teaser_customizer', 100);

if(class_exists('WP_Customize_Section')) :
class SiteOrigin_Premium_Teaser_Customizer extends WP_Customize_Section{
	function render() {
		?><div class="siteorigin-premium-teaser-customizer-wrapper"><?php
		siteorigin_premium_teaser(__('Get Additional Customizations', 'siteorigin'));
		?></div><?php
	}
}
endif;