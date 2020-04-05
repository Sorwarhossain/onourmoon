<?php

/*** Load more atricles on homepage */
add_action('wp_ajax_nopriv_loadmore_post_home', 'onourmoon_loadmore_post_func');
add_action('wp_ajax_loadmore_post_home', 'onourmoon_loadmore_post_func');

function onourmoon_loadmore_post_func(){
    // prepare our arguments for the query

    $paged = $_POST['paged'];

    $args = [
        'posts_per_page' => 6,
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $paged,
    ];


    $loop = new WP_Query($args); 
 
    if( $loop->have_posts() ) :
        echo '<div class="featured-post-col-1 most-commented"><div class="row">';
        // run the loop
        while( $loop->have_posts() ): $loop->the_post(); 
            ?>

            <div class="col-md-4">
                <article class="blog-post">
                    <div class="post-thum">
                        <?php the_post_thumbnail('article_thum'); ?>
                    </div>
                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2>
                        <h4><?php echo get_the_author_posts_link(); ?></h4>
                        <span><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?>.</span>
                    </div>
                </article>
            </div>
        <?php
        endwhile;

        echo '</div></div>';

    else : ?>
        <div class="notResult col-xs-12">
            <h4 class="no-content text-center" style="padding: 0 0 50px; margin-top: 30px;">
                <?php _e('No more posts!', 'onourmoon'); ?>
            </h4>
        </div> 

    <?php
    endif;
        

    die; // here we exit the script and even no wp_reset_query() required!
}





/*** ----------------------------
 * Load more podcast on podcast page 
 * ** -------------------------- */
add_action('wp_ajax_nopriv_loadmore_podcast', 'onourmoon_loadmore_podcast_func');
add_action('wp_ajax_loadmore_podcast', 'onourmoon_loadmore_podcast_func');

function onourmoon_loadmore_podcast_func(){
    // prepare our arguments for the query

    $paged = $_POST['paged'];

    $args = [
        'posts_per_page' => 3,
        'post_type' => 'podcasts',
        'post_status' => 'publish',
        'paged' => $paged,
    ];


    $loop = new WP_Query($args); 
 
    if( $loop->have_posts() ) :
        // run the loop
        while( $loop->have_posts() ): $loop->the_post(); 
            ?>
            <article class="row podcast_item">
                <div class="col-md-4">
                    <div class="podcast_play">
                        <div class="play_icon">
                            <a href="<?php the_permalink(); ?>"><i class="fa fa-caret-right"></i></a>
                        </div>
                        
<?php

    $profiles = get_field('social_profiles', get_the_ID());
    
    $output = '';

    if(!empty($profiles) && is_array($profiles)){
	    $output .= '<div class="podcast_social_profiles_wrapper"><ul class="site_social_profiles">';
	    
	    if(!empty($profiles['instagram'])){
	        $output .= '<li><a href="'. $profiles['instagram'] .'" title="Instagram"><i class="fa fa-instagram"></i></a></li>';
	    }
	    
	    if(!empty($profiles['facebook'])){
	        $output .= '<li><a href="'. $profiles['facebook'] .'" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
	    }
	    
	    if(!empty($profiles['twitter'])){
	        $output .= '<li><a href="'. $profiles['twitter'] .'" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
	    }
	    
	    if(!empty($profiles['youtube'])){
	        $output .= '<li><a href="'. $profiles['youtube'] .'" title="Youtube"><i class="fa fa-youtube"></i></a></li>';
	    }
	    
	    if(!empty($profiles['pinterest'])){
	        $output .= '<li><a href="'. $profiles['pinterest'] .'" title="Pinterest"><i class="fa fa-instagram"></i></a></li>';
	    }
	    
	    if(!empty($profiles['tiktok'])){
	        
	        $tiktok_logo = get_template_directory_uri(). '/assets/images/tiktok.svg' ;
	        
	        $output .= '<li><a href="'. $profiles['tiktok'] .'" title="Tiktok"><img src="' . $tiktok_logo . '"></a></li>';
	    }
	    
	    if(!empty($profiles['thumbr'])){
	        $output .= '<li><a href="'. $profiles['thumbr'] .'" title="Thumbr"><i class="fa fa-tumblr"></i></a></li>';
	    }
	    
	    $output .= '</div></ul>';
	}
	
	echo $output;

?>




                        
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_content(); ?></p>
                        <p class="date"><?php echo get_the_date(); ?></p>
                    </div>
                </div>
            </article>
        <?php
        endwhile;

    else : ?>
        <div class="notResult col-xs-12">
            <h4 class="no-content text-center" style="padding: 0 0 80px; margin-top: 80px;">
                <?php _e('No more podcast!', 'onourmoon'); ?>
            </h4>
        </div> 

    <?php
    endif;
        

    die; // here we exit the script and even no wp_reset_query() required!
}








/*** ----------------------------
 * Load more posts on author page
 * ** -------------------------- */
