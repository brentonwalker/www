<?php 

function custom_flexslider() { ?>

<div id="slider" class="grid_6">

	<ul id="sb-slider" class="sb-slider">
	    <?php 	$count = of_get_option('w2f_slide_number');
				$slidecat =of_get_option('w2f_slide_categories');
				$query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
	           	if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
	 	
		 		<li>
		 			
				<?php
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
					$image = aq_resize( $img_url, 900, 400, true ); //resize & crop the image
				?>
				
				<?php if($image) : ?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $image ?>"/></a>
				<?php endif; ?>

				<div class="sb-description">
					<h3><?php the_title(); ?></h3>
				</div>
		<?php endwhile; endif; ?>

    		
	  </li>
	</ul>
		<div id="shadow" class="shadow"></div>

				<div id="nav-arrows" class="nav-arrows">
					<a href="#">Next</a>
					<a href="#">Previous</a>
				</div>

</div>	

<script type="text/javascript">
			jQuery(function() {
				
				var Page = (function() {

					var $navArrows = jQuery( '#nav-arrows' ).hide(),
						//$shadow = jQuery( '#shadow' ).hide(),
						slicebox = jQuery( '#sb-slider' ).slicebox( {
							onReady : function() {

								$navArrows.show();
								//$shadow.show();

							},
							orientation : 'r',
							cuboidsRandom : true,
							easing : 'ease'
						} ),
						
						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							// add navigation events
							$navArrows.children( ':first' ).on( 'click', function() {

								slicebox.next();
								return false;

							} );

							$navArrows.children( ':last' ).on( 'click', function() {
								
								slicebox.previous();
								return false;

							} );

						};

						return { init : init };

				})();

				Page.init();

			});
		</script>

	
<?php } ?>