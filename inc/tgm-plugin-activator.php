<?php
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';



add_action( 'tgmpa_register', 'topgun_painball_require_plugins' );
function topgun_painball_require_plugins() {
 
    $plugins = array( 
    	array(
			'name'         	=> 'Advanced Custom Fields Pro', 
			'slug'         	=> 'advanced-custom-fields-pro', 
			'source'       	=> get_stylesheet_directory() . '/inc/plugins/advanced-custom-fields-pro.zip',
			'required'           => true,
		),
    );
    $config = array( /* The array to configure TGM Plugin Activation */ );
 
    tgmpa( $plugins, $config );
 
}