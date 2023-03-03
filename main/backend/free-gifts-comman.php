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
        'fgw_ckout_enable' => 'no',
        'fgw_gift_prod_display_ckout' => 'slider',
        'fgw_gift_title' => 'Select Your Gift',
        'fgw_gift_title_font_size' => '24',
        'fgw_gift_prod_txt_in_cart' => 'Gift Product',
        'fgw_gift_remove_gift_items' => 'enable',
        'fgw_allow_multiple_gift'=>'no',
        'fgw_gift_rule' => '',
        'fgw_allow_only_logged_in' => '',
        'fgw_allow_incluidve_tax' => 'no',
        'fgw_add_to_cart_text' => 'Add To Cart',
        'fgw_mtvtion_msg_enable' => 'enable',
        'fgw_prodrule_mtvtion_multi_msg' => 'You will be eligible When you add this product Quantity {minqty} to {maxqty} in your cart, you will get {allow_gift} products for gift.',
        'fgw_catrule_mtvtion_multi_msg' => 'You will be eligible When you add these {categories} categories product Quantity {minqty} to {maxqty} in your cart,you will get {allow_gift} products for Gift.',
        'fgw_pricerule_mtvtion_multi_msg' => 'You will be eligible When your cart total between {mincarttotal} to {maxcarttotal} , you will get {allow_gift} products for Gift.',
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

    $fgw_comman['minimum_custom'] = unserialize(get_option('minimum_custom'));
    $fgw_comman['maximum_custom'] = unserialize(get_option('maximum_custom'));
    $fgw_comman['allowed_custom'] = unserialize(get_option('allowed_custom'));
    $fgw_comman['fgw_combo_custom'] = unserialize(get_option('fgw_combo_custom'));
    $fgw_comman['fgw_gift_multiple_custom'] = unserialize(get_option('fgw_gift_multiple_custom'));


    $fgw_comman['minimum_price'] = unserialize(get_option('minimum_price'));
    $fgw_comman['maximum_price'] = unserialize(get_option('maximum_price'));
    $fgw_comman['allowed_price'] = unserialize(get_option('allowed_price'));
    $fgw_comman['fgw_gift_multiple_price'] = unserialize(get_option('fgw_gift_multiple_price'));


    $fgw_comman['minimum_category'] = unserialize(get_option('minimum_category'));
    $fgw_comman['maximum_category'] = unserialize(get_option('maximum_category'));
    $fgw_comman['allowed_category'] = unserialize(get_option('allowed_category'));
    $fgw_comman['fgw_select_cats_category'] = unserialize(get_option('fgw_select_cats_category'));
    $fgw_comman['fgw_gift_multiple_category'] = unserialize(get_option('fgw_gift_multiple_category'));
    

   

    
    
}

add_action( 'woocommerce_before_calculate_totals', 'FGW_wp_kama_woocommerce_init_action' );

