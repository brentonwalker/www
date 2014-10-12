<?php

// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die (__('Please do not load this page directly. Thanks!','bizstudio'));



	if ( post_password_required() ) { ?>

<p class="nocomments">
  <?php _e('This post is password protected. Enter the password to view comments.','bizstudio'); ?>
</p>
<?php

		return;

	}

?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
<h3 id="comments">
  <?php _e('Comments','bizstudio'); ?>
</h3>
<ol class="commentlist">
  <?php wp_list_comments('avatar_size=48'); ?>
</ol>
<div class="navigation comment-nav">
  <div class="alignleft">
    <?php previous_comments_link( __( '&larr; Older Comments', 'bizstudio' ) ); ?>
  </div>
  <div class="alignright">
    <?php next_comments_link( __( 'Newer Comments &rarr;', 'bizstudio' ) ); ?>
  </div>
  <div class="fix"></div>
</div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>

<!-- If comments are open, but there are no comments. -->

<?php else : // comments are closed ?>
<div id="comments_wrap"> 
  
  <!-- If comments are closed. -->
  
  <p class="nocomments">
    <?php _e('Comments are closed.','bizstudio'); ?>
  </p>
</div>

<!-- end #comments_wrap -->

<?php endif; ?>
<?php endif; ?>
<div id="responds">
  <?php if ('open' == $post->comment_status) : ?>
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
  <p>
    <?php _e('You must be','bizstudio'); ?>
    <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">
    <?php _e('logged in','bizstudio'); ?>
    </a>
    <?php _e('to post a comment.','bizstudio'); ?>
  </p>
  <?php else : ?>
  <?php

$aria_req ='';

$message ='<div class="field clearfix">

	<label for="comment">'. __('Message','bizstudio') .'</label>

	<div id="input"><textarea class="textarea" name="comment" id="comment" tabindex="4"></textarea></div>

</div>';

$comment_args = array( 'fields' => apply_filters( 'comment_form_default_fields', array(

           'author' => '' .

                       '<div class="field name clearfix"><label for="author">' . __('Name','bizstudio') .

                       ( $req ? '<span class="required">*</span></label>' : '' ) .

                       '<input id="author" name="author" class="text" type="text"  value="'. esc_attr( $commenter['comment_author'] ) . '" tabindex="1" size="22"' . $aria_req . ' /></div>' .

                       '<!-- #form-section-author .form-section -->',

           'email'  => '' .

                       '<div class="field mail clearfix"><label for="email">' . __( 'Email','bizstudio') .

                       ( $req ? '<span class="required">*</span></label>' : '' ) .

                       '<input id="email" name="email" class="text" type="text"  value="'. esc_attr( $commenter['comment_author_email'] ) .'" size="22"  tabindex="2"' . $aria_req . ' /></div>' .

						'<!-- #form-section-email .form-section -->',

		  'url' => '' .

                       '<div class="field website clearfix"><label for="url">' . __( 'Website','bizstudio' ) .

                       ( $req ? '<span class="required">*</span></label>' : '' ) .

                       '<input class="text" type="text" name="url" id="url" value="'. esc_attr( $commenter['comment_author_email'] ) .'" size="22" tabindex="3"' . $aria_req . ' /></div>' .

                       '<!-- #form-section-author .form-section -->',

            ) ),

           'comment_field' => '' .

                       $message .

                       '<!-- #form-section-comment .form-section -->',

           'comment_notes_after' => '',

       );

       comment_form($comment_args);

?>
  <div class="clear"></div>
  <?php endif; // If registration required and not logged in ?>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>

<!-- end #respond -->