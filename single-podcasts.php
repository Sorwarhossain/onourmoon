<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package onourmoon
 */

get_header();

$post_id = get_queried_object_id();


?>

	<section id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- start of featured post -->
                    <?php
     
					if(have_posts()) :

                        while(have_posts()) :
                            the_post();
                    ?>
                            <div class="podcast-single-post">
                                
                                
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-10">
                                        <div class="podcast_thumb_wrapper">
                                            <?php the_post_thumbnail('full'); ?>
                                            <!---
                                            <div class="podcast_play">
                                                <div class="play_icon">
                                                    <a href="#"><i class="fa fa-caret-right"></i></a>
                                                </div>
                                            </div>
                                            --->
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 signle_podcast_sidebar">
                                        <div class="podcast_play">
                                            <div class="play_icon">
                                                <a href="#"><i class="fa fa-caret-right"></i></a>
                                            </div>
                                            
<?php
    $profiles = get_field('social_profiles', get_the_ID());
    echo get_podcast_social_icons($profiles);
?>
                                            
                                            <div class="subscribe-button">
                                                <?php if(!empty(get_field('itunes_link', get_the_ID()))) : ?>
                                                    <a href="<?php echo get_field('itunes_link', get_the_ID()); ?>" class="btn podcast-btn">Listen On Itunes</a>
                                                <?php endif; ?>

                                                <?php if(!empty(get_field('itunes_link', get_the_ID()))) : ?>
                                                    <a href="<?php echo get_field('spotify_link', get_the_ID()); ?>" class="btn podcast-btn">Listen On Spotify</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-8">
                                        <div class="post-content">
                                            <h2><?php the_title(); ?></h2>
                                            <p><?php the_content(); ?></p>
                                            <p class="date"><?php echo get_the_date(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; ?>


                        <div class="related_podcasts">
                        <?php
                            $args = array(
                                'post_type' => 'podcasts',
                                'orderby'   => 'rand',
                                'posts_per_page' => 5, 
                                'post_status' => 'publish',
                                'post__not_in' => array($post_id),
                            );
                            $loop = new WP_Query($args);
                            if($loop->have_posts()): ?>
                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col"><h2>YOU MIGHT ALSO LIKE</h2></div>
                                </div>
                                
                                <div class="row related_podcasts_wrapper">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10"><div class="row">
                                        
                            <?php
                                    while($loop->have_posts()): 
                                        $loop->the_post(); ?>

                                        <article class="col">
                                            <div class="post-thumbnail">
                                                <?php
                                                    the_post_thumbnail('article_thum');
                                                ?>
                                            </div>
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php
                                            $interview_with = get_field('interview_with', get_the_ID());
                                            ?>
                                            <!---
                                            <h4><span>An interview with</span> - <strong><?php //echo $interview_with; ?></strong></4>
                                            --->
                                        </article>


                                    
                                    <?php endwhile; ?>
                                    </div></div>
                                    <div class="col-lg-1"></div>
                                </div>

                            <?php endif; ?>
                        </div>

					<?php else : ?>
						<h1>Nothing found here</h1>
                    <?php endif; ?>
                    <!-- end of featured post -->
                </div> 

            </div>
        </div>
    </section>
	

<?php
get_footer();
