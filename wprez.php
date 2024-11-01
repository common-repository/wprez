<?php

/*
Plugin Name: WPrez
Version: 0.1.1
Author: Russell Fair
Author URI: http://q21.co/
Plugin URI: http://q21.co/wprez/

Description: WPrez makes presentations using the power of WordPress and impress.js. Use it to create presentations that can be run directly from you're WordPress website or blog.
*/

$wz_version = '010';
$wz_libdir = WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . 'lib/';
$wz_liburl = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . 'lib/';

load_plugin_textdomain( 'wprez', false, $wz_libdir . '/languages/' ) ;

require_once ( $wz_libdir . 'classes-loader.php' );

function wprez_activate() {

	global $wp_rewrite;
	$wp_rewrite->flush_rules();

	$wz_info = array(
		'version' => (int) 0,
		'rewrites_flushed' => (bool) 0
	);

	update_option('wzinfo', $wz_info);

}

register_activation_hook( __FILE__, 'wprez_activate' );

function wprez_deactivate() {

	global $wp_rewrite;
	$wp_rewrite->flush_rules();

}

register_deactivation_hook( __FILE__, 'wprez_deactivate' );
