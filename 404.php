<?php
get_header(); ?>

	<section id="main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<section class="error-404 not-found text-center">
						<header class="page-header">
							<h1 class="hero">404</h1>
							<h3 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'onourmoon' ); ?></h3>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below.', 'onourmoon' ); ?></p>

							<a class="btn site-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Back To Homepage', 'onourmoon'); ?></a>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</div>
		</div>
	</section><!-- #primary -->

<?php
get_footer();
?>