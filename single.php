<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package onourmoon
 */

get_header();
?>

	<section id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <!-- start of featured post -->
                    <?php
     
					if(have_posts()) :

                        while(have_posts()) :
                            the_post();
                    ?>
                            <div class="featured_post">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="featured_post_thumbnail">
<?php
$img_attr = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                           
if(isset($img_attr[0])){
    $img_url = $img_attr[0];
} else {
    $img_url = '';
}
?>
<div class="featured_thumb_inner"><?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?></div>
         

                                            
                                            
                                        </div>
                                        
<?php 

$photography_by = get_field('photography_by', get_post_thumbnail_id());
if(!empty($photography_by)){
    echo '<div class="photography_by"><p>photography: '. $photography_by .'</p></div>';
}

?>                                        
                                        
                                    </div>
                                    <div class="col-md-7">
                                        <div class="post-content">
                                            <h2><?php the_title(); ?></h2>
                                            <h4><?php echo get_the_author_posts_link(); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="single-post-content">
								<?php the_content(); ?>
							</div>



                            <?php
                            if ( is_single() && comments_open() && ! post_password_required() ) {
                                ?>
                        
                                <div class="comments-wrapper section-inner">
                        
                                    <?php comments_template(); ?>
                        
                                </div><!-- .comments-wrapper -->
                        
                                <?php
                            }
                            ?>


                        <?php endwhile; ?>
					<?php else : ?>
						<h1>Nothing found here</h1>
                    <?php endif; ?>
                    <!-- end of featured post -->
            

                </div> 
                <!-- end of main content -->
                <div class="col-md-1 d-none d-md-block d-lg-block d-xl-block">
                    <?php echo do_shortcode('[oom_social_profiles]'); ?>
                </div>


                <?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
                    <div class="col-md-3">
                        <div class="right-sidebar">
                            <?php dynamic_sidebar( 'article-sidebar' ); ?>
                        </div>
                    </div>
                <?php endif; ?> 
            </div>
        </div>
    </section>
	

<?php
get_footer();
