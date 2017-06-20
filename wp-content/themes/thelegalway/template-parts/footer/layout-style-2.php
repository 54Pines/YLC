<?php
/**
 * The template for displaying the style-2 footer layout.
 *
 * @package Thelegalway
 */

?>
<div class="footer-container <?php echo thelegalway_get_invert_class_customize_option( 'footer_bg' ); ?>">
	<div class="site-info container">
		<?php
			thelegalway_footer_logo();
			thelegalway_footer_menu();
			thelegalway_contact_block( 'footer' );
			thelegalway_social_list( 'footer' );
			thelegalway_footer_copyright();
		?>
	</div><!-- .site-info -->
</div><!-- .container -->
