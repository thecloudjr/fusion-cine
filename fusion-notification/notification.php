<?php
   /*
   Plugin Name: Fusion Cine - Custom Email Notification
   Plugin URI: https://fusioncine.com
   description: Custom plugin separating Easten/Western sales orders based on province.
   Version: 1.0
   Author: Claudio Alves
   Author URI: https://github.com/thecloudjr
   License: GPL2
   */


add_filter( 'woocommerce_email_recipient_new_order', 'cond_recipients_email_notifications', 10, 2 );
function cond_recipients_email_notifications( $recipient, $order ) {

if ( ! is_a( $order, 'WC_Order' ) ) return $recipient;

// Target Province
$province_zone1 = array( 'ON', 'Ontario' , 'QC', 'Quebec', 'NB', 'New Brunswick', 'NS', 'Nova Scotia', 'PE', 'Prince Edward Island', 'NU', 'Nunavut', 'NL', 'Newfoundland and Labrador' );
$province_zone2 = array( 'BC', 'British Columbia', 'AB', 'Alberta', 'YT', 'Yukon', 'NT', 'Northwest Territories', 'SK', 'Saskatchewan', 'MB', 'Manitoba' );

// Get User Province 
$user_province_zone =  $order->get_shipping_state();
if(empty($user_shipping_state))
    $user_province_zone = $order->get_billing_state();

// Add email based on user province
if ( in_array( $user_province_zone, $province_zone1)) {
            $recipient .= ', websaleseast@fusioncine.com';
    } elseif ( in_array( $user_province_zone, $province_zone2) ) {
    $recipient .= ', websales@fusioncine.com';
    }

return $recipient;
}

//Quote section - Woocommerce

// Change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Request Quote', 'woocommerce' ); 
}

// Change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Request Quote', 'woocommerce' );
}

?>