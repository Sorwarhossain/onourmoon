<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package onourmoon
 */
?>
<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
	<div class="col-md-3">
		<div class="right-sidebar">
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		</div>
	</div>
<?php endif; ?> 