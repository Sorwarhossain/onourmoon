<?php 
/*
Template Name: About
*/
get_header();
$page_id = get_queried_object_id();

?>



<?php
if(get_field('enable_about_on_our_moon', $page_id)) :

    $about_title = get_field('about_title', $page_id);
    $about_subtitle = get_field('about_subtitle', $page_id);
    $about_description = get_field('about_description', $page_id);
    $about_logo = get_field('about_logo', $page_id);
?> 
<section id="about-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mr-auto ml-auto">
            
                <?php  
                if(!empty($about_title)){
                    echo sprintf('<div class="about-header-logo first"><img src="%s" class="img-fluid rounded mx-auto d-block" alt="About Logo"></div>', $about_title);
                }
                if(!empty($about_subtitle)){
                    echo sprintf('<div class="about-vartical-line"></div><div class="about-subtitle"><h2>%s</h2></div>', $about_subtitle);
                }
                if(!empty($about_description)){
                    echo sprintf('<div class="about-vartical-line"></div><div class="about-text"><p>%s</p></div>', $about_description);
                }
                if(!empty($about_logo)){
                    echo sprintf('<div class="about-vartical-line"></div><div class="about-header-logo"><img src="%s" class="img-fluid rounded mx-auto d-block" alt="About Logo"></div>', $about_logo);
                }
                ?>
                
            </div>
        </div>
        <div class="d-none d-md-block d-lg-block d-xl-block">
            <?php echo do_shortcode('[oom_social_profiles]'); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
    $founder_letter_title = get_field('founder_letter_title', $page_id);
    $founder_picture = get_field('founder_picture', $page_id);
    $letter_content = get_field('letter_content', $page_id);
    $founder_letter_signature = get_field('founder_letter_signature', $page_id);
    $founder_name = get_field('founder_name', $page_id);
    $founder_title = get_field('founder_title', $page_id);
?>
<section id="about-description">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="about-description-image">
                    <?php
                        if(!empty($founder_picture)){
                            echo sprintf('<img src="%s" class="img-fluid" alt="Founder Picture">', $founder_picture);
                        }
                    ?> 
                </div>
            </div>
            <div class="col-md-5">
                <?php
                    if(!empty($founder_letter_title)){
                        echo sprintf('<div class="about-description-title"><h2>%s</h2></div>', $founder_letter_title);
                    }
                ?>
                <div class="about-description-text">
                    <?php
                        if(!empty($letter_content)){
                            echo sprintf('<p>%s</p>', $letter_content);
                        }
                        if(!empty($founder_letter_signature)){
                            echo sprintf('<img src="%s" class="img-fluid" alt="Founder Signature">', $founder_letter_signature);
                        }
                        if(!empty($founder_name)){
                            echo sprintf('<h6 class="about-description-subtile">%s</h6>', $founder_name);
                        }
                        if(!empty($founder_title)){
                            echo sprintf('<p class="about-description-subtile-name">%s</p>', $founder_title);
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</section>



<?php
    $about_note_column_1 = get_field('about_note_column_1', $page_id);
    $about_note_column_2 = get_field('about_note_column_2', $page_id);
    $contact_us_link = get_field('contact_us_link', $page_id);
?>
<section id="connect">
    <div class="container">
        <div class="row connect-content">
            <div class="col-md-5">
                <div class="connect-text">
                    <?php
                        if(!empty($about_note_column_1)){
                            echo sprintf('<p>%s</p>', $about_note_column_1);
                        }
                    ?>
                    <div class="connect-vartical-line"></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="connect-text">
                    <?php
                        if(!empty($about_note_column_2)){
                            echo sprintf('<p>%s</p>', $about_note_column_2);
                        }
                    ?>
                    <div class="connect-vartical-line"></div>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <div class="want-to-connect">
                    <?php
                        if(!empty($contact_us_link['title'])){
                            echo sprintf('<h4>%s</h4>', $contact_us_link['title']);
                        }

                        if(!empty($contact_us_link['label']) || !empty($contact_us_link['link'])){
                            echo sprintf('<p><a href="%s">%s <i class="fa fa-arrow-right"></i></a></p>', $contact_us_link['link'], $contact_us_link['label']);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
if(get_field('enable_writers', $page_id)):
    $writer_title = get_field('writer_title', $page_id);
    $writers_list = get_field('writers_list', $page_id);
?>
<section id="writers">
    <div class="container">
        <div class="row">
            <?php
                if(!empty($writer_title)){
                    echo sprintf('<div class="writers-title"><h4>%s</h4></div>', $writer_title);
                }
            ?>  
        </div>
        <div class="row writers-border">
            <div class="col-md-12 writers-left">
            <?php
            if(!empty($writers_list)){
                echo '<div class="writers-subtitle"><ul class="row">';
                foreach($writers_list as $writer){
                    echo '<li class="col-md-5"><a href="'. $writer['link'] .'">'. $writer['name'] .'</a></li><li class="col-md-1"></li>';
                }
                echo '</ul></div>';
            }
            
            ?>
                                   
            </div>
        </div>
    </div>
</section>
<?php endif; ?>




<?php get_footer(); ?>