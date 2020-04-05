<?php
/*** customize login screen */
function topgun_custom_login_page() {
    $logo = get_field('site_logo', 'options');
    echo '<style type="text/css">
        h1 a { background-image:url('. $logo .') !important; height: 120px !important; width: 100% !important; margin: 0 auto !important; background-size: contain !important; }
		h1 a:focus { outline: 0 !important; box-shadow: none; }
        body.login { background-color: #ebe5df !important; z-index: 999;}
  		.login form {
  			background: #453131 !important;
  		}
		.login form .input, .login form input[type=checkbox], .login input[type=text] {
			background: transparent !important;
			color: #ddd;
		}
		.login label {
			color: #DDD !important;
		}
		.login #login_error, .login .message {
			color: #ddd;
			margin-top: 20px;
			background: rgba(255,255,255, 0.2) !important;
		}
    </style>';
}
add_action('login_head', 'topgun_custom_login_page');



add_filter( 'login_headertitle', 'onourmoon_login_logo_url_title' );
function onourmoon_login_logo_url_title() {
    return 'On Our Moon';
}

add_filter( 'login_headerurl', 'onourmoon_login_logo_url' );
function onourmoon_login_logo_url() {
   return get_bloginfo( 'url' );
}
