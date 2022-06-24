<?php 
	/**
	* in this class we are showing discount field in product page (Admin Dashboard) and saving values in database 
	*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_metabox' ) ) {

	/**
	* Class WDP_METABOX.
	*/
	class WDP_metabox {

		/**
		*  Constructor.
		*/
		public function __construct() {
			add_action( 'woocommerce_product_options_general_product_data', array($this,'WDP_discount_fields_show' ));
			add_action( 'woocommerce_process_product_meta',  array($this, 'WDP_textfield_value_saving'));     
		}
		
		/**
		* showing discount field and checkbox in product page for Applying Discount
		*/
		public function WDP_discount_fields_show () {
			global $woocommerce;
			woocommerce_wp_checkbox( 
				array( 
					'id'            => 'discount_checkbox',
					'class'         => 'checkbox',  
					'label'         => __('Enable Discount'), 
					'description'   => __( 'this will enable Discount' ),
					
					
				
				)
			);
			woocommerce_wp_text_input(
				array(
					'id' 		=> 'discount_textfield',
					'class'     => 'textfield',
					'label' 	=> __( 'Enter The Discount'),
					'desc_tip' 	=> true,
					'type' 		=> 'number',
					'description' => __( 'Enter The Discount In This Text Field'),
					'custom_attributes' => array(
						'step' => 'any',
						'min' => '0',
						'max' => '100'
					)
				)
			);
		}

		/**
		* Saving value of discount field in database 
		*/
		public function WDP_textfield_value_saving( $post_id ) {
			$discount = isset( $_POST['discount_textfield'] ) ? $_POST['discount_textfield'] : '';
			$checkbox = isset( $_POST['discount_checkbox'] ) ? $_POST['discount_checkbox'] : '';
			if ($_POST['discount_checkbox'] == true){
				if( $discount > 0 && $discount < 100) {
					update_post_meta( $post_id, "discount_textfield", $discount  );
					update_post_meta( $post_id, "discount_checkbox", $checkbox  );
				}
			}
			if ($_POST['discount_checkbox'] == false){
				
					update_post_meta( $post_id, "discount_textfield", ""  );
					update_post_meta( $post_id, "discount_checkbox", ""  );
				
			}
			
			

	

	}
}}
new WDP_metabox(); 
?>


