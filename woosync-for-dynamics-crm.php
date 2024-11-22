<?php

/**
 * Plugin Name: WooSync for Dynamics CRM
 * Plugin URI: https://github.com/anasuddinpk/
 * Description: Made for the integration of WooCommerce with Microsoft Dynamics CRM & Power Platform.
 * Version: 1.0.0.0
 * Author: Anas Uddin
 * Author URI: https://www.linkedin.com/in/anasuddinpk/
 * Text Domain: ws-for-dcrm
 *
 * @package woosync-for-dcrm
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WSDCRM_PLUGIN_DIR' ) ) {
	define( 'WSDCRM_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'WSDCRM_PLUGIN_DIR_URL' ) ) {
	define( 'WSDCRM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WSDCRM_ABSPATH' ) ) {
	define( 'WSDCRM_ABSPATH', dirname( __FILE__ ) );
}

require_once WSDCRM_ABSPATH . '/includes/class-wsdcrm-loader.php';