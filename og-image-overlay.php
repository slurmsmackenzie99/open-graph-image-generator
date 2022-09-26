<?php
/*
Plugin Name: Open Graph Image Generator
Description: Add Open Graph images, overlays, include authors, title and description. Recommended with Yoast SEO or Rank Math plugin.
Version: 1
Author: Webcrafters
*/

defined( 'ABSPATH' ) || exit;

/**
 * Include template parts
 */

require_once __DIR__ . '/admin/functions.php';
require_once __DIR__ . '/admin/customizer.php';
require_once __DIR__ . '/template/config.php';


/**
 * Add settings
 */

function ogio_add_plugin_link ( $links ) {
	$link = add_query_arg(
        array(
            'url'           => urlencode( site_url( '/?ogio_settings=true' ) ),
            'return'        => urlencode( admin_url() ),
            'ogio_settings' => 'true',
        ),
        'customize.php?autofocus[section]=ogio_settings'
    );
    $settings_link = array(
        '<a href="' . admin_url( $link ) . '">Settings</a>',
    );
    return array_merge( $links, $settings_link );
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'ogio_add_plugin_link' );
