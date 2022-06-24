<?php 
	/**
	* Class WDP_PRICESHOW.
	*/
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
		* Discounted Price Shwowing in product page and Replacing with regular Price   
		*/ 
		public function WDP_discount_show( $price ) {
			
			global $post;
			$product_id = $post->ID;
			$checbox_value = get_post_meta( $product_id, 'discount_checkbox', true );
			if($checbox_value=="yes"){	
				// $product = wc_get_product( $product_id );
				// $discount_price = get_post_meta( $product_id, 'discount_textfield', true );
				// $regular_price = $product->get_regular_price();
				// $price = $regular_price * ((100 - $discount_price)/ 100) ;
				$price = $this->wdp_applying_discount($product_id);
			
			}
			return $price;
		}
		
		/**
		* Replacing Regular Price with Discount price in Cart Page    
		*/ 
		public function WDP_cart_discount( $cart_object  ) {
			if($cart_object){
				foreach ( $cart_object->get_cart() as $hash => $value ) {
					$product_id = $value['product_id']; 
					$discount_checkbox = get_post_meta( $product_id, 'discount_checkbox', true );
					if(!$discount_checkbox == null){	
						$new_price = $this->wdp_applying_discount($product_id);
						$value[ 'data' ]->set_price( $new_price);
					}
				}
			}
		}

		/**
		* this function is doing discount calculation on reguler price with discount price
		*/ 
		public function wdp_applying_discount($product_id){
			$product = wc_get_product( $product_id );
			$discount_price = get_post_meta( $product_id, 'discount_textfield', true );
			$regular_price = $product->get_regular_price();
			$new_price = $regular_price * ((100 - $discount_price)/ 100) ;
			return $new_price;
		}	
	}	
}
new WDP_priceshow(); 
?>