function FGW_wp_kama_woocommerce_init_action(){
    global $fgw_comman;
     if(!is_admin()){
        $fgw_comman['fgw_rulepassed'] = false;
        $fgw_comman['fgw_rulepassed_motivation_message'] = '';
        $fgw_comman['fgw_eligiblity_message_final'] = '';
        $fgw_comman['fgw_rulepassed_motivation_products'] = array();
        //for product 
        if($fgw_comman['fgw_gift_rule']=='custom'){

            $fgw_comman['fgw_custom_arr'] = array();
            for($i=0; $i<count($fgw_comman['fgw_gift_multiple_custom']); $i++) {   
                $fgw_comman['fgw_custom_arr'][]= array(
                    'minimum_custom'=>$fgw_comman['minimum_custom'][$i],
                    'maximum_custom'=>$fgw_comman['maximum_custom'][$i],
                    'allowed_custom'=>$fgw_comman['allowed_custom'][$i],
                    'fgw_combo_custom'=>explode(",",$fgw_comman['fgw_combo_custom'][$i]),
                    'fgw_gift_multiple_custom'=>explode(",",$fgw_comman['fgw_gift_multiple_custom'][$i]),
                );
            }

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if($cart_item['variation_id'] != 0) {
                    $pid = $cart_item['variation_id'];
                } else {
                    $pid = $cart_item['product_id'];
                }
                foreach($fgw_comman['fgw_custom_arr'] as $fgw_custom_arr_key=>$fgw_custom_arr_val){
                    if(!empty($fgw_custom_arr_val['fgw_combo_custom'])){
                            if(in_array($pid, $fgw_custom_arr_val['fgw_combo_custom']) && 
                                $cart_item['quantity']>=$fgw_custom_arr_val['minimum_custom'] && 
                                $cart_item['quantity']<=$fgw_custom_arr_val['maximum_custom']) {
                                $fgw_comman['fgw_rulepassed'] = true;
                                $fgw_comman['fgw_rulepassed_arr'] = $fgw_custom_arr_val;
                                $fgw_comman['fgw_eligiblity_message_final'] = str_replace("{allowed_gifts}", $fgw_custom_arr_val['allowed_custom'],$fgw_comman['fgw_eligiblity_message']);
                            }else{
                                $fgw_pricerule_mtvtion_msg_final = $fgw_comman['fgw_prodrule_mtvtion_multi_msg'];
                                $fgw_prodrule_mtvtion_msg_final = str_replace("{minqty}", $fgw_custom_arr_val['minimum_custom'], $fgw_pricerule_mtvtion_msg_final);
                                $fgw_prodrule_mtvtion_msg_final = str_replace("{maxqty}", $fgw_custom_arr_val['maximum_custom'], $fgw_prodrule_mtvtion_msg_final);
                                $fgw_prodrule_mtvtion_msg_final = str_replace("{allow_gift}",$fgw_custom_arr_val['allowed_custom'], $fgw_prodrule_mtvtion_msg_final);
                                $fgw_comman['fgw_rulepassed_motivation_message'] = $fgw_prodrule_mtvtion_msg_final;
                                $fgw_comman['fgw_rulepassed_motivation_products'] = $fgw_custom_arr_val['fgw_combo_custom'];
                            }
                       
                    }
                }
                
            }
        }

        //for price 
        if($fgw_comman['fgw_gift_rule']=='price'){

            $fgw_comman['fgw_price_arr'] = array();
            for($i=0; $i<count($fgw_comman['fgw_gift_multiple_price']); $i++) {   
                $fgw_comman['fgw_price_arr'][]= array(
                    'minimum_price'=>$fgw_comman['minimum_price'][$i],
                    'maximum_price'=>$fgw_comman['maximum_price'][$i],
                    'allowed_price'=>$fgw_comman['allowed_price'][$i],
                    'fgw_gift_multiple_price'=>explode(",",$fgw_comman['fgw_gift_multiple_price'][$i]),
                );
            }
            $cart_total=0;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if($cart_item['variation_id'] != 0) {
                    $pid = $cart_item['variation_id'];
                } else {
                    $pid = $cart_item['product_id'];
                }
                if(!empty($cart_item['line_subtotal'])){
                    if($fgw_comman['fgw_allow_incluidve_tax'] == "enable"){
                        $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                    }else{
                        $cart_total += $cart_item['line_subtotal'];
                    }
                 }
            }
            foreach($fgw_comman['fgw_price_arr'] as $fgw_price_arr_key=>$fgw_price_arr_val){
                if(!empty($fgw_price_arr_val['fgw_gift_multiple_price'])){
                    if( $cart_total >= $fgw_price_arr_val['minimum_price']  &&  $cart_total <= $fgw_price_arr_val['maximum_price'] ){
                        $fgw_comman['fgw_rulepassed'] = true;
                        $fgw_comman['fgw_rulepassed_arr'] = $fgw_price_arr_val;
                        $fgw_comman['fgw_eligiblity_message_final'] = str_replace("{allowed_gifts}", $fgw_price_arr_val['allowed_price'],$fgw_comman['fgw_eligiblity_message']);
                    }else{
                        $fgw_pricerule_mtvtion_msg_final = $fgw_comman['fgw_pricerule_mtvtion_multi_msg'];
                        $fgw_pricerule_mtvtion_msg_final = str_replace("{mincarttotal}", $fgw_price_arr_val['minimum_price'], $fgw_pricerule_mtvtion_msg_final);
                        $fgw_pricerule_mtvtion_msg_final = str_replace("{maxcarttotal}", $fgw_price_arr_val['maximum_price'], $fgw_pricerule_mtvtion_msg_final);
                        $fgw_pricerule_mtvtion_msg_final = str_replace("{allow_gift}", $fgw_price_arr_val['allowed_price'], $fgw_pricerule_mtvtion_msg_final);
                        $fgw_comman['fgw_rulepassed_motivation_message'] = $fgw_pricerule_mtvtion_msg_final;
                    }
                }
            }
        }
        //for category
        if($fgw_comman['fgw_gift_rule']=='category'){

            $fgw_comman['fgw_category_arr'] = array();
            for($i=0; $i<count($fgw_comman['fgw_gift_multiple_category']); $i++) {   
                $fgw_comman['fgw_category_arr'][]= array(
                    'minimum_category'=>$fgw_comman['minimum_category'][$i],
                    'maximum_category'=>$fgw_comman['maximum_category'][$i],
                    'allowed_category'=>$fgw_comman['allowed_category'][$i],
                    'fgw_gift_multiple_category'=>explode(",",$fgw_comman['fgw_gift_multiple_category'][$i]),
                    'fgw_select_cats_category'=>explode(",",$fgw_comman['fgw_select_cats_category'][$i]),
                );
            }
            $cart_total_qty_count=0;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                if($cart_item['variation_id'] != 0) {
                    $pid = $cart_item['variation_id'];
                } else {
                    $pid = $cart_item['product_id'];
                }
                foreach($fgw_comman['fgw_category_arr'] as $fgw_category_arr_key=>$fgw_category_arr_val){
                    if(!empty($fgw_category_arr_val['fgw_gift_multiple_category'])){

                        $terms = get_the_terms ($cart_item['product_id'],'product_cat');
                        foreach ($terms as $key => $value) {
                            if(!empty($fgw_category_arr_val['fgw_select_cats_category'])){
                                if (in_array($value->term_id, $fgw_category_arr_val['fgw_select_cats_category'])) {
                                    $cart_total_qty_count += $cart_item['quantity'];

                                }
                            }
                        }
                    }
                }
            }
            foreach($fgw_comman['fgw_category_arr'] as $fgw_category_arr_key=>$fgw_category_arr_val){
                if(!empty($fgw_category_arr_val['fgw_gift_multiple_category']) && !empty($fgw_category_arr_val['fgw_select_cats_category']) ){
                    if( $cart_total_qty_count >= $fgw_category_arr_val['minimum_category']  &&  $cart_total_qty_count <= $fgw_category_arr_val['maximum_category'] ){
                        $fgw_comman['fgw_rulepassed'] = true;
                        $fgw_comman['fgw_rulepassed_arr'] = $fgw_category_arr_val;
                        $fgw_comman['fgw_eligiblity_message_final'] = str_replace("{allowed_gifts}", $fgw_category_arr_val['allowed_category'],$fgw_comman['fgw_eligiblity_message']);
                    }else{
                        $fgw_catrule_mtvtion_msg_final = $fgw_comman['fgw_catrule_mtvtion_multi_msg'];
                        $cat_list = array();
                        foreach ($fgw_category_arr_val['fgw_select_cats_category'] as $key => $value) {
                            $term = get_term_by( 'id', $value, 'product_cat' );
                            $term_link = get_term_link( $term->slug, 'product_cat' );
                            $cat_list[] = "<a href='".$term_link."' target='_blank'>".$term->name."</a>";
                        }

                        $cat_list = implode(', ', $cat_list);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{minqty}", $fgw_category_arr_val['minimum_category'], $fgw_catrule_mtvtion_msg_final);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{maxqty}", $fgw_category_arr_val['maximum_category'], $fgw_catrule_mtvtion_msg_final);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{categories}", $cat_list, $fgw_catrule_mtvtion_msg_final);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{allow_gift}", $fgw_category_arr_val['allowed_category'], $fgw_catrule_mtvtion_msg_final);
                        $fgw_comman['fgw_rulepassed_motivation_message'] = $fgw_catrule_mtvtion_msg_final;
                    }
                }
            }
        }


        // quantity_gift
        $fgw_comman['fgw_quantity_gift'] = 0;
        $fgw_comman['fgw_gift_disable'] = false;
        foreach( WC()->cart->get_cart() as $cart_item ) {
            if(!empty($cart_item['isgift'])){
                if($cart_item['isgift'] == 'yes'){
                    $fgw_comman['fgw_quantity_gift'] +=$cart_item['quantity'];
                }
            }
        }
        if(!empty($fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_custom'])){
            $fgw_comman['final_gift_array'] = $fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_custom'];
            $fgw_comman['fgw_maximum_gift'] = $fgw_comman['fgw_rulepassed_arr']['allowed_custom'];
        }
        if(!empty($fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_price'])){
            $fgw_comman['final_gift_array']  = $fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_price'];
            $fgw_comman['fgw_maximum_gift'] = $fgw_comman['fgw_rulepassed_arr']['allowed_price'];
        }
        if(!empty($fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_category'])){
            $fgw_comman['final_gift_array']  = $fgw_comman['fgw_rulepassed_arr']['fgw_gift_multiple_category'];
            $fgw_comman['fgw_maximum_gift'] = $fgw_comman['fgw_rulepassed_arr']['allowed_category'];
        }
        if(!empty($fgw_comman['fgw_quantity_gift'])){
            if($fgw_comman['fgw_quantity_gift'] >= $fgw_comman['fgw_maximum_gift'] ){
                $fgw_comman['fgw_gift_disable'] = true;
            }
        }





    }
}