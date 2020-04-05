<?php 
/*
Template Name: Podcast
*/
get_header();
$page_id = get_queried_object_id();

?>


<?php
if(get_field('podcast_enable_page_banner', $page_id)) :
    $podcast_title = get_field('podcast_title', $page_id);
    $podcast_buttons = get_field('podcast_buttons', $page_id);
    $podcast_image = get_field('podcast_image', $page_id);
    $podcast_logo = get_field('podcast_logo', $page_id);
?>
    <section id="podcast-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mr-auto pr-5">
                    <div class="podcast-banner-thumb">
                        <?php echo !empty($podcast_image) ? '<img src="'. $podcast_image .'" alt="">': ''; ?>
                        <div class="podcast-banner-logo">
                            <?php echo !empty($podcast_logo) ? '<img src="'. $podcast_logo .'" alt="">': ''; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="post-content podcast-banner">
                        <?php echo !empty($podcast_title) ? '<h2>'. $podcast_title .'</h2>' : ''; ?>

                        <?php if(!empty($podcast_buttons)): ?>
                            <div class="podcast-buttons">
                                <div class="subscribe-button">
                                    <?php if(!empty($podcast_buttons['subscribe'])) : ?>
                                        <a href="<?php echo $podcast_buttons['subscribe']['link']; ?>" class="btn podcast-btn"><?php echo $podcast_buttons['subscribe']['label']; ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="listen-buttons">
                                    <?php if(!empty($podcast_buttons['listen_on_itunes'])) : ?>
                                        <a href="<?php echo $podcast_buttons['listen_on_itunes']['link']; ?>" class="btn podcast-btn"><?php echo $podcast_buttons['listen_on_itunes']['label']; ?></a>
                                    <?php endif; ?>

                                    <?php if(!empty($podcast_buttons['listen_on_spotify'])) : ?>
                                        <a href="<?php echo $podcast_buttons['listen_on_spotify']['link']; ?>" class="btn podcast-btn"><?php echo $podcast_buttons['listen_on_spotify']['label']; ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
if(get_field('enable_podcasts', $page_id)) :
?>
    <section id="podcasts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php
                    $args = array(
                        'post_type' => 'podcasts',
                        'posts_per_page' => 3,
                    );

                    $loop = new WP_Query($args);
                    if($loop->have_posts()):
                    ?>
                    <div id="podcasts_wrapper">

                        <?php while($loop->have_posts() ) : $loop->the_post();
                        
                        
                  
                        
                        ?>
                            <article class="row podcast_item">
                                <div class="col-md-4 col-sm-4">
                                    <div class="podcast_play">
                                        <div class="play_icon">
                                            <a href="<?php the_permalink(); ?>"><i class="fa fa-caret-right"></i></a>
                                        </div>
                                        
                                        
<?php
    $profiles = get_field('social_profiles', get_the_ID());
    echo get_podcast_social_icons($profiles);
?>
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-8">
                                    <div class="post-content">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <p><?php the_content(); ?></p>
                                        <p class="date"><?php echo get_the_date(); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </article>
                        <?php endwhile;; ?>
                        <?php wp_reset_postdata(); ?>
            
                        
                    </div>
                    

                    <?php
                    if(get_field('enable_podcasts', $page_id)) :
                    ?>
                        <div class="more_podcasts">
                            <button id="load-more-podcast" class="btn site-btn load_more">More Podcasts</button>
                        </div>
                    <?php endif; ?>

                    <?php endif; ?>
                    <!-- End of column post 1 -->

                    
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>