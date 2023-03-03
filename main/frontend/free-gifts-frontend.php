<?php

if (!defined('ABSPATH')){
  exit;
}


function FGW_frontdesign() {
    global $post, $woocommerce,$fgw_comman;
    if($fgw_comman['fgw_rulepassed'] == TRUE) {
        echo FGW_free_item_slider( $post->ID );
    }
}

function FGW_frontdesign_checkout() {
    global $post, $woocommerce,$fgw_comman;
    if($fgw_comman['fgw_rulepassed']== TRUE) {
        echo FGW_free_item_slider_checkout( $post->ID );
    }
}

function FGW_gift_eligibility_message() {
    global $post, $woocommerce, $fgw_comman;
     

  

 


    if($fgw_comman['fgw_mtvtion_msg_enable'] == 'enable') {
        if($fgw_comman['fgw_rulepassed'] == FALSE) {

            $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
            if($fgw_gift_rule == 'custom') { 
            ?>
            <div class="woocommerce-notices-wrapper">
                <div class="woocommerce-message fgw_mwssagw_main" role="alert">
                    <p class="fgw_notice_msg"><?php echo  esc_attr($fgw_comman['fgw_rulepassed_motivation_message']);?></p>
                </div>
            </div>
            <?php
                echo do_shortcode('[products ids="'.esc_attr(implode(',',$fgw_comman['fgw_rulepassed_motivation_products'])).'" columns="4"]');
             
            } elseif($fgw_gift_rule == 'category') {
               ?>
                <div class="woocommerce-notices-wrapper">
                    <div class="woocommerce-message fgw_mwssagw_main" role="alert">
                        <p class="fgw_notice_msg"><?php echo wp_kses_post( $fgw_comman['fgw_rulepassed_motivation_message'] );?></p>
                    </div>
                </div>
                <?php
            } elseif($fgw_gift_rule == 'price') {
                ?>
                <div class="woocommerce-notices-wrapper">
                    <div class="woocommerce-message fgw_mwssagw_main" role="alert">
                        <p class="fgw_notice_msg"><?php echo esc_attr( $fgw_comman['fgw_rulepassed_motivation_message'] );?></p>
                    </div>
                </div>
                <?php
            }
        }
    }

    if($fgw_comman['fgw_rulepassed'] == TRUE) {

        if($fgw_comman['fgw_mtvtion_msg_enable'] == 'disable'){ ?>
            <div class="woocommerce-notices-wrapper">
                <div class="woocommerce-message" role="alert">
                    <p class="fgw_notice_msg"> <?php echo esc_attr($fgw_comman['fgw_eligiblity_message_final'] );?><a href="#" class="fgw_gift_btn button btn alt" style="font-weight: bold;"><?php echo esc_attr($fgw_comman['fgw_eligiblity_btn_text'] );?></a></p>
                </div>
            </div>
            <?php
        }else{
            if($fgw_comman['fgw_gift_disable'] == false && $fgw_comman['fgw_mtvtion_msg_enable'] == 'enable'){ ?>
                <div class="woocommerce-notices-wrapper">
                    <div class="woocommerce-message" role="alert">
                        <p class="fgw_notice_msg"><?php echo esc_attr( $fgw_comman['fgw_eligiblity_message_final'] );?><a href="#" class="fgw_gift_btn button btn alt" style="font-weight: bold;"><?php echo esc_attr($fgw_comman['fgw_eligiblity_btn_text'] );?></a></p>
                    </div>
                </div>
            <?php
            }
        }
    }
}


function FGW_free_item_slider($post_id) {
    echo FGW_common_function();
}

function FGW_free_item_slider_checkout($post_id) {
    echo FGW_common_function(true);
}

