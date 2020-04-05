<?php
/**
 * Widget API: OnourMoon Related Posts Widget
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Related posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */

function onourmoon_load_related_posts_widget() {
    register_widget( 'OnourMoon_Related_Posts' );
}
add_action( 'widgets_init', 'onourmoon_load_related_posts_widget' );




class OnourMoon_Related_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'onourmoon_related_posts',
			'description'                 => 'Display your related posts.',
		);
		parent::__construct( 'onourmoon_related_posts', __( 'OnOurMoon Related Posts' ), $widget_ops );


	}


	public function widget( $args, $instance ) {

		static $first_instance = true;

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
        }

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Related Posts' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
        }


        echo $args['before_widget'];
        
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

    
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $number,
            'post_status' => 'publish'
        );
        $loop = new WP_Query($args);
        
        if($loop->have_posts()){
    
            echo '<div class="onourmoon_related_posts">';
                while($loop->have_posts()){

                    $loop->the_post();

                    
                    echo '<article class="blog-post">';
                        echo '<div class="post-thum">';
                            the_post_thumbnail('article_thum');
                        echo '</div>';
                        echo '<div class="post-content">';
                            echo '<h2><a href="'. get_the_permalink() .'">'. get_the_title() .'</a></h2>';
                            echo '<h4>'. get_the_author_posts_link() .'</h4>';
                        echo '</div>';
                    echo '</article>';
                } 
                wp_reset_postdata();
            echo '</div>';
            echo '</div>';

        }
        

		echo $args['after_widget'];
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