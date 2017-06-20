<?php
/**
 * Thumbnails configuration.
 *
 * @package Thelegalway
 */

add_action( 'after_setup_theme', 'thelegalway_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function thelegalway_register_image_sizes() {
	set_post_thumbnail_size( 418, 315, true );

	// Registers a new image sizes.
	add_image_size( 'thelegalway-thumb-s', 150, 150, true );
	add_image_size( 'thelegalway-slider-thumb', 158, 88, true );
	add_image_size( 'thelegalway-thumb-m', 400, 400, true );
	add_image_size( 'thelegalway-thumb-m-2', 650, 490, true );
	add_image_size( 'thelegalway-thumb-masonry', 418, 9999 );
	add_image_size( 'thelegalway-thumb-l', 886, 668, true );
	add_image_size( 'thelegalway-thumb-l-2', 886, 315, true );
	add_image_size( 'thelegalway-thumb-xl', 1920, 1080, true );
	add_image_size( 'thelegalway-author-avatar', 512, 512, true );

	add_image_size( 'thelegalway-thumb-301-226', 301, 226, true );
	add_image_size( 'thelegalway-thumb-480-362', 480, 362, true );
	add_image_size( 'thelegalway-thumb-1355-1020', 1355, 1020, true );
}
