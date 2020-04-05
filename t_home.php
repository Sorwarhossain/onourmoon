<?php 
/*
Template Name: Homepage
*/
get_header();
$page_id = get_queried_object_id();

?>




    <section id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <!-- start of featured post -->
                    <?php
                    $select_featured_post = get_field('select_featured_post', $page_id);
                
                    
                    if(!empty($select_featured_post)) :
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 1,
                            'p' => $select_featured_post,
                        );
                        $loop = new WP_Query($args);
                        while($loop->have_posts()) :
                            $loop->the_post();
                            
                            $img_attr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                           
                            if(isset($img_attr[0])){
                                $img_url = $img_attr[0];
                            } else {
                                $img_url = '';
                            }
                    ?>
                            <div class="featured_post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="featured_post_thumbnail">
                                            <div class="featured_thumb_inner" style="background-image: url(<?php echo $img_url; ?>)"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="post-content">
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <h4><?php echo get_the_author_posts_link(); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                    <!-- end of featured post -->


                    <!-- start of column post 1 -->
                    <?php
// $args = array(
//     'post_type' => 'post',
//     'posts_per_page' => 3,
// );
// $select_posts_column_1 = get_field('select_posts_column_1', $page_id);


// if(!empty($select_posts_column_1['select_type_or_series'])){
    
//     if($select_posts_column_1['select_type_or_series'] == 'tags' && $select_posts_column_1['select_a_tag']){
        
//         $args['tag_id'] = $select_posts_column_1['select_a_tag'];
        
//     }
    
//     if($select_posts_column_1['select_type_or_series'] == 'series' && $select_posts_column_1['select_a_series']){
        
//          $args['tax_query'] = array(
//             array (
//                 'taxonomy' => 'series',
//                 'field' => 'term_id',
//                 'terms' => $select_posts_column_1['select_a_series'],
//             ),
//         );
        
//     }
// }


$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish'
);



                    $loop = new WP_Query($args);
                    if($loop->have_posts()):
                    ?>
                    <div class="featured-post-col-1 most-commented">
                        <div class="row">
                        <?php while($loop->have_posts() ) : $loop->the_post(); ?>
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
                        <?php endwhile;; ?>
                        <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- End of column post 1 -->



                    


                    <!-- start posts white box -->
                    <?php
                    $posts_white_box = get_field('posts_white_box', $page_id);
                    if(!empty($posts_white_box)) :
                    ?>
                        <div class="post-white-box">
                            <div class="box-extended-bordered"></div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="white-box-title">
                                        
<?php 

if(!empty($posts_white_box['title_image'])){
    $title_image = '<img src="'. $posts_white_box['title_image'] .'">';
} else {
    $title_image = '<span>Featured Topic: </span>';
}

if($posts_white_box['select_the_topic_type'] == 'Tags'){
    $topic_selected = $posts_white_box['select_tag'];
    $term = get_term( $topic_selected, 'post_tag' );
    
    echo '<h3>' . $title_image . '<a href="'. get_term_link($term->slug, 'post_tag') .'">' . $term->name . '</a></h3>';
}

if($posts_white_box['select_the_topic_type'] == 'Series'){
    
    $topic_selected = $posts_white_box['select_series'];
    $term = get_term( $topic_selected, 'series' );
    echo '<h3>' . $title_image . '<a href="'. get_term_link($term->slug, 'series') .'">' . $term->name . '</a></h3>';
}




?>

                                    </div>
                                    <?php if(isset($posts_white_box['attach_posts_to_list'])): ?>
                                    <?php
                                        echo '<ul class="box-posts-list">';
                                        foreach($posts_white_box['attach_posts_to_list'] as $box_item){
                                            echo '<li><i class="fa fa-arrow-right"></i> <a href="'. get_the_permalink($box_item['select_post']) .'">'. get_the_title($box_item['select_post']) .'</a></li>';
                                        }   
                                        echo '</ul>'; 
                                    ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="side-image">
                                        <?php echo isset($posts_white_box['sidebar_image']) ? '<img src="'. $posts_white_box['sidebar_image'] .'" alt="">' : ''; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- end posts white box -->




                    <!-- start of column post 2 -->
                    <?php

                    
                    
                    

// $args = array(
//     'post_type' => 'post',
//     'posts_per_page' => 3,
// );

// $select_posts_column_2 = get_field('select_posts_column_2', $page_id);


// if(!empty($select_posts_column_2['select_type_or_series'])){
    
//     if($select_posts_column_2['select_type_or_series'] == 'tags' && $select_posts_column_2['select_a_tag']){
        
//         $args['tag_id'] = $select_posts_column_2['select_a_tag'];
        
//     }
    
//     if($select_posts_column_2['select_type_or_series'] == 'series' && $select_posts_column_2['select_a_series']){
        
//          $args['tax_query'] = array(
//             array (
//                 'taxonomy' => 'series',
//                 'field' => 'term_id',
//                 'terms' => $select_posts_column_2['select_a_series'],
//             ),
//         );
        
//     }
// }



                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                        'offset' => 3,
                    );

                    $loop = new WP_Query($args);
                    if($loop->have_posts()):
                    ?>
                    <div class="featured-post-col-1 most-shared">
                        <div class="row">
                        <?php while($loop->have_posts() ) : $loop->the_post(); ?>
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
                        <?php endwhile;; ?>
                        <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- End of column post 2 -->



                    <!-- start posts white box 2 -->
                    <?php
                    $posts_white_box = get_field('posts_white_box_2', $page_id);
                    if(!empty($posts_white_box)) :
                    ?>
                        <div class="post-white-box box-2">
                            <div class="box-extended-bordered"></div>
                            <div class="white-box-title box-2">
                                
                                
 <?php 
 
    if(!empty($posts_white_box['title'])){
        $title = $posts_white_box['title'];
    } else {
        $title = 'MVP: ';
    }
    
    if(!empty($posts_white_box['title_image'])){
        $title_img = '<img src="'. $posts_white_box['title_image'] .'">';
    } else {
        $title_img = 'Most Vulnerable Pieces';
    }
    
    echo '<h3>' . $title . ' ' . $title_img .'</h3>';
 
 
 ?>
                                
                                
                            </div>
                            
                            <?php if(isset($posts_white_box['attach_posts_to_list'])): ?>
                            <?php
                                echo '<ul class="box-posts-list">';
                                foreach($posts_white_box['attach_posts_to_list'] as $box_item){
                                    echo '<li class="box-posts-list-item"><i class="fa fa-arrow-right"></i> <a href="'. get_the_permalink($box_item['select_post']) .'">'. get_the_title($box_item['select_post']) .'</a></li>';
                                }   
                                echo '</ul>'; 
                            ?>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                    <!-- end posts white box 2 -->


                    <div class="more_articles">
                        <div id="more_articles_wrapper"></div>
                        <button class="btn site-btn load_more" id="load_more_articles">More Articles</button>
                    </div>


                    

                </div> 
                <!-- end of main content -->
                <div class="col-md-1 d-none d-md-block d-lg-block d-xl-block">
                    <?php echo do_shortcode('[oom_social_profiles]'); ?>
                </div>

                <?php get_sidebar(); ?>
                
            </div>
        </div>
    </section>


<?php get_footer(); ?>