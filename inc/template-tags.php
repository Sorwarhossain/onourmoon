<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package onourmoon
 */





function get_podcast_social_icons($profiles){

    $profiles = get_field('social_profiles', get_the_ID());
    
    $output = '';

    if(!empty($profiles) && is_array($profiles)){
	    $output .= '<div class="podcast_social_profiles_wrapper"><ul class="site_social_profiles">';
	    
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
