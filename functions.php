<?php
/**
 * onourmoon functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package onourmoon
 */

if ( ! function_exists( 'onourmoon_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function onourmoon_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on onourmoon, use a find and replace
		 * to change 'onourmoon' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'onourmoon', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'onourmoon' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		
		add_image_size( 'article_thum', 400, 400, true );

	}
endif;
add_action( 'after_setup_theme', 'onourmoon_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function onourmoon_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'onourmoon_content_width', 640 );
}
add_action( 'after_setup_theme', 'onourmoon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function onourmoon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'onourmoon' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'onourmoon' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'onourmoon' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Add footer sidebar widgets here.', 'onourmoon' ),
		'before_widget' => '<div id="%1$s" class="col widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Article Sidebar', 'onourmoon' ),
		'id'            => 'article-sidebar',
		'description'   => esc_html__( 'Add footer sidebar widgets here.', 'onourmoon' ),
		'before_widget' => '<div id="%1$s" class="col widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'onourmoon_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function onourmoon_scripts() {
	
	/*** Enqueue styles. */
	wp_enqueue_style('bootstrap-css','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), false, 'all');
	wp_enqueue_style('onourmoon-fonts', 'https://fonts.googleapis.com/css?family=Cormorant:300i,400,400i,500,500i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Oswald:300,400,500,600,700&display=swap', array(), false, 'all');

	wp_enqueue_style('fontawesome-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), false, 'all');
	wp_enqueue_style('slickslider-css', get_template_directory_uri() . '/assets/css/slick.css', array(), false, 'all');

	wp_enqueue_style( 'onourmoon-style', get_stylesheet_uri() );
	
	wp_enqueue_style('responsive-css', get_template_directory_uri() . '/assets/css/responsive.css', array(), false, 'all');

	//conditionally ie support
	wp_enqueue_script( 'html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', array(), '3.7.3', false );
	wp_enqueue_script( 'respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2', false );
	//adding html5 shiv and respond js for ie9 conditionally
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	
	wp_enqueue_script('jquery');

	wp_enqueue_script( 'onourmoon-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'), false, true);
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), false, true);
	wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	$data = array(
		'admin_ajax'   => admin_url( 'admin-ajax.php' ),
	);
	wp_localize_script('custom-js', 'onmoon_localise', $data);



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'onourmoon_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Add all the important files.
 */
require get_template_directory() . '/inc/tgm-plugin-activator.php';


/**
 * Recent comments widget
 */
require get_template_directory() . '/inc/widgets/customized-recent-comments.php';

/**
 * Recent comments widget
 */
require get_template_directory() . '/inc/widgets/onourmoon_related_posts_widget.php';

/**
 * Recent podcast widget
 */
require get_template_directory() . '/inc/widgets/onourmoon_recent_podcast.php';

/**
 * Recent podcast widget
 */
require get_template_directory() . '/inc/widgets/onourmoon_upcoming_events.php';





/**
 * Comment Walker
 */
require get_template_directory() . '/inc/class-onourmoon-comment-walker.php';


/*
* Customize the login screen
*/
require get_template_directory() . '/inc/onourmoon_custom_login_screen.php';


/*
* Customize the login screen
*/
require get_template_directory() . '/inc/onourmoon_ajax_calls.php';


/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}



/* ACF OPTIONS PAGE */
if(function_exists('acf_add_options_page')) {
    $option_page = acf_add_options_page(
        array(
            'page_title'  => 'Theme Options',
            'menu_title'  => 'Theme Options',
            'menu_slug'   => 'theme-options',
            'capability'  => 'edit_posts',
            'redirect'    => true,
            'position' => 80,
            'icon_url'    => 'dashicons-admin-generic'
        )
    );
}





add_action( 'init', 'topgun_post_type_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function topgun_post_type_init() {

	/*===================================================
	====== Register podcast post type ==================
	=====================================================*/
	$labels = array(
		'name'               => _x( 'Podcasts', 'post type general name', 'onourmoon' ),
		'singular_name'      => _x( 'Podcast', 'post type singular name', 'onourmoon' ),
		'menu_name'          => _x( 'Podcasts', 'admin menu', 'onourmoon' ),
		'name_admin_bar'     => _x( 'Podcast', 'add new on admin bar', 'onourmoon' ),
		'add_new'            => _x( 'Add New', 'podcast', 'onourmoon' ),
		'add_new_item'       => __( 'Add New Podcast', 'onourmoon' ),
		'new_item'           => __( 'New Podcast', 'onourmoon' ),
		'edit_item'          => __( 'Edit Podcast', 'onourmoon' ),
		'view_item'          => __( 'View Podcast', 'onourmoon' ),
		'all_items'          => __( 'All Podcasts', 'onourmoon' ),
		'search_items'       => __( 'Search Podcasts', 'onourmoon' ),
		'parent_item_colon'  => __( 'Parent Podcasts:', 'onourmoon' ),
		'not_found'          => __( 'No podcasts found.', 'onourmoon' ),
		'not_found_in_trash' => __( 'No podcasts found in Trash.', 'onourmoon' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Podcasts', 'onourmoon' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'podcasts' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'      	 => 'dashicons-video-alt2',
	);
	register_post_type( 'podcasts', $args );



	/*===================================================
	====== Register Events post type ==================
	=====================================================*/
	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'onourmoon' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'onourmoon' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'onourmoon' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'onourmoon' ),
		'add_new'            => _x( 'Add New', 'event', 'onourmoon' ),
		'add_new_item'       => __( 'Add New Event', 'onourmoon' ),
		'new_item'           => __( 'New Event', 'onourmoon' ),
		'edit_item'          => __( 'Edit Event', 'onourmoon' ),
		'view_item'          => __( 'View Event', 'onourmoon' ),
		'all_items'          => __( 'All Events', 'onourmoon' ),
		'search_items'       => __( 'Search Events', 'onourmoon' ),
		'parent_item_colon'  => __( 'Parent Events:', 'onourmoon' ),
		'not_found'          => __( 'No events found.', 'onourmoon' ),
		'not_found_in_trash' => __( 'No events found in Trash.', 'onourmoon' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Events', 'onourmoon' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'      	 => 'dashicons-calendar-alt',
	);
	register_post_type( 'event', $args );


}


