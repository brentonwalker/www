<?php
/**
 * Title: Theme Upsell.
 *
 * Description: Displays list of all Sketchtheme themes linking to it's pro and free versions.
 *
 *
 * @author   Sketchtheme
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     http://www.sketchthemes.com/
 */

// Add stylesheet and JS for sell page.
function bizstudio_sell_style() {

    // Set template directory uri
    $directory_uri = get_template_directory_uri();
    wp_enqueue_style( 'upsell_style', get_template_directory_uri() . '/SketchBoard/includes/css/upsell.css' );
}

// Add upsell page to the menu.
function bizstudio_add_upsell() {
    $page = add_theme_page( 'Sketch Themes', 'Sketch Themes', 'administrator', 'sketch-themes', 'bizstudio_display_upsell' );

    add_action( 'admin_print_styles-' . $page, 'bizstudio_sell_style' );
}

add_action( 'admin_menu', 'bizstudio_add_upsell' );

// Define markup for the upsell page.
function bizstudio_display_upsell() {

    // Set template directory uri
    $directory_uri = get_template_directory_uri();
    ?>

    <div class="wrap">
    <div class="container-fluid">
    <div id="upsell_container">
    <div class="row-fluid">
        <div id="upsell_header" class="span12">
            <h2>
                <a href="http://www.sketchthemes.com/" target="_blank">
                    <img src="http://demo.sketchthemes.com/preview-images/social-icons/sketch-logo.png"/>
                </a>
            </h2>
        </div>
    </div>
    <div id="upsell_themes" class="row-fluid">
	
		<!-- -------------- Timeliner Pro ------------------- -->

        <div id="Timeliner" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="www.sketchthemes.com/themes/timeliner-minimal-ultra-responsive-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/timeliner/Timeliner_Modeling_Demo.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="www.sketchthemes.com/themes/timeliner-minimal-ultra-responsive-wordpress-theme/" target="_blank"><h4>Timeliner - Minimal Ultra Responsive WordPress Theme</h4></a>

                    <div class="theme-description">
                        <p>Timeliner is a premier timeline theme for WordPress. Timeliner is a minimal, clean, modern and highly customizable theme. It allows you to create their website around any niche without the need of any complicated HTML code knowledge. Be it a Blog, Portfolio, Corporate, Agency, any other kind of website Timeliner will be a good pick for you. With our advanced admin panel, tons of customizations are possible and that will help you redefine your website&#39;s brand value. Also, this theme comes with retina ready feature. You can see great details on any devices screen.</p>
                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/members/signup.php?price_group=30&product_id=30&hide_paysys=paypal_r" target="_blank"><?php _e( 'Buy Timeliner Pro', 'bizstudio' ); ?></a>
                    <a class="buy  btn btn-info" href="http://sketchthemes.com/samples/timeliner-modeling-agency/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
 
                </div>
            </div>
        </div>

        <!-- -------------- BizNez Pro ------------------- -->

        <div id="biznez" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/biznez-multi-purpose-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/biznez/biznez-career-counseling-demo.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/biznez-multi-purpose-wordpress-theme/" target="_blank"><h4>Biznez - Multi Purpose Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>Biznez - Multi Purpose Wordpress Theme is a custom wordpress theme with ultimate features that you wont need an additional plugin if you use the Biznez wordpress theme. Highly SEO optimized for performance.</p>

                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/biznez-multi-purpose-wordpress-theme/" target="_blank"><?php _e( 'Buy Biznez Pro', 'bizstudio' ); ?></a>
                    <a class="buy  btn btn-info" href="http://demo.sketchthemes.com/preview-images/biznez/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://wordpress.org/themes/biznez-lite" target="_blank"><?php _e( 'Try Biznez Free', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>

        <!-- -------------- Analytical Pro ------------------- -->

        <div id="analytical" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/analytical-full-width-responsive-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/analytical/Analytical_Interior_Demo.png"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/analytical-full-width-responsive-wordpress-theme/" target="_blank"><h4>Analytical Full Width Responsive Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>Show all your creativity with the new full size theme that allows you to show all your creativity in one place and that too full size.</p>
                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/analytical-full-width-responsive-wordpress-theme/" target="_blank"><?php _e( 'Buy Analytical Pro', 'bizstudio' ); ?></a>
                    <a class="buy  btn btn-info" href="http://demo.sketchthemes.com/preview-images/analytical/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://wordpress.org/themes/analytical-lite" target="_blank"><?php _e( 'Try Analytical Free', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>
		
        <!-- -------------- BizStudio Pro ------------------- -->

        <div id="bizstudio" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/bizstudio-full-width-responsive-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/bizstudio/bizstudio-default-demo.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/bizstudio-full-width-responsive-wordpress-theme/" target="_blank"><h4>BizStudio Full Width Responsive Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>Bizstudio is a Simple, Minimal, Responsive, One Click Install, Beautiful and Elegent WordPress Theme. Along with the elegent design the theme is highly flexible and customizable with easy to use Admin Panel Options. From a wide range of options some key options are custom two different layout option(full width and with sidebar), 5 widget areas, custom follow us and contact widget, Logo, logo alt text, custom favicon, social links, rss feed button, custom copyright text and many more. Also it is compitable with various popular plugins like All in One SEO Pack, WP Super Cache, Contact Form 7 etc. It is translation ready as well.</p>
                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/bizstudio-full-width-responsive-wordpress-theme/" target="_blank"><?php _e( 'Buy BizStudio Pro', 'bizstudio' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/bizstudio/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://wordpress.org/themes/bizstudio-lite" target="_blank"><?php _e( 'Try BizStudio Lite', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>
		
		<!-- -------------- Fullscreen Pro ------------------- -->

        <div id="FullScreen" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/fullscreen-onepager-responsive-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/fullscreen/fullscreen-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/fullscreen-onepager-responsive-wordpress-theme/" target="_blank"><h4>FullScreen - OnePager Responsive WordPress Theme</h4></a>

                    <div class="theme-description">
                        <p>FullScreen is clean, multipurpose and elegant WordPress theme with fully responsive layout. Theme is suited for all photographers, creative, business and portfolio websites. Theme includes lots of features like full-screen slider, modular homepage, layout shortcodes and more. With our advanced admin panel, tons of customizations are possible and that will help you redefine your website brand value.</p>
                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/fullscreen-onepager-responsive-wordpress-theme/" target="_blank"><?php _e( 'Buy FullScreen Pro', 'bizstudio' ); ?></a>
                    <a class="buy btn btn-info" href="http://sketchthemes.com/samples/fullscreen-default-demo/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://www.sketchthemes.com/themes/fullscreen-onepager-responsive-wordpress-theme/" target="_blank"><?php _e( 'Try FullScreen Lite', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>

		<!-- -------------- Irex Pro ------------------- -->

        <div id="Irex" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/irex-full-width-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/irex/irex-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/irex-full-width-wordpress-theme/" target="_blank"><h4>Irex Full Width Portfolio Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>Irex is a simple, minimal, responsive, easy to use, one click install, beautiful and Elegent WordPress Theme with Easy Custom Admin Options Created by SketchThemes.com. Using Irex theme options any one can easily customize this theme according to their need. You can use your own Logo, logo alt text, custom favicon, you can add social links, rss feed to homepage, you can use own copyright text etc. And all this information can be entered using Irex Theme Options Panel. You have to just set the content from the Irex  Themes Options Panel and it will be up ready to use.</p>
                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/irex-full-width-wordpress-theme/" target="_blank"><?php _e( 'Buy Irex Pro', 'bizstudio' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/irex/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://www.sketchthemes.com/themes/irex-full-width-wordpress-theme/" target="_blank"><?php _e( 'Try Irex Lite', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>
		
		<!-- -------------- Swiftbiz Pro ------------------- -->

        <div id="Swiftbiz" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/swiftbiz-business-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/swiftbiz/swiftbiz-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/swiftbiz-business-wordpress-theme/" target="_blank"><h4>SwiftBiz Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>SwiftBiz theme will help you build a site for your business using wordpress with only one click. The homepage of SwiftBiz theme is fully-widgetized and it is completely customizable from theme admin panel. It contains seperate page templates for full width page, login page, register page, blog page, sitemap etc. It also provide you ability to integrate it with various social media sites. Also it has a very nice gallery and portfolio management section in admin panel.</p>
                    </div>

                    <a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/swiftbiz-business-wordpress-theme/" target="_blank"><?php _e( 'Buy Swiftbiz Pro', 'bizstudio' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/swiftbiz/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://www.sketchthemes.com/themes/swiftbiz-business-wordpress-theme/" target="_blank"><?php _e( 'Try Swiftbiz Lite', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>
		
		<!-- -------------- Sketchmini Pro ------------------- -->

        <div id="Sketchmini" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/sketchmini-free-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/sketchmini/sketchmini-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/sketchmini-free-wordpress-theme/" target="_blank"><h4>SketchMini Free Responsive WordPress Theme</h4></a>

                    <div class="theme-description">
                        <p>SketchMini is a Responsive WordPress Theme Free to use with a GPL. SketchMini has got great features and awesome backend to make use of the available features in the theme. You dont need to be an expert to use this SketchMini theme. SketchMini can act as a great base theme to create any great website.</p>
                    </div>

                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/sketchmini/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
                    <a class="free btn btn-success" href="http://www.sketchthemes.com/themes/sketchmini-free-wordpress-theme/#FreeDownloadButton" target="_blank"><?php _e( 'Try Sketchmini Lite', 'bizstudio' ); ?></a>
                </div>
            </div>
        </div>

		<!-- -------------- StoneAge Pro ------------------- -->

        <div id="StoneAge" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/stoneage-premium-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/stoneage/stoneage-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/stoneage-premium-wordpress-theme/" target="_blank"><h4>StoneAge Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>A Wordpress Theme to show people what you have got. Catch the attention of users at first sight. Easy to setup and use and 5 Cool color skins and most importantly SEO optimized to get you on top of Search Engines.</p>
                    </div>

					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/stoneage-premium-wordpress-theme/" target="_blank"><?php _e( 'Buy StoneAge Pro', 'bizstudio' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/stone-age/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
					
                </div>
            </div>
        </div>

		<!-- -------------- 3rd-wired Pro ------------------- -->

        <div id="3rd-wired" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="http://www.sketchthemes.com/themes/3rd-wired-premium-wordpress-theme/" target="_blank">
                        <img src="http://www.demo.sketchthemes.com/preview-images/3rd-wired/3rd-wired-mac-420px.png" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="http://www.sketchthemes.com/themes/3rd-wired-premium-wordpress-theme/" target="_blank"><h4>3rd-wired Wordpress Theme</h4></a>

                    <div class="theme-description">
                        <p>Get your user wired to your website with this highly customizable premium wordpress theme. Show off your portfolio, connect to them socially and more importantly highly SEO optimized. All you need from a wordpress theme.</p>
                    </div>

					<a class="buy btn btn-primary" href="http://www.sketchthemes.com/themes/3rd-wired-premium-wordpress-theme/" target="_blank"><?php _e( 'Buy 3rd-wired Pro', 'bizstudio' ); ?></a>
                    <a class="buy btn btn-info" href="http://demo.sketchthemes.com/preview/3rd-wired/" target="_blank"><?php _e( 'View Demo', 'bizstudio' ); ?></a>
					
                </div>
            </div>
        </div>
		
    </div>
    <!-- upsell themes -->
    </div>
    <!-- upsell container -->
    </div>
    <!-- container-fluid -->
    </div>
<?php
}

?>