<?php 
/*
Template Name: Contact
*/
get_header();
$page_id = get_queried_object_id();

?>

    <?php
    if(get_field('enable_contact_options', $page_id)) :

        $contact_emails = get_field('contact_emails', $page_id);
    ?> 
    <section id="contact-info">
        <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="contact-contain">
                <?php
                    if(!empty($contact_emails)){
                        foreach($contact_emails as $email){
                            if(!empty($email['contact_email'])){
                                echo '<h3>'. $email['contact_email']['title'] .' <a href="mailto:'. $email['contact_email']['email'] .'">'. $email['contact_email']['email'] .'</a></h3>
                            <h3></h3>';
                            }
                        }
                    }
                ?>
                </div>
            </div>
            <div class="col-md-1 d-none d-md-block d-lg-block d-xl-block">
                <?php echo do_shortcode('[oom_social_profiles]'); ?>
            </div>
        </div>
        </div>
    </section>
    <?php endif; ?>



<?php get_footer(); ?>