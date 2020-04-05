<?php 
get_header();
?>




    <section id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">



                    <!-- start of column post 1 -->
                    <?php
                    $args = array(
                        'post_type' => 'post',
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
                                        <?php the_post_thumbnail('medium'); ?>
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



                    <div class="more_articles">
                        <div id="more_articles_wrapper"></div>
                        <button class="btn site-btn">More Articles</button>
                    </div>


                    

                </div> 
                <!-- end of main content -->
                <div class="col-md-1">

                </div>

                <?php get_sidebar(); ?>
                
            </div>
        </div>
    </section>


<?php get_footer(); ?>