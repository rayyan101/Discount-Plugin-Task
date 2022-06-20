<?php 

/**
 * Plugin Name:       Woocommerce Discount Plugin
 * Description:       Applying Discount in WooCOmmerce Products
 * Version:           1.1.1.0
 * Author:            Codup
 * Author URI:        https://codup.co
 * License:           GPL v2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WDP_PLUGIN_DIR' ) ) {
	define( 'WDP_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'WDP_PLUGIN_DIR_URL' ) ) {
	define( 'WDP_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WDP_ABSPATH' ) ) {
	define( 'WDP_ABSPATH', dirname( __FILE__ ) );
}

	include_once WDP_ABSPATH . '/includes/class-WDP-loader.php';
?>