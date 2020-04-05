<?php 
get_header();
$page_id = get_queried_object_id();

$term = get_term( $page_id );



?>

    <section id="main-content">
        <div class="container">
            <div class="row archive_posts_row">
                <div class="col-md-8">

					<div class="archive_post_heading">
						<div class="archive_name">
							<h2 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/featured-topic.png"> <?php echo single_cat_title( '', false ); ?></h2>
							<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
						</div>
					</div>

                    <!-- start of column post 2 -->
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => $term->taxonomy,
                                'field'    => 'term_id',
                                'terms'    => $page_id,
                            ),
                        ),
                    );


                    $loop = new WP_Query($args);
                    if($loop->have_posts()):
                    ?>
                    <div class="archive_posts_wrapper">
                        <div class="row" id="archive_posts_row">
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

                    <div class="load_more_posts">
                        <button id="archive_more_posts" class="btn site-btn load_more" data-id="<?php echo $page_id; ?>">More Articles</button>
                    </div>
                    <?php endif; ?>

                </div> 
                <!-- end of main content -->
                <div class="col-md-1 d-none d-md-block d-lg-block d-xl-block">
                    <?php echo do_shortcode('[oom_social_profiles]'); ?>
                </div>


                <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
                    <div class="col-md-3">
                        <div class="right-sidebar">
                            <?php dynamic_sidebar( 'right-sidebar' ); ?>
                        </div>
                    </div>
                <?php endif; ?> 
            </div>
        </div>
    </section>


<?php get_footer(); ?>