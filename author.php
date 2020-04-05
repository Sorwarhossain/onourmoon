<?php 
get_header();
$author_id = get_queried_object_id();

?>

    <section id="main-content">
        <div class="container">
            <div class="row archive_posts_row">
                <div class="col-md-8">

					<div class="archive_post_heading">
						<div class="archive_name">
                            <h2 class="page-title"><?php echo get_the_author_link(); ?></h2>
                            <?php
                            $social_profiles = get_field('users_social_profiles', 'user_' . $author_id);
                            if(!empty($social_profiles)) :
                            ?>
                                <div class="author_social_profiles">
                                    <ul>
                                        <?php 
                                            if(!empty($social_profiles['facebook_link'])){
                                                echo '<li><a href="'. $social_profiles['facebook_link'] .'"><i class="fa fa-facebook"></i></a></li>';
                                            }
                                            if(!empty($social_profiles['instagram_link'])){
                                                echo '<li><a href="'. $social_profiles['instagram_link'] .'"><i class="fa fa-instagram"></i></a></li>';
                                            }
                                            if(!empty($social_profiles['twitter_link'])){
                                                echo '<li><a href="'. $social_profiles['twitter_link'] .'"><i class="fa fa-twitter"></i></a></li>';
                                            }
                                            if(!empty($social_profiles['youtube_link'])){
                                                echo '<li><a href="'. $social_profiles['youtube_link'] .'"><i class="fa fa-youtube"></i></a></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
						</div>
					</div>


                    <!-- sidebar for mobile device -->
                    <div class="author-sidebar mobile_author_sidebar d-md-none">
                        <div class="profile_pictur_wrapper">
                            <div class="profile_picture">
                                <?php

                                $pp_attachment_id = (int)get_user_meta( (int)$author_id, 'mm_sua_attachment_id', true );
                                
                                if($pp_attachment_id){
                                    $img_attr = wp_get_attachment_image_src( $pp_attachment_id, 'full' );

                                    echo '<img src="'. $img_attr[0] .'" alt="Profile Picture">';
                                }
                                
                                ?>
                            </div>
                            <div class="author_quote">
                            <?php 
                            $author_quotes = get_field('user_habits', 'user_' . $author_id);
                            if(!empty($author_quotes)){
                                echo '<ul>';
                                    foreach($author_quotes as $quote){
                                        echo '<li>'. $quote['user_bio'] .'</li>';
                                    }
                                echo '</ul>';
                            }
                            ?>
                                
                                    
                                
                            </div>
                        </div> 
                        <!-- end of profile_pictur_wrapper -->
                        <div class="profile-bio-description">
                            <?php  
                            $author_short_bio = get_field('short_bio', 'user_' . $author_id);
                            if($author_short_bio){
                                echo '<p>'. $author_short_bio .'</p>';
                            }

                            $user_qas = get_field('user_question_and_answers', 'user_' . $author_id);
                            if(!empty($user_qas)){
                                foreach( $user_qas as $user_qa ){
                                    echo '<div class="author_qa">';
                                        echo '<p class="question">'. $user_qa['question'] .'</p>';
                                        echo '<p class="answer">'. $user_qa['answer'] .'</p>';
                                    echo '</div>';
                                }
                            }
                            ?>
                            <p></p>
                        </div>
                    </div>
                    <!-- End sidebar for mobile device -->

                    <!-- start of column post 2 -->
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 6,
                        'post_status' => 'publish',
                        'author' => $author_id,
                    );


                    $loop = new WP_Query($args);
                    if($loop->have_posts()):
                    ?>
                    <div class="archive_posts_wrapper">
                        <div class="row" id="author_posts_row">
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
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>

                    <div class="load_more_posts">
                        <button id="author_more_posts" class="btn site-btn load_more" data-id="<?php echo $author_id; ?>">More Articles</button>
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
                    <?php //echo do_shortcode('[oom_social_profiles]'); ?>
                </div>


                
                <div class="col-md-3">
                    <div class="author-sidebar d-none d-md-block">
                        <div class="profile_pictur_wrapper">
                            <div class="profile_picture">
                                <?php

                                $pp_attachment_id = (int)get_user_meta( (int)$author_id, 'mm_sua_attachment_id', true );
                                
                                if($pp_attachment_id){
                                    $img_attr = wp_get_attachment_image_src( $pp_attachment_id, 'full' );

                                    echo '<img src="'. $img_attr[0] .'" alt="Profile Picture">';
                                }
                                
                                ?>
                            </div>
                            <div class="author_quote">
                            <?php 
                            $author_quotes = get_field('user_habits', 'user_' . $author_id);
                            if(!empty($author_quotes)){
                                echo '<ul>';
                                    foreach($author_quotes as $quote){
                                        echo '<li>'. $quote['user_bio'] .'</li>';
                                    }
                                echo '</ul>';
                            }
                            ?>
                                
                                    
                                
                            </div>
                        </div> 
                        <!-- end of profile_pictur_wrapper -->
                        <div class="profile-bio-description">
                            <?php  
                            $author_short_bio = get_field('short_bio', 'user_' . $author_id);
                            if($author_short_bio){
                                echo '<p>'. $author_short_bio .'</p>';
                            }

                            $user_qas = get_field('user_question_and_answers', 'user_' . $author_id);
                            if(!empty($user_qas)){
                                foreach( $user_qas as $user_qa ){
                                    echo '<div class="author_qa">';
                                        echo '<p class="question">'. $user_qa['question'] .'</p>';
                                        echo '<p class="answer">'. $user_qa['answer'] .'</p>';
                                    echo '</div>';
                                }
                            }
                            ?>
                            <p></p>
                        </div>
                    </div>
                    <!-- end of author-sidebar -->
                </div>
               
            </div>
        </div>
    </section>


<?php get_footer(); ?>