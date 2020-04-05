<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package onourmoon
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
    <div class="onourmoon_comment_form_wrapper">
    	<div class="onourmoon_comments_title">
    	<?php
    	$oom_comment_title = get_field('comment_form_title', get_the_ID());
    	$oom_comment_title_html = '';
    	if(!empty($oom_comment_title)){
    	    $oom_comment_title_html = '<span>' . $oom_comment_title . '</span>';
    	}
    	?>
    		<h2>LET'S TALK: <?php echo $oom_comment_title_html; ?></h2>
    		<h4><?php comments_number( '&nbsp;', '1 Comment', '% Comments' ); ?></h4>
    	</div>
    	<div class="onourmoon_comment_form">
    		<?php 
    		$args = array(
    			'label_submit' => 'Submit',
    			'title_reply' => '',
    			'comment_notes_before' => '',
    			'cancel_reply_link' => 'Cancel',
    		);
    		comment_form($args); 
    			
    		?>
    	</div>
	</div>

	<?php if ( have_comments() ) : ?>
		<div class="onourmoon_comments_list">
			<h2>WHAT READERS ARE SAYING ABOUT THIS ARTICLE</h2>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'walker' => new OnOUrMoonCommentWalker(),
						'style'      => 'ol',
						'short_ping' => true,
						'avatar_size' => 0,
						'max_depth' => 2,
						//'per_page' => 2,
					) );
				?>
			</ol><!-- .comment-list -->
			<?php the_comments_navigation(); ?>

		</div>

	<?php endif; ?>


</div><!-- #comments -->
