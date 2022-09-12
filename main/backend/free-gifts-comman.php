<?php
if (!defined('ABSPATH')){
    exit;
}

// Default values and save settings
add_action('init','FGW_init_save');
function FGW_init_save(){
    global $fgw_comman;
    
    $optionget = array(
        'fgw_gift_enable' => 'enable',
        'fgw_gift_prod_display' => 'after_cart_table',
        'fgw_ckout_enable' => '',
        'fgw_gift_prod_display_ckout' => 'slider',
        'fgw_gift_title' => 'Select Your Gift',
        'fgw_gift_title_font_size' => '24',
        'fgw_gift_prod_txt_in_cart' => 'Gift Product',
        'fgw_gift_remove_gift_items' => 'enable',
        'fgw_allow_multiple_gift'=>'enable',
        'fgw_gift_rule' => '',
        'fgw_allow_only_logged_in' => '',
        'fgw_allow_incluidve_tax' => '',
        'fgw_add_to_cart_text' => 'Add To Cart',
        'fgw_mtvtion_msg_enable' => 'enable',
        'fgw_prodrule_mtvtion_multi_msg' => 'You will be eligible When you add this product Quantity {minqty} to {maxqty} in your cart, you will get {allow_gift} products for gift.',
        'fgw_catrule_mtvtion_multi_msg' => 'You will be eligible When you add these {categories} categories product Quantity {minqty} to {maxqty} in your cart,you will get {allow_gift} products for Gift.',
        'fgw_pricerule_mtvtion_multi_msg' => 'You will be eligible When your cart total between 100 to 200 , you will get {allow_gift} products for Gift.',
        'fgw_eligiblity_message' => 'You are eligible for a free gift, You can add {allowed_gifts} gifts to your cart.',
        'fgw_eligiblity_btn_text' => 'Get Your Gift',
        'showslider_item_desktop' => '5',
        'showslider_item_tablet' => '3',
        'showslider_item_mobile' => '1',
        'showslider_autoplay_or_not' => '',
        'showslider_autoplay_or_not_mob' => '',
    );

    foreach ($optionget as $key_optionget => $value_optionget) {
       $fgw_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );
    }
}