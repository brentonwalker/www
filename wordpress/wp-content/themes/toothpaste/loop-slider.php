<?php if ( have_posts() ) : ?>

<div class="flexslider-wrapper">
	<div class="flexslider">
		<ul class="slides">
			<?php while ( have_posts() ) : the_post(); if( has_post_thumbnail() ) : ?>
				<li class="slide">
					<a href="<?php the_permalink() ?>">
						<?php the_post_thumbnail('toothpaste-slide'); ?>
						<div class="flex-caption">
							<?php the_title() ?>
						</div>
					</a>
				</li>
			<?php endif; endwhile; ?>
		</ul>
	</div>
</div>

<?php endif; ?>