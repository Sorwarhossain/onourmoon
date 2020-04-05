
<?php if(get_field('enable_footer_widgets', 'options')): ?>
    <?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12"><div class="line-before-footer"></div></div>
                    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                </div>
            </div>
        </div> 
    <?php endif; ?> 
<?php endif; ?> 