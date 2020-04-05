<?php 
get_header();
$page_id = get_queried_object_id();


?>

    <section id="main-content">
        <div class="container">
            <div class="row archive_posts_row">
                <div class="col-md-8">

					
					<div class="archive_post_heading">
						<div class="archive_name">
							<h2 class="page-title">Search Results For: <?php the_search_query(); ?></h2>
						</div>
					</div>


                    <?php

                    if(have_posts()):
                    ?>

					
                    <div class="archive_posts_wrapper">
                        <div class="row">
                        <?php while(have_posts() ) : the_post(); ?>
                            <div class="col-md-12">
                                <article class="blog-post">
                                    <div class="post-content">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile;; ?>
                        </div>
                    </div>
					<?php else : ?>
						<div class="no-search-result">
							<section class="error-404 not-found text-center">
								<header class="page-header">
									<h1 class="hero">No Result</h1>
									<h3 class="page-title"><?php esc_html_e( 'Oops! We unable to find anything with this keyword.', 'onourmoon' ); ?></h3>
								</header><!-- .page-header -->

								<div class="page-content">

									<a class="btn site-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Back To Homepage', 'onourmoon'); ?></a>

								</div><!-- .page-content -->
							</section><!-- .error-404 -->
						</div>

                    <?php endif; ?>
                    <!-- End of column post 2 -->

					<!---
                    <div class="more_articles">
                        <div id="more_articles_wrapper"></div>
                        <button class="btn site-btn">More Articles</button>
					</div>
					--->
   

                </div> 
                <!-- end of main content -->
                <div class="col-md-1">

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