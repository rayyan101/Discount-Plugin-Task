<?php 

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
		woocommerce_wp_text_input(
			array(
				'id' => 'discount_textfield',
				'class'            => 'textfield',
				'label' => __( 'Enter The Discount'),
				'desc_tip' => true,
				'type' => 'number',
				'description' => __( 'Enter The Discount In This Text Field')
			)
		);
		woocommerce_wp_checkbox( 
			array( 
				'id'            => 'discount_checkbox',
				'class'            => 'checkbox',  
				'label'         => __('My Checkbox Field',), 
				'description'   => __( 'Check me!', 'woocommerce' ),
				'value'         => get_post_meta('checkbox', true ), 
				)
		);
		echo '</div>';
	}

	/**
	* Saving value of discount field in database 
	*/
	public function WDP_textfield_value_saving( $post_id ) {
		$product = wc_get_product( $post_id );
		$discount = isset( $_POST['discount_textfield'] ) ? $_POST['discount_textfield'] : '';
		if(!$discount == null) {
			if($discount > 0 && $discount < 100){		
				$product->update_meta_data( 'discount_textfield', sanitize_text_field( $discount ) );
				$product->save(); 
				$product = wc_get_product( $post_id );
				$discount = isset( $_POST['discount_checkbox'] ) ? $_POST['discount_checkbox'] : '';
				$product->update_meta_data( 'discount_checkbox', sanitize_text_field( $discount ) );
				$product->save();
			}	
		}
	}
}}
new WDP_metabox(); 
?>


