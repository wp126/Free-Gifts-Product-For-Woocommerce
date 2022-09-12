<?php

if (!defined('ABSPATH')){
  exit;
}


function FGW_frontdesign() {
    global $post, $woocommerce;
    if(FGW_gift_cart_rule_pass() == TRUE) {
        echo FGW_free_item_slider( $post->ID );
    }
}

function FGW_frontdesign_checkout() {
    global $post, $woocommerce;
    if(FGW_gift_cart_rule_pass() == TRUE) {
        echo FGW_free_item_slider_checkout( $post->ID );
    }
}

function FGW_gift_eligibility_message() {
    global $post, $woocommerce, $fgw_comman;
    $fgw_eligiblity_btn_text = $fgw_comman['fgw_eligiblity_btn_text'];
    $fgw_eligiblity_message = $fgw_comman['fgw_eligiblity_message'];
    $fgw_combo = get_option('fgw_combo' );
    $productsa = get_option('fgw_gift_multiple' );
    $minimum = get_option('minimum', '1');
    $maximum = get_option('maximum', '1');
    $allowed = get_option('allowed', '1');
    $table_minimum = unserialize($minimum);
    $table_maximum = unserialize($maximum);
    $table_allowed = unserialize($allowed);
    $table_product_multiple = unserialize($productsa);
    $combo_rule_qty = 0;
    $prod_line = 0;
    $cart_total=0;
    $cart_product = array();
    $fgw_allow_incluidve_tax = $fgw_comman['fgw_allow_incluidve_tax'];
    $cart_products = array();
    $fgw_gift_disable = 'false';
    $combo_rule_conditoin= 0;
    $fgw_combo_cat = get_option('fgw_cats_select2' );
    $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
    $quantity_gift=0;

    foreach( WC()->cart->get_cart() as $cart_item ) {
        if(!empty($cart_item['isgift'])){
            if($cart_item['isgift'] == 'yes'){
                $quantity_gift +=$cart_item['quantity'];
            }
        }
        $product_id = $cart_item['product_id'];
        $product = wc_get_product( $product_id );

        //for multiple rule 
        if($product->get_type() == 'variable') {
            $product_id = $cart_item['variation_id'];
        }else{
            $product_id = $cart_item['product_id'];
        }

        if($fgw_gift_rule == "category"){
            $terms = get_the_terms ( $cart_item['product_id'], 'product_cat');
            foreach ($terms as $key => $value) {
                if(!empty($fgw_combo_cat)){
                    if (in_array($value->term_id, $fgw_combo_cat)) {
                        $combo_rule_conditoin += $cart_item['quantity'];
                    }
                }
            }
        }else if($fgw_gift_rule == "custom"){
            if(!empty($fgw_combo)){
                if(in_array($product_id, $fgw_combo)) {
                    $combo_rule_conditoin += $cart_item['quantity'];
                }
            }
        }elseif($fgw_gift_rule == "price" ){
            if($fgw_allow_incluidve_tax == "enable"){
                $combo_rule_conditoin += $cart_item['line_subtotal']+$cart_item['line_tax'];
            }else{
                $combo_rule_conditoin += $cart_item['line_subtotal'];
            }
        }

        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                if( $combo_rule_conditoin >= $gift_value && $combo_rule_conditoin <= $table_maximum[$gift_key] ){
                    $multiplegift_product_id = explode(",",$table_product_multiple[$gift_key]);
                    $final_gift_array = $multiplegift_product_id;
                    $fgw_maximum_gift =  $table_allowed[$gift_key];
                }
            }
        }
    }            
    
    //maximum gift Quntity allow then disable product 
    if(!empty($quantity_gift)){
        if($quantity_gift >= $fgw_maximum_gift){
            $fgw_gift_disable = 'true';
        }
    }

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if($cart_item['variation_id'] != 0) {
            $pid = $cart_item['variation_id'];
        } else {
            $pid = $cart_item['product_id'];
        }

        if(!empty($fgw_combo)){
            if(in_array($pid, $fgw_combo)) {
                if(!empty($cart_item['line_subtotal'])){
                    if($fgw_allow_incluidve_tax == "enable"){
                        $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                    }else{
                        $cart_total += $cart_item['line_subtotal'];
                    }
                }
                $combo_rule_qty += $cart_item['quantity'];
                $prod_line += 1;
            }
        }
    }

    //$fgw_min_cart_qty = $fgw_comman['fgw_min_cart_qty'];

    //for multiple rule
    $fgw_gift_multiple = get_option('fgw_gift_multiple');
    $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
    if (!empty($table_minimum) && !empty($table_maximum)){
        foreach ($table_minimum as $gift_key => $gift_value) {
            if( $combo_rule_qty >= $gift_value && $combo_rule_qty <= $table_maximum[$gift_key] ){
                $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]);
                $fgw_maximum_gift =  $table_allowed[$gift_key];
            }
        }
    }


    $fgw_mtvtion_msg_enable = $fgw_comman['fgw_mtvtion_msg_enable'];
    $minimum = get_option('minimum', '1');
    $maximum = get_option('maximum', '1');
    $allowed = get_option('allowed', '1');
    $table_minimum = unserialize($minimum);
    $table_maximum = unserialize($maximum);
    $table_allowed = unserialize($allowed);

    if($fgw_mtvtion_msg_enable == 'enable') {
        if(FGW_gift_cart_rule_pass() == FALSE) {
            $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
            if($fgw_gift_rule == 'custom') { 
                $fgw_gift_parents = get_option('fgw_combo');

                if(!empty($fgw_gift_parents )) {
                    $fgw_gfpar_str = implode(", ",$fgw_gift_parents);

                    foreach ($table_minimum as $key => $value) {
                        $fgw_pricerule_mtvtion_msg_final = $fgw_comman['fgw_prodrule_mtvtion_multi_msg'];
                        $fgw_prodrule_mtvtion_msg_final = str_replace("{minqty}", $value, $fgw_pricerule_mtvtion_msg_final);
                        $fgw_prodrule_mtvtion_msg_final = str_replace("{maxqty}", $table_maximum[$key], $fgw_prodrule_mtvtion_msg_final);
                        $fgw_prodrule_mtvtion_msg_final = str_replace("{allow_gift}", $table_allowed[$key], $fgw_prodrule_mtvtion_msg_final);
                        ?>
                        <div class="woocommerce-notices-wrapper">
                            <div class="woocommerce-message fgw_mwssagw_main" role="alert">
                                <p class="fgw_notice_msg"><?php echo  esc_attr($fgw_prodrule_mtvtion_msg_final);?></p>
                            </div>
                        </div>
                        <?php
                    }
                    echo do_shortcode('[products ids="'.esc_attr($fgw_gfpar_str).'" columns="4"]');
                }
            } elseif($fgw_gift_rule == 'category') {
                $appended_terms = get_option('fgw_cats_select2');

                if(!empty($appended_terms)) {
                    $cat_list = array();
                    foreach ($appended_terms as $key => $value) {
                        $term = get_term_by( 'id', $value, 'product_cat' );
                        $term_link = get_term_link( $term->slug, 'product_cat' );
                        $cat_list[] = "<a href='".$term_link."' target='_blank'>".$term->name."</a>";
                    }

                    $cat_list = implode(', ', $cat_list);

                    foreach ($table_minimum as $key => $value) {
                        $fgw_catrule_mtvtion_msg_final = $fgw_comman['fgw_catrule_mtvtion_multi_msg'];
                        $fgw_catrule_mtvtion_msg_final = str_replace("{minqty}", $value, $fgw_catrule_mtvtion_msg_final);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{maxqty}", $table_maximum[$key], $fgw_catrule_mtvtion_msg_final);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{categories}", $cat_list, $fgw_catrule_mtvtion_msg_final);
                        $fgw_catrule_mtvtion_msg_final = str_replace("{allow_gift}", $table_allowed[$key], $fgw_catrule_mtvtion_msg_final);
                        ?>
                        <div class="woocommerce-notices-wrapper">
                            <div class="woocommerce-message fgw_mwssagw_main" role="alert">
                                <p class="fgw_notice_msg"><?php echo esc_attr($fgw_catrule_mtvtion_msg_final );?></p>
                            </div>
                        </div>
                        <?php
                    }
                }
            } elseif($fgw_gift_rule == 'price') {

                foreach ($table_minimum as $key => $value) {
          
                    $fgw_pricerule_mtvtion_msg_final = $fgw_comman['fgw_pricerule_mtvtion_multi_msg'];
                    $fgw_pricerule_mtvtion_msg_final = str_replace("{mincarttotal}", $value, $fgw_pricerule_mtvtion_msg_final);
                    $fgw_pricerule_mtvtion_msg_final = str_replace("{maxcarttotal}", $table_maximum[$key], $fgw_pricerule_mtvtion_msg_final);
                    $fgw_pricerule_mtvtion_msg_final = str_replace("{allow_gift}", $table_allowed[$key], $fgw_pricerule_mtvtion_msg_final);
                    ?>
                    <div class="woocommerce-notices-wrapper">
                        <div class="woocommerce-message fgw_mwssagw_main" role="alert">
                            <p class="fgw_notice_msg"><?php echo esc_attr( $fgw_pricerule_mtvtion_msg_final );?></p>
                        </div>
                    </div>
                    <?php
                }
            }
        }
    }

    if(FGW_gift_cart_rule_pass() == TRUE) {
        $fgw_eligiblity_message_final = str_replace("{allowed_gifts}", $fgw_maximum_gift, $fgw_eligiblity_message);
   
        if($fgw_comman['fgw_mtvtion_msg_enable'] == 'disable'){ ?>
            <div class="woocommerce-notices-wrapper">
                <div class="woocommerce-message" role="alert">
                    <p class="fgw_notice_msg"> <?php echo esc_attr($fgw_eligiblity_message_final );?><a href="#" class="fgw_gift_btn button btn alt" style="font-weight: bold;"><?php echo esc_attr($fgw_eligiblity_btn_text );?></a></p>
                </div>
            </div>
            <?php
        }else{
            if($fgw_gift_disable == 'false' && $fgw_comman['fgw_mtvtion_msg_enable'] == 'enable'){ ?>
                <div class="woocommerce-notices-wrapper">
                    <div class="woocommerce-message" role="alert">
                        <p class="fgw_notice_msg"><?php echo esc_attr( $fgw_eligiblity_message_final );?><a href="#" class="fgw_gift_btn button btn alt" style="font-weight: bold;"><?php echo esc_attr($fgw_eligiblity_btn_text );?></a></p>
                    </div>
                </div>
            <?php
            }
        }
    }
}