// Register Custom Taxonomy
function onourmoon_posts_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Serieses', 'Taxonomy General Name', 'onourmoon' ),
		'singular_name'              => _x( 'Series', 'Taxonomy Singular Name', 'onourmoon' ),
		'menu_name'                  => __( 'Serieses', 'onourmoon' ),
		'all_items'                  => __( 'All Serieses', 'onourmoon' ),
		'parent_item'                => __( 'Parent Item', 'onourmoon' ),
		'parent_item_colon'          => __( 'Parent Item:', 'onourmoon' ),
		'new_item_name'              => __( 'New Series Name', 'onourmoon' ),
		'add_new_item'               => __( 'Add New Series', 'onourmoon' ),
		'edit_item'                  => __( 'Edit Series', 'onourmoon' ),
		'update_item'                => __( 'Update Series', 'onourmoon' ),
		'separate_items_with_commas' => __( 'Separate serieses with commas', 'onourmoon' ),
		'search_items'               => __( 'Search Items', 'onourmoon' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'onourmoon' ),
		'choose_from_most_used'      => __( 'Choose from the most used series', 'onourmoon' ),
		'not_found'                  => __( 'Series Not Found', 'onourmoon' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'series' ),
		);
	register_taxonomy( 'series', array( 'post' ), $args );
	
}
	
// Hook into the 'init' action
add_action( 'init', 'onourmoon_posts_taxonomy', 10 );



add_filter('get_terms_args','onourmoon_showemptytags');
function onourmoon_showemptytags($args) {
	$args['hide_empty'] = false;
	return $args;
}


add_filter( 'widget_text', 'do_shortcode' );






function prefix_move_comment_field_to_bottom( $fields ) {
 
	$comment_field = $fields['comment'];
	
	// removing fields
	unset( $fields['comment'] );

	unset($fields['cookies']);
	unset($fields['url']);

	$fields['comment'] = $comment_field;
	
	// customizing fields
	$fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="" size="30" maxlength="245" required="required" placeholder="name or anonymous"/></p>';
	$fields['email'] = '<p class="comment-form-email"><input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" required="required" placeholder="email (won\'t be shared publicly)" /></p>';

	$fields['comment'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required="required" placeholder="write here"></textarea></p>';


    return $fields;
 
}
add_filter( 'comment_form_fields', 'prefix_move_comment_field_to_bottom', 10, 1 );




add_filter('comment_reply_link_args', 'onourmoon_comment_reply_link_args', 10, 1);
function onourmoon_comment_reply_link_args($args){

	update_option('test', $args);

	return $args;
}



// Display site social profiles
function oom_social_profiles_function( $atts ) {
    
    $output = '';
    
	$profiles = get_field('add_social_profiles', 'options');
	if(!empty($profiles) && is_array($profiles)){
	    $output .= '<div class="site_social_profiles_wrapper"><ul class="site_social_profiles">';
	    
	    if(!empty($profiles['instagram'])){
	        $output .= '<li><a href="'. $profiles['instagram'] .'" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>';
	    }
	    
	    if(!empty($profiles['facebook'])){
	        $output .= '<li><a href="'. $profiles['facebook'] .'" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>';
	    }
	    
	    if(!empty($profiles['twitter'])){
	        $output .= '<li><a href="'. $profiles['twitter'] .'" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>';
	    }
	    
	    if(!empty($profiles['youtube'])){
	        $output .= '<li><a href="'. $profiles['youtube'] .'" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>';
	    }
	    
	    if(!empty($profiles['pinterest'])){
	        $output .= '<li><a href="'. $profiles['pinterest'] .'" title="Pinterest" target="_blank"><i class="fa fa-instagram"></i></a></li>';
	    }
	    
	    if(!empty($profiles['tiktok'])){
	        
	        $tiktok_logo = get_template_directory_uri(). '/assets/images/tiktok.svg' ;
	        
	        $output .= '<li><a href="'. $profiles['tiktok'] .'" title="Tiktok" target="_blank"><img src="' . $tiktok_logo . '"></a></li>';
	    }
	    
	    if(!empty($profiles['thumbr'])){
	        $output .= '<li><a href="'. $profiles['thumbr'] .'" title="Thumbr" target="_blank"><i class="fa fa-tumblr"></i></a></li>';
	    }
	    
	    $output .= '</div></ul>';
	}
	
	return $output;

}
add_shortcode( 'oom_social_profiles', 'oom_social_profiles_function' );



add_filter('widget_tag_cloud_args', 'customized_widget_tag_cloud_args_order');
function customized_widget_tag_cloud_args_order($args){
    
    
    
    
   // $args['meta_key'] = 'menu_order';
    $args['orderby'] = 'term_id';
    $args['order'] = 'ASC';
    
    return $args;
}






add_filter('acf/load_field/name=select_comment', 'acf_load_color_field_choices_custom');
function acf_load_color_field_choices_custom($field){
	$field['choices'] = array(
        'custom'    => 'My Custom Choice',
        'custom_2'  => 'My Custom Choice 2'
    );

    return $field;
}



$rand_comments = get_comments(array(
    'status'      => 'approve',
    'post_status' => 'publish',
    //'fields'      => 'ids',
));

//echo var_dump($rand_comments);