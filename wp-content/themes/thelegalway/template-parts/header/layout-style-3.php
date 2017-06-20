<?php
/**
 * Template part for style-3 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thelegalway
 */
?>
<div class="header-container_wrap container">
	<?php thelegalway_vertical_main_menu(); ?>
	<div class="header-container__flex">
		<div class="site-branding">
			<?php thelegalway_header_logo() ?>
			<?php thelegalway_site_description(); ?>
		</div>

		<div class="header-icons">
			<?php thelegalway_header_search( '<div class="header-search"><span class="search-form__toggle"></span>%s<span class="search-form__close"></span></div>' ); ?>
			<?php thelegalway_vertical_menu_toggle( 'main-menu' ); ?>
			<?php thelegalway_header_btn(); ?>
		</div>

	</div>
</div>
