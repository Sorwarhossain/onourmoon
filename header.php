<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>
<?php

$page_id = get_queried_object_id();
$page_bg = get_field('page_background_color', $page_id);

if(!empty($page_bg)){
    $page_bg_styles = 'style="background-color: '. $page_bg .'"';
} else {
    $page_bg_styles = '';
}
?>

<body <?php body_class(); ?> <?php echo $page_bg_styles; ?> >

<?php
    
    if(!empty(get_field('header_background_color', 'options'))){
        $header_bg = 'style="background-color: '. get_field('header_background_color', 'options') .'"';
    }
    $site_logo = get_field('site_logo', 'options');
    if(!empty($site_logo)){
        $logo = '<img src="'. $site_logo .'" alt="Site Logo">';
    } else {
        $logo = '<h2>On Our Moon</h2>';
    }
    $enable_header_search = get_field('enable_header_search', 'options');

?>  

    <header id="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-3">
                    <div class="site-logo">
                        <a href="<?php echo get_site_url(); ?>"><?php echo $logo; ?></a>
                    </div>
                </div>
                <div class="col-6 d-md-none d-lg-none header-socials">
                    <?php echo do_shortcode('[oom_social_profiles]'); ?>    
                </div>
                <div class="col-lg-8 col-md-6 col-3 header-right-wrapper">
                    <div class="main-menu-wrapper">
                        <nav class="navbar navbar-expand-lg ">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>
 
                            <div class="navbar-nav nav_desktop">
                                <?php 
                                wp_nav_menu( array(
                                    'menu'               => 'Main Menu',
                                    'theme_location'     => 'main-menu',
                                    'depth'              => 2,
                                    'container'          => 'div',
                                    'menu_class'         => 'main-menu',
                                ));
                                ?>
                            </div>
                            
                        </nav>
                    </div>
                    <div class="search-form">
                        <button id="switch_search" class="search_icon"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
        <?php
            get_search_form();
        ?>
        
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php 
                    wp_nav_menu( array(
                        'menu'               => 'Main Menu',
                        'theme_location'     => 'main-menu',
                        'depth'              => 2,
                        'container'          => 'div',
                        'menu_class'         => 'main-menu',
                    ));
                ?>
            </div>
        </div>
    </header>
    
    
    
    
    