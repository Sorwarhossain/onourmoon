<?php
/**
 * Widget API: OnourMoon_Widget_Recent_Comments class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Recent Comments widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */

function onourmoon_loar_recent_comments_widget() {
    register_widget( 'OnourMoon_Recent_Comments' );
}
add_action( 'widgets_init', 'onourmoon_loar_recent_comments_widget' );




class OnourMoon_Recent_Comments extends WP_Widget {

	/**
	 * Sets up a new Recent Comments widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'custom_widget_recent_comments',
			'description'                 => 'Display your recent comments.',
		);
		parent::__construct( 'custom_widget_recent_comments', __( 'OnOurMoon Comments' ), $widget_ops );


	}

	/**
	 * Outputs the content for the current Recent Comments widget instance.
	 *
	 * @since 2.8.0
	 * @since 5.4.0 Creates a unique HTML ID for the `<ul>` element
	 *              if more than one instance is displayed on the page.
	 *
	 * @staticvar bool $first_instance
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Comments widget instance.
	 */
	public function widget( $args, $instance ) {

		static $first_instance = true;

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
        }
        
        $rand_comments = get_comments(array(
            'status'      => 'approve',
            'post_status' => 'publish',
            'fields'      => 'ids',
        ));

        $com_items = array_rand(array_flip($rand_comments), $number);

		$comments = get_comments(
			/**
			 * Filters the arguments for the Recent Comments widget.
			 *
			 * @since 3.4.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see WP_Comment_Query::query() for information on accepted arguments.
			 *
			 * @param array $comment_args An array of arguments used to retrieve the recent comments.
			 * @param array $instance     Array of settings for the current widget.
			 */
			apply_filters(
				'onourmoon_widget_comments_args',
				array(
					'number'      => $number,
					'status'      => 'approve',
                    'post_status' => 'publish',
                    'comment__in' => $com_items,
				),
				$instance
			)
		);

		$output .= $args['before_widget'];
		if ( $title ) {
			$output .= $args['before_title'] . $title . $args['after_title'];
		}

		$recent_comments_id = ( $first_instance ) ? 'recentcomments' : "recentcomments-{$this->number}";
		$first_instance     = false;

		$output .= '<ul id="' . esc_attr( $recent_comments_id ) . '">';
		if ( is_array( $comments ) && $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );
            
			foreach ( (array) $comments as $comment ) {

				$output .= '<li class="recentcomments">';
				$output .= sprintf(
					/* translators: Comments widget. 1: Comment author, 2: Post link. */
                    _x( '%1$s %2$s %3$s', 'widgets' ),
                    '<a href="' . esc_url( get_comment_link( $comment ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>',
                    '<p>'. $comment->comment_content .'</p>',
                    '<span class="comment-author-link">- ' . get_comment_author( $comment ) . '</span>'
				);
				$output .= '</li>';
			}
		}
		$output .= '</ul>';
		$output .= $args['after_widget'];

		echo $output;
	}
	/**
	 * Handles updating settings for the current Recent Comments widget instance.
	 *
	 * @since 2.8.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Comments widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}

}