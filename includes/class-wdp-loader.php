<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_Loader' ) ) {

	/**
	* Class WDP_Loader. ()
	*/
	class WDP_Loader {

		/**
		*  Constructor.
		*/
		public function __construct() {
			$this->includes();
			add_action( 'admin_enqueue_scripts', array( $this, 'wdp_enqueue_scripts' ) );
		}

		/**
		* Function for Including Files and Classes
		*/
		public function includes() {
			include_once 'class-WDP-metabox.php';
			include_once 'class-WDP-priceshow.php';
		} 
		
		/**
		* Function for Enqueue Scripts 
		*/
		public function wdp_enqueue_scripts() {
			wp_enqueue_script( 'wdp_admin_js',  plugin_dir_url( __DIR__ ). '/assets/js/admin.js',   array('jquery') , wp_rand() );
			wp_localize_script( 
				'wdp_admin_js', 
				'ajax_object', 
				array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
			);
			wp_enqueue_style( 'WDP_plugin_style', plugin_dir_url( __DIR__ ). '/assets/css/style.css');
		}
	}
}
new WDP_Loader();
?>