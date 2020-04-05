<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package onourmoon
 */

?>

<?php
    
    if(!empty(get_field('footer_background_color', 'options'))){
        $footer_bg = 'style="background-color: '. get_field('footer_background_color', 'options') .'"';
    }
    

?>  
    <footer id="site-footer">

        
        <?php get_sidebar('footer'); ?>

           
        <div class="footer-copyrights">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright-text text-right"><?php the_field('footer_copyright_texts', 'options'); ?></div>
                    </div>
                </div>
            </div>
        </div>    
    </footer>

    <?php 
    if ( is_single() && 'post' == get_post_type() && function_exists('sharethis_inline_buttons')) {
        echo sharethis_inline_buttons(); 
    }
    
    
    ?>
    <?php wp_footer(); ?>
</body>
</html>
