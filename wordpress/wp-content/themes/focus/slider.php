<?php $query = focus_get_slider_posts(); ?>

<?php if($query->have_posts()) : ?>
	<section id="home-slider" class="slider">
		<ul class="slides">
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<?php if(has_post_thumbnail()) : ?>
					<li class="slide" id="slide-post-<?php the_ID() ?>">
						<?php the_post_thumbnail('slider') ?>
						<div class="overlay"></div>
						<div class="slide-text">
							<h1><?php the_title() ?></h1>
							<?php if(has_excerpt()) : ?><p><?php the_excerpt() ?></p><?php endif; ?>
						</div>
						<a href="<?php the_permalink() ?>" class="play"><?php esc_html_e('Play', 'focus') ?></a>
					</li>
				<?php endif; ?>
			<?php endwhile ?>
		</ul>
		
		<div class="slider-decoration"></div>
		
	</section>
	
	<?php wp_reset_postdata(); ?>
<?php endif; ?>