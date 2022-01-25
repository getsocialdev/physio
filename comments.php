<div class="comment_holder clearfix" id="comments">
    <div class="comment_number">
        <div class="comment_number_inner">
            <h5><?php comments_number( __('No Comments','physio'), '1'.__('&nbsp;Comment','physio'), '% '.__('Comments','physio')); ?></h5>
        </div>
    </div>
    <div class="comments">
        <?php if ( post_password_required() ) : ?>
            <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'physio' ); ?></p>
        <?php return; endif; ?>
        <?php if ( have_comments() ) : ?>
	<ul class="comment-list">
		<?php wp_list_comments(array_unique(array_merge(array('callback'=>'physio_comment'),apply_filters('physio_comments_callback', array())))); ?>
	</ul>
<?php else :
	if ( ! comments_open() ) : ?>
		<p><?php _e('Sorry, the comment form is closed at this time.', 'physio'); ?></p>
	<?php endif; ?>
<?php endif; ?>
    </div>

</div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=>'<h5>'. __( 'Post a comment','physio' ) .'</h5>',
	'title_reply_to' => __( 'Post a reply to %s','physio' ),
	'cancel_reply_link' => __( 'Cancel reply','physio' ),
	'label_submit' => __( 'Submit','physio' ),
	'comment_field'        => apply_filters( 'physio_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_html__( 'Write your comment here...', 'physio' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>' ),
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
	'author' => '<div class="row clearfix"><div class="col-sm-6"><div class="column_inner"><input id="author" name="author" placeholder="'. __( 'Your full name','physio' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
	'email' => '<div class="col-sm-6"><div class="column_inner"><input id="email" name="email" placeholder="'. __( 'E-mail address','physio' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div></div>',
	'url' => '<div class="row clearfix"><div class="col-sm-12"><div class="column_inner"><input id="url" name="url" type="text" placeholder="'. __( 'Website','physio' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div>'
)));
$args = apply_filters( 'physio_comment_form_final_fields', $args );
?>
<div class="comment_pager">
	<p><?php paginate_comments_links(); ?></p>
</div>
<div class="comment_form">
	<?php comment_form($args); ?>
</div>
