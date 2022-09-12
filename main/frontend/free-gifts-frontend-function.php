<?php

if (!defined('ABSPATH')){
  exit;
}

add_action('init','FGW_gift_pro_actions_for_functions_load');
function FGW_gift_pro_actions_for_functions_load(){
    global $fgw_comman;
    if($fgw_comman['fgw_gift_enable'] == 'enable' ) {
        if($fgw_comman['fgw_allow_only_logged_in'] == 'enable') {
            if(is_user_logged_in()) {
                add_filter( 'woocommerce_cart_item_subtotal', 'FGW_gift_cart_item_price_custom_label', 20, 3 );
                add_filter( 'woocommerce_cart_item_price', 'FGW_gift_cart_item_price_custom_label', 20, 3 );
                add_filter( 'woocommerce_order_formatted_line_subtotal', 'FGW_gift_order_item_price_custom_label', 20, 3 );
                add_action( 'woocommerce_add_order_item_meta', 'FGW_gift_order_item_meta' , 10, 3 );
                add_filter( 'woocommerce_hidden_order_itemmeta', 'FGW_gift_hidden_order_itemmeta', 10, 1);
                add_filter( 'woocommerce_cart_item_quantity', 'FGW_gift_cart_item_quantity', 10, 3 );
                add_action( 'woocommerce_before_order_itemmeta', 'FGW_gift_before_order_itemmeta', 10, 3 );
            }
        } else {
            add_filter( 'woocommerce_cart_item_subtotal', 'FGW_gift_cart_item_price_custom_label', 20, 3 );
            add_filter( 'woocommerce_cart_item_price', 'FGW_gift_cart_item_price_custom_label', 20, 3 );
            add_filter( 'woocommerce_order_formatted_line_subtotal', 'FGW_gift_order_item_price_custom_label', 20, 3 );
            add_action( 'woocommerce_add_order_item_meta', 'FGW_gift_order_item_meta' , 10, 3 );
            add_filter('woocommerce_hidden_order_itemmeta', 'FGW_gift_hidden_order_itemmeta', 10, 1);
            add_filter( 'woocommerce_cart_item_quantity', 'FGW_gift_cart_item_quantity', 10, 3 );
            add_action( 'woocommerce_before_order_itemmeta', 'FGW_gift_before_order_itemmeta', 10, 3 );
        }
    }
}

function FGW_gift_order_item_meta ( $item_id, $cart_item, $cart_item_key ) {
    if ( isset( $cart_item[ 'isgift' ] ) && $cart_item[ 'isgift' ] == 'yes' ) {
        wc_add_order_item_meta( $item_id, '_isgift',  'Yes');
    }
}

function FGW_gift_cart_item_price_custom_label( $price, $cart_item, $cart_item_key ) {
    $free_label = '<span class="amount">' . __('Free') . '</span>';
    if(isset($cart_item['isgift']) && $cart_item['isgift'] == 'yes') {
        return $free_label;
    } else {
        return $price;
    }
}

function FGW_gift_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ) {
    if( is_cart() ) {
        if ( isset( $cart_item[ 'isgift' ] ) && $cart_item[ 'isgift' ] == 'yes' ) {
            $product_quantity = sprintf( '<div class="quantity"><input type="number" class="input-text qty text" name="cart[%1$s][qty]" value="%2$s" title="Qty" size="4" inputmode="numeric" disabled></div>', $cart_item_key, $cart_item['quantity'] );
        }
    }
    return $product_quantity;
}

function FGW_gift_before_order_itemmeta( $item_id, $item, $_product ){
    global $fgw_comman;
    $isgift = wc_get_order_item_meta( $item_id, '_isgift', true );
    if($isgift == 'Yes') {
        $fgw_gift_prod_txt_in_cart = $fgw_comman['fgw_gift_prod_txt_in_cart'];
        echo "<strong><em>".esc_html($fgw_gift_prod_txt_in_cart)."</em></strong>";
    }
}

function FGW_gift_order_item_price_custom_label( $subtotal, $item, $order ) {
    if($item->get_meta('_isgift') == 'Yes') {
        $free_label = '<span class="amount">' . __('Free') . '</span>';
        return $free_label;
    } else {
        return $subtotal;
    }
}

function FGW_gift_hidden_order_itemmeta($arr) {
    $arr[] = '_isgift';
    return $arr;
}