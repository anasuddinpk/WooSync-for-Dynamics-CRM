<?php
/**
 * Plugin's main Loader.
 *
 * @package woosync-for-dcrm
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSDCRM_Loader' ) ) {
	/**
	 * Class WSDCRM_Loader.
	 */
	class WSDCRM_Loader {


		/**
		 *  Constructor.
		 */
		public function __construct() {
			$this->includes();
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripting_files' ) );
		}

		/**
		 * Includes files depend on platform
		 */
		public function includes() {
			include 'class-wsdcrm-get-wc-order-details.php';
			include 'class-wsdcrm-send-order-to-powerautomate.php';
		}

		/**
		 *
		 */
		public function enqueue_scripting_files() {
			wp_enqueue_script( 'wcdcrm-script', plugin_dir_url( __DIR__ ) . 'assets/js/wsdcrm-script.js', array( 'jquery' ), wp_rand() );
		}
	}

	new WSDCRM_Loader();
}
