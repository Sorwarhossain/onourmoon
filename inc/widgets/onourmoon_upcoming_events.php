<?php
/**
 * Widget API: OnourMoon Upcoming Events
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

function onourmoon_load_upcoming_events_widget() {
    register_widget( 'OnourMoon_Upcoming_Events' );
}
add_action( 'widgets_init', 'onourmoon_load_upcoming_events_widget' );




class OnourMoon_Upcoming_Events extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'onourmoon_upcoming_events',
			'description'                 => 'Display your upcoming events.',
		);
		parent::__construct( 'onourmoon_upcoming_events', __( 'OnOurMoon Upcoming Events' ), $widget_ops );


	}


	public function widget( $args, $instance ) {

		static $first_instance = true;

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
        }
        


		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Upcoming Events' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 25;
		if ( ! $number ) {
			$number = 2;
        }


        echo $args['before_widget'];
        
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

    
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => -1,
            'post_status' => 'publish'
        );
        $loop = new WP_Query($args);
        
        if($loop->have_posts()){

            $counter = 1;
    
            echo '<div class="onourmoon_upcoming_events">';
                while($loop->have_posts()){

                    $loop->the_post();

                    $event_date = get_field('event_date', get_the_ID());

                    if(strtotime($event_date) < strtotime('today')){
                        continue;
                    }

                    if($counter > $number) {
                        continue;
                    }

                    $event_date = date("F d" , strtotime($event_date) );

                    $location = get_field('location', get_the_ID());
                    $event_link = get_field('event_link', get_the_ID());

                    
                    
                    echo '<article class="upcoming_event">';
                        echo '<h4><a href="'. $event_link .'">'. $location . ' - ' . get_the_title() . ' - ' . $event_date .'</a></h4>';
                    echo '</article>';

                    $counter++;

                } 
                wp_reset_postdata();
           
            echo '</div>';

        }
        
        echo '</div>';
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