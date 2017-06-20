<?php
/**
 * Menus configuration.
 *
 * @package Thelegalway
 */

add_action( 'after_setup_theme', 'thelegalway_register_menus', 5 );
/**
 * Register menus.
 */
function thelegalway_register_menus() {

	register_nav_menus( array(
		'top'          => esc_html__( 'Top', 'thelegalway' ),
		'main'         => esc_html__( 'Main', 'thelegalway' ),
		'main_landing' => esc_html__( 'Landing Main', 'thelegalway' ),
		'footer'       => esc_html__( 'Footer', 'thelegalway' ),
		'social'       => esc_html__( 'Social', 'thelegalway' ),
	) );
}