add_action('wp_ajax_nopriv_loadmore_author_posts', 'onourmoon_loadmore_author_posts_func');
add_action('wp_ajax_loadmore_author_posts', 'onourmoon_loadmore_author_posts_func');

function onourmoon_loadmore_author_posts_func(){
    // prepare our arguments for the query

    if(empty($_POST['data_id'])){
        ?>
            <div class="notResult col-xs-12">
                <h4 class="no-content text-center" style="padding: 0 0 80px; margin-top: 80px;">
                    <?php _e('No more posts!', 'onourmoon'); ?>
                </h4>
            </div>
        <?php
        die();
    } else {
        $data_id = $_POST['data_id'];
    }

    $paged = $_POST['paged'];

    $args = array(
        'posts_per_page' => 6,
        'post_type' => 'post',
        'post_status' => 'publish',
        'author' => $data_id,
        'paged' => $paged,
    );


    $loop = new WP_Query($args); 
 
    if( $loop->have_posts() ) :
        // run the loop
        while( $loop->have_posts() ): $loop->the_post(); 
            ?>
            <div class="col-md-4">
                <article class="blog-post">
                    <div class="post-thum">
                        <?php the_post_thumbnail('article_thum'); ?>
                    </div>
                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <h4><?php echo get_the_author_posts_link(); ?></h4>
                        <span><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?>.</span>
                    </div>
                </article>
            </div>
        <?php
        endwhile;

    else : ?>
        <div class="notResult">
            <h4 class="no-content text-center" style="padding: 0 0 10px; margin-top: 30px;"><?php _e('No more posts!', 'onourmoon'); ?></h4>
        </div> 
    <?php
    endif;
        

    die; // here we exit the script and even no wp_reset_query() required!
}






/*** ----------------------------
 * Load more posts on archive page
 * ** -------------------------- */
add_action('wp_ajax_nopriv_loadmore_archive_posts', 'onourmoon_loadmore_archive_posts_func');
add_action('wp_ajax_loadmore_archive_posts', 'onourmoon_loadmore_archive_posts_func');

function onourmoon_loadmore_archive_posts_func(){
    // prepare our arguments for the query

    if(empty($_POST['data_id'])){
        ?>
            <div class="notResult col-xs-12">
                <h4 class="no-content text-center" style="padding: 0 0 80px; margin-top: 80px;">
                    <?php _e('No more posts!', 'onourmoon'); ?>
                </h4>
            </div>
        <?php
        die();
    } else {
        $data_id = $_POST['data_id'];
    }

    $term = get_term( $data_id );



    $paged = $_POST['paged'];

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'post_status' => 'publish',
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => $term->taxonomy,
                'field'    => 'term_id',
                'terms'    => $data_id,
            ),
        ),
    );



    $loop = new WP_Query($args); 
 
    if( $loop->have_posts() ) :
        // run the loop
        while( $loop->have_posts() ): $loop->the_post(); 
            ?>
            <div class="col-md-4">
                <article class="blog-post">
                    <div class="post-thum">
                        <?php the_post_thumbnail('article_thum'); ?>
                    </div>
                    <div class="post-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <h4><?php echo get_the_author_posts_link(); ?></h4>
                        <span><?php comments_number( 'No Comment', '1 Comment', '% Comments' ); ?>.</span>
                    </div>
                </article>
            </div>
        <?php
        endwhile;

    else : ?>
        <div class="notResult" style="width: 100%; ">
            <h4 class="no-content text-center" style="padding: 0 0 10px; margin-top: 30px;"><?php _e('No more posts!', 'onourmoon'); ?></h4>
        </div> 
    <?php
    endif;
        

    die; // here we exit the script and even no wp_reset_query() required!
}










/*** ----------------------------
 * Love this post by using ajax
 * ** -------------------------- */
add_action('wp_ajax_nopriv_love_this_post', 'onourmoon_love_this_post_func');
add_action('wp_ajax_love_this_post', 'onourmoon_love_this_post_func');

function onourmoon_love_this_post_func(){

    // prepare our arguments for the query
    $comment_id = $_POST['data_id'];

    $current_likes = get_comment_meta($comment_id, 'oom_post_likes', true);
    if(!empty($current_likes)){
        $like = $current_likes + 1;
    } else {
        $like = 1;
    }

    if(!empty($comment_id)) {


        if(isset($_COOKIE['comment_loved_'.$comment_id])){
            if($_COOKIE['comment_loved_'. $comment_id] == 'loved') {
                echo json_encode(array('msg' => 'failed'));
                die;
            }  
        }


        if(update_comment_meta($comment_id, 'oom_post_likes', $like)){
            echo json_encode(array('msg' => 'success', 'new_likes' => $like));

            setcookie("comment_loved_".$comment_id, "loved", time() + (86400 * 30 * 365), "/");


        } else {
            echo json_encode(array('msg' => 'failed'));
        }
    }

   // echo json_encode(array('working'));
        

    die; // here we exit the script and even no wp_reset_query() required!

}