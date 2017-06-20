<?php
/**
 * Template part for style-6 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thelegalway
 */
?>
<div class="header-container_wrap container">
	<div class="row row-lg-center">
		<div class="col-xs-12 col-lg-12">
			<div class="site-branding">
				<?php thelegalway_header_logo() ?>
				<?php thelegalway_site_description(); ?>
			</div>
		</div>

		<div class="col-xs-12 col-lg-12">
			<div class="header-btn-wrap">
				<?php thelegalway_header_btn(); ?>
			</div>
		</div>

	</div>
	<?php thelegalway_main_menu(); ?>
</div>
