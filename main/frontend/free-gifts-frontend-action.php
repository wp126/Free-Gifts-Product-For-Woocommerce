<?php

if (!defined('ABSPATH')){
  exit;
}


add_action('init','FGW_gift_item_load_actions');
function FGW_gift_item_load_actions(){
    global $fgw_comman;
    if($fgw_comman['fgw_gift_enable'] == 'enable' ) {        
        if($fgw_comman['fgw_allow_only_logged_in'] == 'enable') {
            if(is_user_logged_in()) {           
                add_action( 'wp', 'FGW_init_action' );
                add_filter( 'woocommerce_cart_item_name', 'FGW_gift_item_name' , 10, 2 );        
            }
        } else {
            add_action( 'wp', 'FGW_init_action' );
            add_filter( 'woocommerce_cart_item_name', 'FGW_gift_item_name' , 10, 2 );
        }
    }
}

function FGW_gift_item_name( $item_name, $item ) {
    global $fgw_comman;

    if ( isset( $item['isgift'] ) && $item['isgift'] == 'yes' ) {
        $fgw_gift_prod_txt_in_cart = $fgw_comman['fgw_gift_prod_txt_in_cart'];
        $fgw_gift_text = esc_html__( '('.$fgw_gift_prod_txt_in_cart.')', 'fgw' );
        
        if ( strpos( $item_name, '</a>' ) !== false ) {
            $name = sprintf( $fgw_gift_text, '<a href="' . get_permalink( $item['product_id'] ) . '">' . get_the_title( $item['product_id'] ) . '</a>' );
        } else {
            $name = sprintf( $fgw_gift_text, get_the_title( $item['product_id'] ) );
        }
        $item_name .= ' <span class="fgw_item_name">' . apply_filters( 'fgw_item_name', $name, $item ) . '</span>';
    }
    return $item_name;
}

function FGW_init_action() {
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'fgw_giftred' && isset($_REQUEST['fgw_prod']) && $_REQUEST['fgw_prod'] !='') {
        $prod_id = sanitize_text_field($_REQUEST['fgw_prod']);
        $redpage = sanitize_text_field($_REQUEST['redpage']);
        $product = wc_get_product( $prod_id );
        $prod_type = $product->get_type();
        $variations = $product->get_parent_id();
        if(!empty($product)){
            $title = $product->get_name();
        }

        if($prod_type == 'simple') {
            WC()->cart->add_to_cart($prod_id, 1, NULL, array("free_girt_random"=>rand()));
            if($redpage == 'cart') {
                wc_add_notice( __("'".esc_attr($title)."' successfully Added.", "woocommerce"), "success" );
                wp_safe_redirect( wc_get_cart_url() ); 
            } elseif ($redpage == 'checkout') {
                wc_add_notice( __("'".esc_attr($title)."' successfully Added.", "woocommerce"), "success" );
                wp_safe_redirect( wc_get_checkout_url() );
            }
            exit;
        } else {
            $variations = $product->get_parent_id();
            WC()->cart->add_to_cart( $variations, 1,  $prod_id, null, array("free_girt_random"=>rand()) ); 
            if($redpage == 'cart') {
                wc_add_notice( __("'".esc_attr($title)."' successful Added.", "woocommerce"), "success" );
                wp_safe_redirect( wc_get_cart_url() );  
            } elseif ($redpage == 'checkout') {
                wc_add_notice( __("'".esc_attr($title)."' successfully Added.", "woocommerce"), "success" );
                wp_safe_redirect( wc_get_checkout_url() );
            }
            exit;
        }
    }
}