function FGW_gift_cart_rule_pass() {
    global $post, $woocommerce, $fgw_comman;

    $rule_passed = FALSE;
    $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
    
    $fgw_allow_incluidve_tax = $fgw_comman['fgw_allow_incluidve_tax'];
    

    $fgw_gift_combo = get_option( 'fgw_gift_multiple' );
    $fgw_gift_combo = unserialize($fgw_gift_combo);

    if($fgw_gift_combo == '') {
        $fgw_gift_combo = array();
    }

    $minimum = get_option('minimum', '1');
    $maximum = get_option('maximum', '1');
    $allowed = get_option('allowed', '1');
    $table_minimum = unserialize($minimum);
    $table_maximum = unserialize($maximum);
    $table_allowed = unserialize($allowed);
    $prod_line_count = count(WC()->cart->get_cart());
    $cart_total_qty_count = WC()->cart->get_cart_contents_count();

    if($fgw_gift_rule == "custom") {

        $fgw_combo = get_option( 'fgw_combo' );
        $combo_rule_qty = 0;
        $prod_line = 0;
        $cart_total=0;
        $cart_product = array();
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if($cart_item['variation_id'] != 0) {
                $pid = $cart_item['variation_id'];
            } else {
                $pid = $cart_item['product_id'];
            }
            if(!in_array($pid, $fgw_gift_combo)) {
                if(!empty($fgw_combo)){
                    if(in_array($pid, $fgw_combo)) {
                        $combo_rule_qty += $cart_item['quantity'];
                        $prod_line += 1;
                        if(!empty($cart_item['line_subtotal'])){
                            if($fgw_allow_incluidve_tax == "enable"){
                                $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                            }else{
                                $cart_total += $cart_item['line_subtotal'];
                            }
                        }
                    }
                }
            }
        }

        foreach ($table_minimum as $gift_key => $gift_value) {
            if( $combo_rule_qty >= $gift_value  &&  $combo_rule_qty <= $table_maximum[$gift_key] ){

                $rule_passed = TRUE;
            }
        }
    }

    if($fgw_gift_rule == "price") {
      
        $cart_total = 0;
        $pline = 0;
        $pqty = 0;
        $cart_total=0;

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if($cart_item['variation_id'] != 0) {
                $pid = $cart_item['variation_id'];
            } else {
                $pid = $cart_item['product_id'];
            }
            $fgw_gift_multiple = get_option('fgw_gift_multiple');
            $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
            if(!in_array($pid,$fgw_gift_multiple_combo)) {
                if(!empty($cart_item['line_subtotal'])){
                    if($fgw_allow_incluidve_tax == "enable"){
                        $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                    }else{
                        $cart_total += $cart_item['line_subtotal'];
                    }
                }
            }
        }
        
        $fgw_gift_multiple = get_option('fgw_gift_multiple');
        $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                if( $cart_total >= $gift_value  &&  $cart_total <= $table_maximum[$gift_key] ){
                    $fgw_maximum_gift =  $table_allowed[$gift_key];
                    $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]); 
                    $rule_passed = TRUE;
                }
            }
        }
    }

    if($fgw_gift_rule == "category") {

        $fgw_cat = get_option( 'fgw_cats_select2' );
        $cart_total_qty_count = 0;
        $prod_line_count = 0;
        $cart_total = 0;

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if($cart_item['variation_id'] != 0) {
                $pid = $cart_item['variation_id'];
            } else {
                $pid = $cart_item['product_id'];
            }
            
            if(!in_array($pid, $fgw_gift_combo)) {
                $terms = get_the_terms ($cart_item['product_id'],'product_cat');
                foreach ($terms as $key => $value) {

                    if(!empty($fgw_cat)){

                        if (in_array($value->term_id, $fgw_cat)) {
                            $cart_total_qty_count += $cart_item['quantity'];

                            if(!empty($cart_item['line_subtotal'])){
                                if($fgw_allow_incluidve_tax == "enable"){
                                    $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                                }else{
                                    $cart_total += $cart_item['line_subtotal'];
                                }
                            }
                            $prod_line_count += 1;
                        }
                    }
                }
            }
        }

        foreach ($table_minimum as $gift_key => $gift_value) {
            if( $cart_total_qty_count >= $gift_value  &&  $cart_total_qty_count <= $table_maximum[$gift_key] ){
                $rule_passed = TRUE;
            }
        }
    }
    return $rule_passed;
}

