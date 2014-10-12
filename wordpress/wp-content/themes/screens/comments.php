<div <?php  if ( comments_open() ) { ?> id="comments" <?php } ?>>
<?php if ( post_password_required() ) : ?>
<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'screens' ); ?></p>
			</div><!-- #comments -->
<?php return;	endif; ?>

<?php if ( have_comments() ) : ?>
<h3>
<?php printf(__('Response to <strong>%1$s</strong>', 'screens'),  get_the_title() ); ?>
</h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="wp-pagenavi">
<?php paginate_comments_links(); ?>	
            </div><!-- .navigation -->
<?php endif; ?>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'custom_comments' ) ); ?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="wp-pagenavi">
<?php paginate_comments_links(); ?>	
            </div><!-- .navigation -->
<?php endif;  ?>

<?php else : if ( ! comments_open() ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed', 'screens' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
