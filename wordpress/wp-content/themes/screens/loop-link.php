<article <?php post_class() ?>>
<h2 class="link"><a href="<?php echo screens_link_format(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
	<?php screens_date(); ?>
    <?php  the_excerpt(); ?>
    <div class="clear"></div>
</article>