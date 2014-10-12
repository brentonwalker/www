<?php
/**
 * @package focus
 * @since focus 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<div class="container">

				<h2 class="archive-title">
					<?php wp_title(' ') ?>
				</h2>

				<?php get_template_part('loop') ?>

			</div>
		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>