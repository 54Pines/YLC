<?php
/**
 * Template part for style-4 header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thelegalway
 */

$search       = get_theme_mod( 'header_search', thelegalway_theme()->customizer->get_default( 'header_search' ) );
?>
<div class="header-container_wrap container">
	<div class="header-container__flex">
		<div class="site-branding">
			<?php thelegalway_header_logo() ?>
			<?php thelegalway_site_description(); ?>
		</div>

		<?php thelegalway_main_menu(); ?>
		
		<?php if ( $search ) : ?>
		<div class="header-icons divider">
			<?php thelegalway_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
		</div>
		<?php endif; ?>

		<?php thelegalway_header_btn(); ?>
	</div>
</div>
