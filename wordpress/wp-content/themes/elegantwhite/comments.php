<div class="show-comments">
<div class="commentline"></div>
<div class="countcomments"><?php comments_number( '', ''. __( '1 Comment', 'elegantwhite' ) .'', '% '. __( 'Comments', 'elegantwhite' ) .'' ); ?></div>
<?php wp_list_comments('type=comment&callback=elegantwhite_comment'); ?>
<?php paginate_comments_links(); ?>  
<div class="margin-70"><?php $comments_args = array(
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => '',
        // redefine your own textarea (the comment body)
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'elegantwhite' ) . '</label></br>
        <textarea id="comment" rows="5" name="comment" aria-required="true"></textarea></p>',
);

comment_form($comments_args); ?></div></div>