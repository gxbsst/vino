<?php if ( post_password_required() ) : ?>
<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'azul' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
    <h3 id="comments_header"><?php echo __('comments', 'azul') . " [" . get_comments_number() . "]"; ?></h3>

	<div class="comments">
        <?php
    	   wp_list_comments(array( 'callback' => 'anps_comment' )); 
        ?>
	</div>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<?php previous_comments_link( __( '&larr; Older Comments', 'azul' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'azul' ) ); ?>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	if ( ! comments_open() ) :
?>
	<p><?php _e( 'Comments are closed.', 'azul' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

    
        
<?php 
if(!isset($fields))
    $fields =  array(
            'author' => '<p class="comment-form-author">' .
                        '<input id="author" name="author" type="text" placeholder="' . __( 'Name', 'azul' ) . ( $req ? '*' : '') . '" size="30" /></p>',
            'email'  => '<p class="comment-form-email">' .
                        '<input id="email" name="email" type="text" placeholder="' . __( 'Email', 'azul' ) . ( $req ? '*' : '') . '" size="30" /></p>'
    ); 
    $defaults = array(
    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
    'comment_field'        => '<p class="comment-form-comment"><div class="wrap-area"><textarea placeholder="' . __("Message", "azul") . '*" class="required" name="comment" title="message" cols="45" rows="8" aria-required="true"></textarea></div></p>',
    'must_log_in'          => '<p class="must-log-in">You must be logged in to leave a reply.</p>',
    'logged_in_as'         => '<h4 id="comment-header" class="clearfix">' . __('leave a comment', 'azul') . '</h4><span class="comment-sub">' . __('Fields with * are required', 'azul') . '</span><div id="comment-form">',
    'comment_notes_before' => '<h4 id="comment-header" class="clearfix">' . __('leave a comment', 'azul') . '</h4><span class="comment-sub">' . __('Fields with * are required', 'azul') . '</span><div id="comment-form">',
    'title_reply' => '',
    'comment_notes_after'  => '<div class="clear"></div><div class="form-buttons">
                        <span class="btn" data-name="reset"><input type="button" class="form-button" name="reset" value="Reset"></span>
                        <span class="btn" data-name="send"><input type="button" class="form-button" name="send-comment" value="Send"></span>
                    </div></div>',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
 );


comment_form( $defaults ); 

?>
