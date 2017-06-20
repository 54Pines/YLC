<?php
/**
 * Cherry-services-list hooks.
 *
 * @package Thelegalway
 */

// Customization cherry-services-list plugin.
add_filter( 'cherry_services_list_meta_options_args', 'thelegalway_change_services_list_icon_pack' );
add_filter( 'cherry_services_default_icon_format', 'thelegalway_cherry_services_default_icon_format' );
add_filter( 'cherry_services_listing_templates_list', 'thelegalway_cherry_services_listing_templates_list' );
add_filter( 'cherry_services_features_title_format', 'thelegalway_cherry_services_features_title_format' );

/**
 * Change cherry-services-list icon pack.
 */
function thelegalway_change_services_list_icon_pack( $fields ) {

	$fields['fields']['cherry-services-icon']['icon_data'] = array(
		'icon_set'    => 'thelegalwayLinearIcons',
		'icon_css'    => THELEGALWAY_THEME_URI . '/assets/css/linearicons.css',
		'icon_base'   => 'linearicon',
		'icon_prefix' => 'linearicon-',
		'icons'       => thelegalway_get_linear_icons_set(),
	);

	return $fields;
}

/**
 * Change cherry-services-list icon format
 *
 * @return string
 */
function thelegalway_cherry_services_default_icon_format( $icon_format ) {
	return '<i class="linearicon %s"></i>';
}

/**
 *  Add template to cherry services-list templates list;
 */
function thelegalway_cherry_services_listing_templates_list( $tmpl_list ) {

	$tmpl_list['media-icon-float'] = 'media-icon-float.tmpl';
	$tmpl_list['counter'] = 'counter.tmpl';

	return $tmpl_list;
}

/**
 * Change cherry-services features title format.
 */
function thelegalway_cherry_services_features_title_format( $title_format ) {
	return '<h5 class="service-features_title">%s</h5>';
}
