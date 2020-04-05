<?php


if ( ! class_exists( 'OnOUrMoonCommentWalker' ) ) {
	/**
	 * CUSTOM COMMENT WALKER
	 * A custom walker for comments, based on the walker in Twenty Nineteen.
	 */
	class OnOUrMoonCommentWalker extends Walker_Comment {

		/**
		 * Outputs a comment in the HTML5 format.
		 *
		 * @see wp_list_comments()
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
		 * @see https://developer.wordpress.org/reference/functions/get_avatar/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
		 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
		 *
		 * @param WP_Comment $comment Comment to display.
		 * @param int        $depth   Depth of the current comment.
		 * @param array      $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {
            $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    
            $commenter = wp_get_current_commenter();
            if ( $commenter['comment_author_email'] ) {
                $moderation_note = __( 'Your comment is awaiting moderation.' );
            } else {
                $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.' );
            }
    
            ?>
            <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
                <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <?php
                            if ( 0 != $args['avatar_size'] ) {
                                echo get_avatar( $comment, $args['avatar_size'] );
                            }
                            ?>
                            <?php
                                printf(
                                    /* translators: %s: Comment author link. */
                                    __( '%s <span class="says">says:</span>' ),
                                    sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
                                );
                            ?>
                        </div><!-- .comment-author -->
    
                        <div class="comment-metadata">
                            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php
                                        /* translators: 1: Comment date, 2: Comment time. */
                                        printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
                                    ?>
                                </time>
                            </a>
                            <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
                        </div><!-- .comment-metadata -->
    
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                        <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
                        <?php endif; ?>
                    </footer><!-- .comment-meta -->
    
                    <div class="comment-content">
                        <?php comment_text(); ?>
                    </div><!-- .comment-content -->
                    
                    <div class="article_reacts">
                        <?php
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );


                        $love_icon = 'fa fa-heart-o';
                        $disabled_btn = '';
                        if(isset($_COOKIE['comment_loved_'.get_comment_ID()])){
                            if($_COOKIE['comment_loved_'.get_comment_ID()] == 'loved') {
                                $love_icon = 'fa fa-heart';
                                $disabled_btn = 'disabled';
                            }  
                        }
                        ?>
                        <div class="love_react">
                            <button class="love_this_comment" data-id="<?php comment_ID(); ?>" <?php echo $disabled_btn; ?>>Like <i class="<?php echo $love_icon; ?>"></i></button>
                        </div> 

                        <?php
                            $likes = get_comment_meta(get_comment_ID(), 'oom_post_likes', true);
                            if($likes > 0 ){
                                echo '<div class="love_count"><span>'. $likes .'</span> likes</div>';
                            }
                        ?>

                        
                         
                    </div>
                </article><!-- .comment-body -->
            <?php
        }
        





	}
}