function FGW_free_item_slider($post_id) {
    echo FGW_common_function();
}

function FGW_free_item_slider_checkout($post_id) {
    echo FGW_common_function(true);
}

function FGW_common_function($ischeckout=false){
    global $fgw_comman;

    //for single rule
    $minimum = get_option('minimum', '1');
    $maximum = get_option('maximum', '1');
    $allowed = get_option('allowed', '1');

    //for multiple  rule 
    $productsa = get_option('fgw_gift_multiple');
    $table_minimum = unserialize($minimum);
    $table_maximum = unserialize($maximum);
    $table_allowed = unserialize($allowed);
    $table_product_multiple = unserialize($productsa);
    $fgw_allow_incluidve_tax = $fgw_comman['fgw_allow_incluidve_tax'];

    //for both rule 
    $cart_products = array();
    $fgw_gift_disable = 'false';
    $combo_rule_conditoin= 0;
    $fgw_combo = get_option( 'fgw_combo' );
    $fgw_combo_cat = get_option( 'fgw_cats_select2' );
    $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
    $quantity_gift=0;
        
    foreach( WC()->cart->get_cart() as $cart_item ) {
        if(!empty($cart_item['isgift'])){
            if($cart_item['isgift'] == 'yes'){
                $quantity_gift +=$cart_item['quantity'];
            }
        }

        $product_id = $cart_item['product_id'];
        $product = wc_get_product( $product_id );

        //for multiple rule 
        if($product->get_type() == 'variable') {
            $product_id = $cart_item['variation_id'];
        }else{
            $product_id = $cart_item['product_id'];
        }

        if($fgw_gift_rule == "category"){
            $terms = get_the_terms ( $cart_item['product_id'], 'product_cat');
            foreach ($terms as $key => $value) {

                if(!empty($fgw_combo_cat)){

                    if (in_array($value->term_id, $fgw_combo_cat)) {
                        $combo_rule_conditoin += $cart_item['quantity'];
                    }
                }
            }
        }else if($fgw_gift_rule == "custom"){
            if(!empty($fgw_combo)){
                if(in_array($product_id, $fgw_combo)) {
                    $combo_rule_conditoin += $cart_item['quantity'];
                }
            }                          
        }elseif($fgw_gift_rule == "price" ){
            if($fgw_allow_incluidve_tax == "enable"){
                $combo_rule_conditoin += $cart_item['line_subtotal']+$cart_item['line_tax'];
            }else{
                $combo_rule_conditoin += $cart_item['line_subtotal'];
            }
        }

        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                if( $combo_rule_conditoin >= $gift_value && $combo_rule_conditoin <= $table_maximum[$gift_key] ){
                    $multiplegift_product_id = explode(",",$table_product_multiple[$gift_key]);
                    $final_gift_array = $multiplegift_product_id;
                    $fgw_maximum_gift =  $table_allowed[$gift_key];
                }
            }
        }
        $cart_products[] = $product_id;
    }

    //maximum gift Quntity allow then disable product 
    if(!empty($quantity_gift)){
        if($quantity_gift >= $fgw_maximum_gift ){
            $fgw_gift_disable = 'true';
        }
    }

    ob_start();
    ?>
    <div class="fgw_gift fgw_gift_div">
        <p style="font-size: <?php echo esc_attr($fgw_comman['fgw_gift_title_font_size']); ?>px;">
            <?php _e( $fgw_comman['fgw_gift_title'] , 'woocommerce' ); ?>
        </p>
        <div class="fgw_gift_slider owl-carousel owl-theme">
            <?php
            if(!empty($final_gift_array)){
                foreach ($final_gift_array as $value) {
                                            $productc = wc_get_product( $value );
                        if(!empty($productc)){
                            $title = $productc->get_name();?>
                            
                                <div class="item fgw_gift_product <?php if($fgw_gift_disable == 'true') { echo ' fgw_disable'; }   if($fgw_comman['fgw_allow_multiple_gift']=="no" && in_array($value,$cart_products)){ echo ' fgw_disalalslas'; } ?> " >
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
                        if(!empty($final_gift_array)){
                            foreach ($final_gift_array as $value) {
                                $productc = wc_get_product( $value );
                                if(!empty($productc)){
                                    $title = $productc->get_name(); ?>
                                    <div class="item fgw_gift_product <?php if($fgw_gift_disable == 'true') { echo ' fgw_disable'; } if($fgw_comman['fgw_allow_multiple_gift']=="no" &&  in_array($value,$cart_products)){ echo ' fgw_disalalslas'; }  ?> ">
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
    global $fgw_comman;
    
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
    return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
    return;

    global $post, $woocommerce;

    echo FGW_setdefault_isgift_key($cart_object);
    $fgw_gift_rule = $fgw_comman['fgw_gift_rule'];
   
    //for multiple fule
    $minimum = get_option('minimum', '1');
    $maximum = get_option('maximum', '1');
    $allowed = get_option('allowed', '1');
    $table_minimum = unserialize($minimum);
    $table_maximum = unserialize($maximum);
    $table_allowed = unserialize($allowed);
    $prod_line_count = count(WC()->cart->get_cart());
    $cart_total_qty_count = WC()->cart->get_cart_contents_count();
    $fgw_allow_incluidve_tax = $fgw_comman['fgw_allow_incluidve_tax'];

    if($fgw_gift_rule == "custom") {
        $fgw_combo = get_option( 'fgw_combo' );
        $combo_rule_qty = 0;
        $prod_line = 0;
        $cart_total=0;
        $cart_product = array();
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

            if($cart_item['variation_id'] != 0) {
                $pid = $cart_item['variation_id'];
            } else {
                $pid = $cart_item['product_id'];
            }

            if(!empty($fgw_combo)){
                if(in_array($pid, $fgw_combo)) {
                    if(!empty($cart_item['line_subtotal'])){
                        if($fgw_allow_incluidve_tax == "enable"){
                            $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                        }else{
                            $cart_total += $cart_item['line_subtotal'];
                        }
                    }
                    $combo_rule_qty += $cart_item['quantity'];
                    $prod_line += 1;
                }
            }
        }

        //for multiple rule
        $fgw_gift_multiple = get_option('fgw_gift_multiple');
        $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                if( $combo_rule_qty >= $gift_value && $combo_rule_qty <= $table_maximum[$gift_key] ){
                    $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]);
                    $fgw_maximum_gift =  $table_allowed[$gift_key];
                    echo FGW_setfree_product($cart_object, $fgw_gift_combo, $fgw_maximum_gift);
                }
            }
        }               
    }


    if($fgw_gift_rule == "price") {
        $cart_total = 0;
        $pline = 0;
        $pqty = 0;
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if($cart_item['variation_id'] != 0) {
                $pid = $cart_item['variation_id'];
            } else {
                $pid = $cart_item['product_id'];
            }

            //for multiple rule                        
            $fgw_gift_multiple = get_option('fgw_gift_multiple');
            $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
            if (!empty($table_minimum) && !empty($table_maximum)){
                foreach ($table_minimum as $gift_key => $gift_value) {
                    $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]);
                }
            }

            if(!empty($fgw_gift_combo)){
                if(!in_array($pid, $fgw_gift_combo)) {
                    if(!empty($cart_item['line_subtotal'])){
                        if($fgw_allow_incluidve_tax == "enable"){
                            $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                        }else{
                            $cart_total += $cart_item['line_subtotal'];
                        }
                    }
                }
            }
        }

        //for multiple rule
        $fgw_gift_multiple = get_option('fgw_gift_multiple');
        $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                if( $cart_total >= $gift_value  &&  $cart_total <= $table_maximum[$gift_key] ){
                    $fgw_maximum_gift =  $table_allowed[$gift_key];
                    $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]); 
                    echo FGW_setfree_product($cart_object, $fgw_gift_combo, $fgw_maximum_gift);
                }
            }
        }
        add_action( 'woocommerce_before_calculate_totals', 'FGW_add_custom_price' );
    }

    if($fgw_gift_rule == "category") {
        $fgw_cat = get_option( 'fgw_cats_select2' );
        $cart_total_qty_count = 0;
        $prod_line_count = 0;
        $cart_total = 0;

        //for multiple rule
        $fgw_gift_multiple = get_option('fgw_gift_multiple');
        $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]); 
            }
        }

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            if($cart_item['variation_id'] != 0) {
                $pid = $cart_item['variation_id'];
            } else {
                $pid = $cart_item['product_id'];
            }

            if(!in_array($pid, $fgw_gift_combo)) {
                $terms = get_the_terms ( $cart_item['product_id'], 'product_cat' );
                foreach ($terms as $key => $value) {
                    if(!empty($fgw_cat)){
                        if (in_array($value->term_id, $fgw_cat)) {
                            $cart_total_qty_count += $cart_item['quantity'];
                            $prod_line_count += 1;
                            if(!empty($cart_item['line_subtotal'])){
                                if($fgw_allow_incluidve_tax == "enable"){
                                    $cart_total += $cart_item['line_subtotal']+$cart_item['line_tax'];
                                }else{
                                    $cart_total += $cart_item['line_subtotal'];
                                }
                            }
                        }
                    }
                }
            }
        }

        //for multiple rule
        $fgw_gift_multiple = get_option('fgw_gift_multiple');
        $fgw_gift_multiple_combo = unserialize($fgw_gift_multiple);
        if (!empty($table_minimum) && !empty($table_maximum)){
            foreach ($table_minimum as $gift_key => $gift_value) {
                if( $cart_total_qty_count >= $gift_value  &&  $cart_total_qty_count <= $table_maximum[$gift_key] ){
                    $fgw_maximum_gift =  $table_allowed[$gift_key];
                    $fgw_gift_combo = explode(",",$fgw_gift_multiple_combo[$gift_key]); 
                    echo FGW_setfree_product($cart_object, $fgw_gift_combo, $fgw_maximum_gift);
                }
            }
        }
    }
}

function FGW_setdefault_isgift_key($cart_object) {
    global $woocommerce, $fgw_comman;;

/*echo "<pre>";
    print_r($cart_object->cart_contents);
    echo "</pre>";*/
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
   /* echo "<pre>";
    print_r($cart_object->cart_contents);
    echo "</pre>";*/
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