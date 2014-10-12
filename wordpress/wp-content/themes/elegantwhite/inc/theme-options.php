
<div id="top-bar">Let's get ready for Christmas! Visit fimply.de on November 29th and check out our great Black Friday Sale!</div>

<div class="wrap">

  <form method="post" action="options.php">
	<?php settings_fields( 'elegantwhite_options' ); ?>

<div class="h2"><?php screen_icon(); ?><h2><?php _e( 'elegantWhite Theme Settings', 'elegantwhite' ); ?></h2></div>



 <div class="adminitem">
 
<h2> We just have Theme Options in elegantWhite Pro - An amazing theme for just $8.99!</h2>
<p>Please check the site in the menu which is called "Ready to go Pro?".</p>

<p>elegantWhite is NOT optimized to look perfect in Internet Explorer 8+. Upgrade to Pro, which is optimized. (:</p>
 
 </div>



<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
<div class="update">
	<strong><?php _e( 'The settings have been saved.', 'elegantwhite'); ?></strong>
</div>
<?php endif; ?>

    
  
</div>
