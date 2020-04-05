<?php 
/*
Template Name: Events
*/


get_header();

$page_id = get_queried_object_id();

?>

<?php
if(get_field('enable_page_banner', $page_id)) :
    $event_sliders = get_field('event_slider', $page_id);
    $event_banner_title = get_field('event_banner_title', $page_id);
    $event_banner_subtitle = get_field('event_banner_subtitle', $page_id);
    $event_mailchimp_form_shortcode = get_field('event_mailchimp_form_shortcode', $page_id);
?> 
<section id="event-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <?php
            if(!empty($event_sliders)){
                echo '<div class="event-carousel">';
                foreach($event_sliders as $event_slider){
                    echo '<img src="'. $event_slider['slider_image'] .'" class="img-fluid" alt="About Image">';
                }
                echo '</div>';
            }
            ?>
            </div>
            <div class="col-md-6">
                <div class="event-content-title">
                <?php
                    echo !empty($event_banner_title) ? "<h3>" . $event_banner_title . "</h3>" : '';
                    echo !empty($event_banner_subtitle) ? "<h6>" . $event_banner_subtitle . "</h6>" : '';
                ?>
                </div>

                <?php if(!empty($event_mailchimp_form_shortcode)) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="event-newslater subscription_form">
                                <label><?php the_field('event_mailchimp_title', $page_id); ?></label>
                                <?php echo do_shortcode($event_mailchimp_form_shortcode); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
        </div>
        <div class="d-none d-md-block d-lg-block d-xl-block"><?php echo do_shortcode('[oom_social_profiles]'); ?></div>
    </div>
    
</section>
<?php endif; ?>


<section id="event">
    <div class="container">

        <?php
        if(get_field('enable_upcoming_events', $page_id)) :

            $upcoming_events_title = get_field('upcoming_events_title', $page_id);
        ?> 
            <div class="row upcoming_events">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if(!empty($upcoming_events_title)){
                                echo '<div class="event-heading">
                                    <img src="'. $upcoming_events_title .'">
                                </div>';
                            }
                            ?> 
                        </div>
                    </div>

                    <?php
                    $args = array(
                        'post_type' => 'event',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                    );
                    $loop = new WP_Query($args);
                    if($loop->have_posts()) :
                    ?>

                    <div class="row">
                        <?php  
                        while($loop->have_posts()) :
                            $loop->the_post();

                            $event_date = get_field('event_date', get_the_ID());

                            if(strtotime($event_date) < strtotime('today')){
                                continue;
                            }

                            $location = get_field('location', get_the_ID());
                            $event_link = get_field('event_link', get_the_ID());
                        ?>

                        <div class="col-md-4">
                            <div class="event-content">
                                <h4 class="event-title"><?php the_title(); ?></h4>
                                <?php
                                    echo !empty($location) ? '<p class="event-author">'. $location .'</p>' : '';
                                    echo !empty($event_date) ? '<p class="event-date">'. $event_date .'</p>' : '';
                                    echo !empty($event_link) ? '<h5 class="event-more"><a href="'. $event_link .'" target="_blank">LEARN MORE <i class="fa fa-arrow-right"></i></a></h5>' : '';
                                ?>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <?php endif; ?>





                </div>
                <div class="col-md-3">
                <?php
                $event_get_in_touch = get_field('event_get_in_touch', $page_id);
                ?>
                    <div class="want-us-to">
                        <?php  
                            echo !empty($event_get_in_touch['title']) ? "<h4>" . $event_get_in_touch['title'] . "</h4>" : '';
                            if(!empty($event_get_in_touch['button_label'])) {
                                echo '<p><a href="'. $event_get_in_touch['button_link'] .'">'. $event_get_in_touch['button_label'] .' <i class="fa fa-arrow-right"></i></a></p>';
                            }
                        ?>                        
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <?php
        if(get_field('enable_past_events', $page_id)) :
            $post_events_title = get_field('post_events_title', $page_id);
        ?> 
            <div class="row past_events">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if(!empty($post_events_title)){
                                    echo '<div class="event-heading">
                                        <img src="'. $post_events_title .'">
                                    </div>';
                                }
                            ?>
                        </div>
                    </div>

                    <?php
                    $args = array(
                        'post_type' => 'event',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                    );
                    $loop = new WP_Query($args);
                    if($loop->have_posts()) :
                    ?>

                        <div class="row">
                        <?php  
                        while($loop->have_posts()) :
                            $loop->the_post();

                            $event_date = get_field('event_date', get_the_ID());

                            if(strtotime($event_date) >= strtotime('today')){
                                continue;
                            }



                            $location = get_field('location', get_the_ID());
                            $event_link = get_field('event_link', get_the_ID());
                        ?>
                            <div class="col-md-4">
                                <div class="event-content">
                                    <h4 class="event-title"><?php the_title(); ?></h4>
                                    <?php
                                        echo !empty($location) ? '<p class="event-author">'. $location .'</p>' : '';
                                        echo !empty($event_date) ? '<p class="event-date">'. $event_date .'</p>' : '';
                                        echo !empty($event_link) ? '<h5 class="event-more"><a href="'. $event_link .'" target="_blank">LEARN MORE <i class="fa fa-arrow-right"></i></a></h5>' : '';
                                    ?>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>


                        </div>
                    <?php endif; ?>

                </div>
                <div class="col-md-3"> </div>
            </div>
        <?php endif; ?>
    </div>
</section>


<?php get_footer(); ?>