function FGW_common_function($ischeckout=false){
    global $fgw_comman;

   //maximum gift Quntity allow then disable product 
    
    //print_r($final_gift_array);
    ob_start();
   // print_r($quantity_gift);
    ?>
    <div class="fgw_gift fgw_gift_div">
        <p style="font-size: <?php echo esc_attr($fgw_comman['fgw_gift_title_font_size']); ?>px;">
            <?php _e( $fgw_comman['fgw_gift_title'] , 'woocommerce' ); ?>
        </p>
        <div class="fgw_gift_slider owl-carousel owl-theme">
            <?php
            if(!empty($fgw_comman['final_gift_array'])){
                foreach ($fgw_comman['final_gift_array'] as $value) {
                                            $productc = wc_get_product( $value );
                        if(!empty($productc)){
                            $title = $productc->get_name();?>
                            
                                <div class="item fgw_gift_product <?php if($fgw_comman['fgw_gift_disable'] == true) { echo ' fgw_disable'; }   if($fgw_comman['fgw_allow_multiple_gift']=="no" && in_array($value,$cart_products)){ echo ' fgw_disalalslas'; } ?> " >
                                    <a href="<?php echo get_permalink( $productc->get_id() ); ?>">
                                        <div><?php echo $productc->get_image();// phpcs:ignore WordPress.Security.EscapeOutput  ?></div>
                                        <div class="fgw_title"><?php echo esc_attr($title); ?></div>
                                        <div class="fgw_gift_atc_btn">
                                            <?php if(is_cart()) {?>
                                                <a href="<?php echo home_url(); ?>?action=fgw_giftred&redpage=cart&fgw_prod=<?php echo esc_attr($value); ?>" class="button alt">
                                                    <?php _e( $fgw_comman['fgw_add_to_cart_text'] , 'woocommerce' ); ?>
                                                </a>
                                            <?php }else{ ?>
                                                 <a href="<?php echo home_url(); ?>?action=fgw_giftred&redpage=checkout&fgw_prod=<?php echo esc_attr($value); ?>" class="button alt"><?php _e( $fgw_comman['fgw_add_to_cart_text'] , 'woocommerce' ); ?></a>
                                            <?php  } ?>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                    // }
                }
            }
            ?>
        </div>
    </div>
    <?php
    $slider = ob_get_clean();
    ob_start();
    ?>
    <div id="fgw_gifts_popup" class="fgw_gifts_popup_main">
        <div class="fgw_gifts_popup_overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <span class="fgw_gifts_popup_close">
                    <svg height="365.696pt" viewBox="0 0 365.696 365.696" width="365.696pt" xmlns="http://www.w3.org/2000/svg">
                        <path d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0"/>
                    </svg>
                </span>
            </div>
            <div class="modal-body">
                <div class="fgw_gift">
                    <p style="font-size: <?php echo esc_attr($fgw_comman['fgw_gift_title_font_size']); ?>px;"> <?php _e( $fgw_comman['fgw_gift_title'] , 'woocommerce' ); ?></p>
                    <div class="fgw_gift_slider_pp owl-carousel owl-theme">
                        <?php
                        if(!empty($fgw_comman['final_gift_array'])){
                            foreach ($fgw_comman['final_gift_array'] as $value) {
                                $productc = wc_get_product( $value );
                                if(!empty($productc)){
                                    $title = $productc->get_name(); ?>
                                    <div class="item fgw_gift_product <?php if($fgw_comman['fgw_gift_disable'] == true) { echo ' fgw_disable'; } if($fgw_comman['fgw_allow_multiple_gift']=="no" &&  in_array($value,$cart_products)){ echo ' fgw_disalalslas'; }  ?> ">
                                        <a href="<?php echo get_permalink( $productc->get_id() ); ?>">
                                            <div><?php echo $productc->get_image();// phpcs:ignore WordPress.Security.EscapeOutput  ?></div>
                                            <div class="fgw_title"><?php echo esc_attr($title); ?></div>
                                            <div class="fgw_gift_atc_btn">
                                                <?php if(is_cart()) {?>
                                                    <a href="<?php echo home_url(); ?>?action=fgw_giftred&redpage=cart&fgw_prod=<?php echo esc_attr($value); ?>" class="button alt">
                                                        <?php _e( $fgw_comman['fgw_add_to_cart_text'] , 'woocommerce' ); ?>
                                                    </a>
                                                <?php }else{ ?>
                                                     <a href="<?php echo home_url(); ?>?action=fgw_giftred&redpage=checkout&fgw_prod=<?php echo esc_attr($value); ?>" class="button alt"><?php _e( $fgw_comman['fgw_add_to_cart_text'] , 'woocommerce' ); ?></a>

                                                <?php  } ?>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $popup = ob_get_clean();

    if ($ischeckout == true) {

                         
        if ($fgw_comman['fgw_gift_prod_display_ckout'] == 'slider') {
            return $slider;
        }else{

            return $popup;
        }
    }else{
        if($fgw_comman['fgw_gift_prod_display'] == 'after_cart_table') { 
            return $slider;
        } else {
          
            return $popup;
        }
    }
}

function FGW_add_custom_price( $cart_object ) { 
   
    
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
    return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
    return;

    global $post, $woocommerce,$fgw_comman;

    echo FGW_setdefault_isgift_key($cart_object);
    $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
   
    //for multiple fule
  
    if($fgw_gift_rule == "custom") {
        //print_r($fgw_comman['fgw_rulepassed_arr']);
        if($fgw_comman['fgw_rulepassed'] == true){
            echo FGW_setfree_product($cart_object, $fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_custom'], $fgw_comman['fgw_rulepassed_arr']['allowed_custom']);
        }  

    }
    if($fgw_gift_rule == "price") {
        if($fgw_comman['fgw_rulepassed'] == true){
            echo FGW_setfree_product($cart_object, $fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_price'], $fgw_comman['fgw_rulepassed_arr']['allowed_price']);
        } 
        add_action( 'woocommerce_before_calculate_totals', 'FGW_add_custom_price' );
    }

    if($fgw_gift_rule == "category") {
       if($fgw_comman['fgw_rulepassed'] == true){
            echo FGW_setfree_product($cart_object, $fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_category'], $fgw_comman['fgw_rulepassed_arr']['allowed_category']);
        } 
    }
}

function FGW_setdefault_isgift_key($cart_object) {
    global $woocommerce, $fgw_comman;;


    foreach ( $cart_object->cart_contents as $key => $value ) {
        if(isset($value['isgift']) && $value['isgift'] == 'yes') {
            $woocommerce->cart->cart_contents[$key]['isgift'] = 'no';
        }

        $fgw_gift_remove_gift_items = $fgw_comman['fgw_gift_remove_gift_items'];
        if($fgw_gift_remove_gift_items == 'enable') {
            if(isset($value['isgift']) && $value['isgift'] == 'no') {
               WC()->cart->remove_cart_item( $key );
            }
        }
    }
}

function FGW_setfree_product($cart_object, $fgw_gift_combo, $fgw_maximum_gift) {
    global $woocommerce;
    $custom_price = 0;
    $d_qty = 0;
    $cart_totalss=0;
    foreach ( $cart_object->cart_contents as $key => $value ) {
        if($d_qty < $fgw_maximum_gift) {
            if($value['variation_id'] != 0) {
                if(in_array($value['variation_id'], $fgw_gift_combo)) {
                    $cart_totalss += $value['quantity'];
                    if($cart_totalss <= $fgw_maximum_gift){  
                        $value['data']->price = $custom_price;
                        $value['data']->set_price($custom_price);  
                        // $cart_object->set_quantity( $key, $new_qty );
                        $d_qty = $d_qty + 1;
                        $woocommerce->cart->cart_contents[$key]['isgift'] = 'yes';
                    } 
                } elseif (in_array($value['product_id'], $fgw_gift_combo)) {
                    $cart_totalss += $value['quantity'];
                    if($cart_totalss <= $fgw_maximum_gift){  
                        $value['data']->price = $custom_price;
                        $value['data']->set_price($custom_price);
                        $d_qty = $d_qty + 1;
                        $woocommerce->cart->cart_contents[$key]['isgift'] = 'yes';
                    }
                }
            } else {
                if(in_array($value['product_id'], $fgw_gift_combo)) {
                    $cart_totalss += $value['quantity'];
                    if($cart_totalss <= $fgw_maximum_gift){  
                        $value['data']->price = $custom_price;
                        $value['data']->set_price($custom_price);
                        $d_qty = $d_qty + 1;
                        $woocommerce->cart->cart_contents[$key]['isgift'] = 'yes';
                    }
                }
            }
        }
    }
    WC()->cart->set_session();
}

add_action('init','FGW_gift_item_load_actions_front');
function FGW_gift_item_load_actions_front(){
    global $fgw_comman;
    if($fgw_comman['fgw_gift_enable'] == 'enable' ) {
        if($fgw_comman['fgw_allow_only_logged_in'] == 'enable') {
            if(is_user_logged_in()) {
                add_action( 'woocommerce_after_cart_table',  'FGW_frontdesign' );
                add_action( 'woocommerce_before_calculate_totals',  'FGW_add_custom_price' );
                add_action( 'woocommerce_before_cart_table',  'FGW_gift_eligibility_message' );
                if($fgw_comman['fgw_ckout_enable'] == 'enable') {
                    add_action('woocommerce_before_checkout_form',  'FGW_gift_eligibility_message' );
                    add_action('woocommerce_before_checkout_form',  'FGW_frontdesign_checkout' );
                }                   
            }
        } else {
            add_action( 'woocommerce_after_cart_table',  'FGW_frontdesign' );
            add_action( 'woocommerce_before_calculate_totals',  'FGW_add_custom_price' );
            add_action('woocommerce_before_cart_table', 'FGW_gift_eligibility_message' );
            if($fgw_comman['fgw_ckout_enable'] == 'enable') {
                add_action('woocommerce_before_checkout_form',  'FGW_gift_eligibility_message' );
                add_action('woocommerce_before_checkout_form',  'FGW_frontdesign_checkout' );
            }
        }
    }
}