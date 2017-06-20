<?php
/**
 * Template part for style-5 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thelegalway
 */
?>
<div class="header-container_wrap container">
	<div class="header-container__flex">
		<div class="site-branding">
			<?php thelegalway_header_logo() ?>
			<?php thelegalway_site_description(); ?>
		</div>
		<?php thelegalway_main_menu(); ?>
		<?php thelegalway_header_btn(); ?>
	</div>
</div>
