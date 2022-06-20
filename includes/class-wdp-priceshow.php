<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'WDP_priceshow' ) ) {
/**
* Class WDP_PRICESHOW.
*/
class WDP_priceshow {

	/**
	*  Constructor.
	*/
	public function __construct() {    
		add_filter( 'woocommerce_get_price_html', array($this, 'WDP_discount_show' ));
		add_filter( 'woocommerce_before_calculate_totals', array($this, 'WDP_cart_discount' ));
	}
	
	/**
	* Discounted Price Shwowing in product page and Replacing Sale Price   
	*/ 
	public function WDP_discount_show( $price ) {
		global $post;
		$product = wc_get_product( $post->ID );
		$checbox_value = get_post_meta( $post->ID, 'discount_checkbox', true );
		if($checbox_value=="yes"){
			$discount_price = get_post_meta( $post->ID, 'discount_textfield', true );
			$sale_price = $product->get_regular_price();
			$new_price = $sale_price * ((100 - $discount_price)/ 100) ;
			$price = $new_price; 
			return $price; 
		}
		else {
			return $price;
		}
	}
	
	/**
	* Replacing Sale Price with Discount price in Cart Page   
	*/ 
	public function WDP_cart_discount( $cart_object  ) {
		foreach ( $cart_object->get_cart() as $hash => $value ) {
			$product_id = $value['product_id']; 
			$discount_checkbox = get_post_meta( $product_id, 'discount_checkbox', true );
			if(!$discount_checkbox == null){
				$discount_price = get_post_meta( $product_id, 'discount_textfield', true );
				$sale_price = $value[ 'data' ]->get_regular_price();
				$new_price = $sale_price * ((100 - $discount_price)/ 100) ;
				$value[ 'data' ]->set_price( $new_price);
			}
		}
	}
}}
new WDP_priceshow(); 
?>


