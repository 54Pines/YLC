<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Thelegalway
 */

$footer_contact_block_visibility = get_theme_mod( 'footer_contact_block_visibility', thelegalway_theme()->customizer->get_default( 'footer_contact_block_visibility' ) );
?>

<div class="footer-container <?php echo thelegalway_get_invert_class_customize_option( 'footer_bg' ); ?>">
	<div class="site-info container">
		<div class="site-info-wrap">
			<?php thelegalway_footer_logo(); ?>
			<?php thelegalway_footer_menu(); ?>

			<?php if ( $footer_contact_block_visibility ) : ?>
			<div class="site-info__bottom">
			<?php endif; ?>
				<?php thelegalway_footer_copyright(); ?>
				<?php thelegalway_contact_block( 'footer' ); ?>
			<?php if ( $footer_contact_block_visibility ) : ?>
			</div>
			<?php endif; ?>

			<?php thelegalway_social_list( 'footer' ); ?>
		</div>

	</div><!-- .site-info -->
</div><!-- .container -->
