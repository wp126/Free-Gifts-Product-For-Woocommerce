<?php

if (!defined('ABSPATH')){
  exit;
}

add_action('admin_menu', 'FGW_create_menu');
function FGW_create_menu() {
	add_menu_page('Woocommerce Gift', 'Woo Gift', 'manage_options', 'free_gift', 'FGW_free_contain');
}

function FGW_free_contain() {
  global $fgw_comman;
 	?>
 	<div class="fgw_container">
 		<div class="wrap">
      <h2><?php echo __("Free Gift Settings","free-gifts-for-woocommerce");?></h2>
      <div class="card fgw_notice">
          <h2><?php echo __('Please help us spread the word & keep the plugin up-to-date', 'free-gifts-for-woocommerce');?></h2>
          <p>
              <a class="button-primary button" title="<?php echo __('Support Free Gifts Product', 'free-gifts-for-woocommerce');?>" target="_blank" href="https://www.plugin999.com/support/"><?php echo __('Support', 'free-gifts-for-woocommerce'); ?></a>
              <a class="button-primary button" title="<?php echo __('Rate Free Gifts Product', 'free-gifts-for-woocommerce');?>" target="_blank" href="https://wordpress.org/support/plugin/free-gifts-product-for-woocommerce/reviews/?filter=5"><?php echo __('Rate the plugin ★★★★★', 'free-gifts-for-woocommerce'); ?></a>
          </p>
      </div>
      <?php if(isset($_REQUEST['message'])  && $_REQUEST['message'] == 'success'){ ?>
          <div class="notice notice-success is-dismissible"> 
              <p><strong><?php echo __( 'Setting Saved successfully.', 'free-gifts-for-woocommerce' );?></strong></p>
          </div>
      <?php } ?>
   		<form method="post">
   			<?php wp_nonce_field( 'FGW_meta_save', 'FGW_meta_save_nounce' ); ?>
        <div id="poststuff">
        	<ul class="nav-tab-wrapper woo-nav-tab-wrapper">
         		<li class="nav-tab nav-tab-active" data-tab="tab-default">
          		<?php echo __( 'Gift Rules', 'free-gifts-for-woocommerce' ); ?>
         		</li>
         		<li class="nav-tab" data-tab="tab-general">
          		<?php echo __( 'Other Settings', 'free-gifts-for-woocommerce' ); ?>
         		</li>
        	</ul>
        	<div id="tab-default" class="tab-content current">
            <div class="postbox">
              <div class="postbox-header">
                <h2><?php echo __( 'General Settings', 'free-gifts-for-woocommerce' ); ?></h2>
              </div>
              <div class="inside">
                <table>
                  <tr>
                    <th>
                      <?php echo __( 'Enable Plugin', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <input type="checkbox" name="fgw_comman[fgw_gift_enable]" value="enable" <?php if($fgw_comman['fgw_gift_enable'] == 'enable' ) { echo 'checked'; } ?>>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Gift Products Display Type Cart Page', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <input type="radio" name="fgw_comman[fgw_gift_prod_display]" value="after_cart_table" <?php if($fgw_comman['fgw_gift_prod_display'] == 'after_cart_table' ) { echo 'checked'; } ?>>After Cart Table
                      <input type="radio" name="fgw_comman[fgw_gift_prod_display]" value="popup" <?php if($fgw_comman['fgw_gift_prod_display'] == 'popup' ) { echo 'checked'; } ?>>Popup
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Enable Gift Products on Checkout Page', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <input type="checkbox" name="fgw_comman[fgw_ckout_enable]" class="fgw_ckout_enable_cls" value="no" disabled>
                      <label class="fgw_comman_link"><?php echo __( 'Only available in pro version ', 'free-gifts-for-woocommerce' ); ?><a href="https://www.plugin999.com/plugin/free-gifts-product-for-woocommerce/" target="_blank"><?php echo __( 'link', 'free-gifts-for-woocommerce' ); ?></a></label>
                    </td>
                  </tr>
                  <tr class="fgw_ckout_sec_show">
                    <th>
                      <?php echo __( 'Gift Products Display Type Checkout Page', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <input type="radio" name="fgw_comman[fgw_gift_prod_display_ckout]" value="slider" <?php if($fgw_comman['fgw_gift_prod_display_ckout'] == 'slider' ) { echo 'checked'; } ?>><?php _e( 'Slider', 'free-gifts-for-woocommerce' ); ?>
                      <input type="radio" name="fgw_comman[fgw_gift_prod_display_ckout]" value="popup" <?php if($fgw_comman['fgw_gift_prod_display_ckout'] == 'popup' ) { echo 'checked'; } ?>><?php _e( 'Popup', 'free-gifts-for-woocommerce' ); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __('Gift Block Title', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_gift_title = $fgw_comman['fgw_gift_title']; ?>
                      <input type="text" name="fgw_comman[fgw_gift_title]" class="regular-text" value="<?php echo esc_attr($fgw_gift_title); ?>">
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __('Gift Block Title Font Size', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_gift_title_font_size = $fgw_comman['fgw_gift_title_font_size']; ?>
                      <input type="number" name="fgw_comman[fgw_gift_title_font_size]" class="regular-text" value="<?php echo esc_attr($fgw_gift_title_font_size); ?>">
                      <span>(font size is in px, just enter number)</span>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __('Gift Product Text for Gift Products in Cart', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_gift_prod_txt_in_cart = $fgw_comman['fgw_gift_prod_txt_in_cart']; ?>
                      <input type="text" name="fgw_comman[fgw_gift_prod_txt_in_cart]" class="regular-text" value="<?php echo esc_attr($fgw_gift_prod_txt_in_cart); ?>">
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Remove Gift Products from Cart if Rule does not Pass', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_gift_remove_gift_items = $fgw_comman['fgw_gift_remove_gift_items']; ?>
                      <input type="checkbox" name="fgw_comman[fgw_gift_remove_gift_items]" value="enable" <?php if($fgw_gift_remove_gift_items == 'enable') { echo 'checked'; } ?>>
                      <label><?php echo __('Here if the gift is already in the cart and then updated cart and condition is wrong then automatically remove gift from the cart', 'free-gifts-for-woocommerce' ); ?></label>
                    </td>
                  </tr>
                </table>  
              </div> 
            </div>
           
            <div class="postbox">
              <div class="postbox-header">
                <h2><?php echo __( 'Additional Rules', 'free-gifts-for-woocommerce' ); ?></h2>
              </div>
              <div class="inside">
                <table>
                  <tr>
                    <th>
                      <?php echo __('Allow Gifts only to Logged in Users', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_allow_only_logged_in = $fgw_comman['fgw_allow_only_logged_in']; ?>
                      <input type="checkbox" name="fgw_comman[fgw_allow_only_logged_in]" value="enable" <?php if($fgw_allow_only_logged_in == 'enable') { echo 'checked'; } ?>>
                      
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __('Allow for only one type of multiple gift', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_allow_multiple_gift = $fgw_comman['fgw_allow_multiple_gift']; ?>
                      <input type="checkbox" name="fgw_comman[fgw_allow_multiple_gift]" value="no" disabled>
                      <label><?php echo __('Note : Here if multiple product is gift then one type of gift allow in cart', 'free-gifts-for-woocommerce' ); ?></label>
                      <label class="fgw_comman_link"><?php echo __( 'Only available in pro version ', 'free-gifts-for-woocommerce' ); ?><a href="https://www.plugin999.com/plugin/free-gifts-product-for-woocommerce/" target="_blank"><?php echo __( 'link', 'free-gifts-for-woocommerce' ); ?></a></label>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __('Allow Includive And Excludive tax Count in Minimum Cart Total', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_allow_incluidve_tax = $fgw_comman['fgw_allow_incluidve_tax']; ?>
                      <input type="checkbox" name="fgw_comman[fgw_allow_incluidve_tax]" value="no" disabled>
                      <label class="fgw_comman_link"><?php echo __( 'Only available in pro version ', 'free-gifts-for-woocommerce' ); ?><a href="https://www.plugin999.com/plugin/free-gifts-product-for-woocommerce/" target="_blank"><?php echo __( 'link', 'free-gifts-for-woocommerce' ); ?></a></label>
                    </td>
                  </tr>
                </table>  
              </div> 
            </div>
            <div class="postbox">
              <div class="postbox-header">
                <h2><?php echo __( 'Select Gift Rule', 'free-gifts-for-woocommerce' ); ?></h2>
              </div>
              <div class="inside">
                <table>
                  <tr>
                    <th>
                      <?php echo __( 'Gift Rules', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_gift_rule = $fgw_comman['fgw_gift_rule']; ?>
                      <select name="fgw_comman[fgw_gift_rule]" class="fgw_gift_rule regular-text">
                        <option value="">Select Rules</option>
                        <option value="custom" <?php if($fgw_gift_rule == "custom") { echo "selected"; } ?>>Products Rule</option>
                        <option value="category" <?php if($fgw_gift_rule == "category") { echo "selected"; } ?>>Category Rule</option>
                        <option value="price" <?php if($fgw_gift_rule == "price") { echo "selected"; } ?>>Cart Price Rule</option>
                      </select>
                    </td>
                  </tr>
                  
                  
                </table>  
              </div> 
            </div>
            <div class="postbox">
              <div class="postbox-header">
                <h2><?php echo __( 'Gift Products', 'free-gifts-for-woocommerce' ); ?></h2>
              </div>
              <div class="inside">
                <table>
                  <tr>
                    <th>
                      <?php echo __( 'Maximum Gift Products Allowed', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <div class="fgw_child_div_custom">
                        <table class="fgw_tbl1">
                          <?php 
                          $table_minimum_custom = unserialize(get_option('minimum_custom'));
                          $table_maximum_custom = unserialize(get_option('maximum_custom'));
                          $table_allowed_custom = unserialize(get_option('allowed_custom'));
                          $table_fgw_combo_custom = unserialize(get_option('fgw_combo_custom'));
                          $table_product_multiple_custom = unserialize(get_option('fgw_gift_multiple_custom'));
                          if(!empty($table_minimum_custom[0])) {
                          for($i=0; $i<count($table_fgw_combo_custom); $i++) {    
                            ?>
                            <tr>
                              <td>
                                  <label>Add Your Product</label>
                                  <input type="hidden" name="fgw_combo_custom[]" value="<?php echo  esc_attr($table_fgw_combo_custom[$i])?>">
                                  <select class="fgw_select_product" name="" multiple="multiple" style="width:100%;">
                                  <?php
                                    if(!empty($table_fgw_combo_custom)) {
                                      $multiplegift_product_id_custom = explode(",",$table_fgw_combo_custom[$i]);
                                      foreach ($multiplegift_product_id_custom as  $multiplevalue) {
                                        $productc = wc_get_product($multiplevalue);
                                        if(!empty($productc)){
                                          $title = $productc->get_name();
                                          ?>
                                          <option value='<?php echo   esc_attr($multiplevalue)?>' selected="selected"><?php echo  esc_html($title)?></option>
                                          <?php
                                         
                                        }
                                      }
                                    }
                                  ?>
                                  </select> 
                                </td>
                              <td>
                                <label class="min_qnt">Minimum Quantity</label>
                                <input  type="number" name="minimum_custom[]" value="<?php echo  esc_attr($table_minimum_custom[$i])?>">
                              </td>
                              <td>
                                <label class="max_qnt">Maximum Quantity</label>
                                <input type="number" name="maximum_custom[]" value="<?php echo  esc_attr($table_maximum_custom[$i])?>">
                              </td>
                              <td>
                                <label>Number Of Allowed Gift</label>
                                <input type="number" name="allowed_custom[]" value="<?php echo  esc_attr($table_allowed_custom[$i])?>">
                              </td>
                              <td>
                                <label>Choose Gift Product</label>
                                <input type="hidden" name="fgw_gift_multiple_custom[]" value="<?php echo  esc_attr($table_product_multiple_custom[$i])?>">
                                <select class="fgw_gift_multiple_custom" name="" multiple="multiple" style="width:100%;">
                                  <?php
                                  if(!empty($table_product_multiple_custom)) {
                                    $multiplegift_product_id_custom = explode(",",$table_product_multiple_custom[$i]);
                                    foreach ($multiplegift_product_id_custom as  $multiplevalue) {
                                      $productc = wc_get_product($multiplevalue);
                                      if(!empty($productc)){
                                        $title = $productc->get_name();
                                        ?>
                                        <option value='<?php echo   esc_attr($multiplevalue)?>' selected="selected"><?php echo  esc_html($title)?></option>
                                        <?php
                                      }
                                    }
                                  }
                                  ?>
                                  </select> 
                              </td>
                              <td>
                                <a class=" button-primary">Add</a>
                              </td>
                              <?php
                              }
                              ?>
                            </tr>
                          <?php
                          } 
                          ?>
                        </table>
                      </div>
                      <div class="fgw_child_div_price">
                        <table class="fgw_tbl1">
                          <?php 
                          $table_minimum_price = unserialize(get_option('minimum_price'));
                          $table_maximum_price = unserialize(get_option('maximum_price'));
                          $table_allowed_price = unserialize(get_option('allowed_price'));
                          $table_product_multiple_price = unserialize(get_option('fgw_gift_multiple_price'));
                          if(!empty($table_minimum_price[0])) {
                          for($i=0; $i<count($table_minimum_price); $i++) {    
                            ?>
                            <tr>
                             
                              <td>
                                <label class="min_qnt">Minimum Price</label>
                                <input  type="number" name="minimum_price[]" value="<?php echo  esc_attr($table_minimum_price[$i])?>">
                              </td>
                              <td>
                                <label class="max_qnt">Maximum Price</label>
                                <input type="number" name="maximum_price[]" value="<?php echo  esc_attr($table_maximum_price[$i])?>">
                              </td>
                              <td>
                                <label>Number Of Allowed Gift</label>
                                <input type="number" name="allowed_price[]" value="<?php echo  esc_attr($table_allowed_price[$i])?>">
                              </td>
                              <td>
                                <label>Choose Gift Product</label>
                                <input type="hidden" name="fgw_gift_multiple_price[]" value="<?php echo  esc_attr($table_product_multiple_price[$i])?>">
                                <select class="fgw_gift_multiple_price" name="" multiple="multiple" style="width:100%;">
                                  <?php
                                  if(!empty($table_product_multiple_price)) {
                                    $multiplegift_product_id_price = explode(",",$table_product_multiple_price[$i]);
                                    foreach ($multiplegift_product_id_price as  $multiplevalue) {
                                      $productc = wc_get_product($multiplevalue);
                                      if(!empty($productc)){
                                        $title = $productc->get_name();
                                        ?>
                                        <option value='<?php echo   esc_attr($multiplevalue)?>' selected="selected"><?php echo  esc_html($title)?></option>
                                        <?php
                                      }
                                    }
                                  }
                                  ?>
                                  </select> 
                              </td>
                              <td>
                                <a class="addrow button-primary">Add</a>
                              </td>
                              <?php
                              }
                              ?>
                            </tr>
                          <?php
                          } 
                          ?>
                        </table>
                      </div>

                      <div class="fgw_child_div_category">
                        <table class="fgw_tbl1">
                          <?php 
                          $table_minimum_category = unserialize(get_option('minimum_category'));
                          $table_maximum_category = unserialize(get_option('maximum_category'));
                          $table_allowed_category = unserialize(get_option('allowed_category'));
                          $table_fgw_select_cats_category = unserialize(get_option('fgw_select_cats_category'));
                          $table_product_multiple_category = unserialize(get_option('fgw_gift_multiple_category'));
                          if(!empty($table_fgw_select_cats_category[0])) {
                          for($i=0; $i<count($table_fgw_select_cats_category); $i++) {    
                            ?>
                            <tr>
                             <td>
                                <label>Choose Categories</label>
                                <input type="hidden" name="fgw_select_cats_category[]" value="<?php echo  esc_attr($table_fgw_select_cats_category[$i])?>">
                                <select class="fgw_select_cats_category" name="" multiple="multiple" style="width:100%;">
                                  <?php
                                  if(!empty($table_fgw_select_cats_category)) {
                                    $arr_table_fgw_select_cats_category = explode(",",$table_fgw_select_cats_category[$i]);
                                    foreach ($arr_table_fgw_select_cats_category as  $multiplevalue) {
                                     $term_name = get_term( $multiplevalue )->name;
                                     $term_name = ( mb_strlen( $term_name ) > 50 ) ? mb_substr( $term_name, 0, 49 ) . '...' : $term_name;
                                     ?>
                                     <option value='<?php echo   esc_attr($multiplevalue)?>' selected="selected"><?php echo  esc_html($term_name)?></option>
                                      <?php
                                      
                                    }
                                  }
                                  ?>
                                  </select> 
                              </td>
                              <td>
                                <label class="min_qnt">Minimum Qty</label>
                                <input  type="number" name="minimum_category[]" value="<?php echo  esc_attr($table_minimum_category[$i])?>">
                              </td>
                              <td>
                                <label class="max_qnt">Maximum Qty</label>
                                <input type="number" name="maximum_category[]" value="<?php echo  esc_attr($table_maximum_category[$i])?>">
                              </td>
                              <td>
                                <label>Number Of Allowed Gift</label>
                                <input type="number" name="allowed_category[]" value="<?php echo  esc_attr($table_allowed_category[$i])?>">
                              </td>
                              <td>
                                <label>Choose Gift Product</label>
                                <input type="hidden" name="fgw_gift_multiple_category[]" value="<?php echo  esc_attr($table_product_multiple_category[$i])?>">
                                <select class="fgw_gift_multiple_category" name="" multiple="multiple" style="width:100%;">
                                  <?php
                                  if(!empty($table_product_multiple_category)) {
                                    $multiplegift_product_id_category = explode(",",$table_product_multiple_category[$i]);
                                    foreach ($multiplegift_product_id_category as  $multiplevalue) {
                                      $productc = wc_get_product($multiplevalue);
                                      if(!empty($productc)){
                                        $title = $productc->get_name();
                                        ?>
                                        <option value='<?php echo   esc_attr($multiplevalue)?>' selected="selected"><?php echo  esc_html($title)?></option>
                                        <?php
                                      }
                                    }
                                  }
                                  ?>
                                  </select> 
                              </td>
                              <td>
                                <a class="addrow button-primary">Add</a>
                              </td>
                              <?php
                              }
                              ?>
                            </tr>
                          <?php
                          } 
                          ?>
                        </table>
                      </div>
                      <label class="fgw_comman_link"><?php echo __('Multiple product availabel Only available in pro version ',  'free-gifts-for-woocommerce' ); ?><a href="https://www.plugin999.com/plugin/free-gifts-product-for-woocommerce/" target="_blank"><?php echo __( 'link',  'free-gifts-for-woocommerce'); ?></a></label>
                      
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Gift Product add to cart button text',  'free-gifts-for-woocommerce'); ?>
                    </th>
                    <td>
                      <?php $fgw_add_to_cart_text = $fgw_comman['fgw_add_to_cart_text']; ?>
                      <input type="text" name="fgw_comman[fgw_add_to_cart_text]" class="regular-text" value="<?php echo esc_attr($fgw_add_to_cart_text); ?>">
                    </td>
                  </tr>
                </table>  
              </div> 
            </div>
    			</div>
          <div id="tab-general" class="tab-content">
            <div class="postbox">
              <div class="postbox-header">
                <h2><?php echo __( 'Gift Motivation Settings',  'free-gifts-for-woocommerce' ); ?></h2>
              </div>
              <div class="inside">
                <table>
                  <tr>
                    <th>
                      <?php echo __('Enable Motivation Message',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_mtvtion_msg_enable = $fgw_comman['fgw_mtvtion_msg_enable']; ?>
                      <input type="checkbox" name="fgw_comman[fgw_mtvtion_msg_enable]" value="enable" <?php if($fgw_mtvtion_msg_enable == 'enable') { echo 'checked'; } ?>>
                    </td>
                  </tr>
                 
                  <tr>
                    <th>
                      <?php echo __('Motivation Message for multiple Products Rule','free-gifts-for-woocommerce');?>
                    </th>
                    <td>
                      <?php $fgw_prodrule_mtvtion_multi_msg = $fgw_comman['fgw_prodrule_mtvtion_multi_msg']; ?>
                      <input type="text" class="regular-text" name="fgw_comman[fgw_prodrule_mtvtion_multi_msg]" value="<?php echo esc_attr($fgw_prodrule_mtvtion_multi_msg); ?>">
                      <span class="fgw_desc">Use tag <strong>{minqty}</strong> for Min Qty <strong>{maxqty}</strong> for Max Qty <strong>{allow_gift}</strong> for  Allow Gift in Cart rule.</span>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Motivation Message for multiple Categories Rule',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_catrule_mtvtion_multi_msg = $fgw_comman['fgw_catrule_mtvtion_multi_msg']; ?>
                      <input type="text" class="regular-text" name="fgw_comman[fgw_catrule_mtvtion_multi_msg]" value="<?php echo esc_attr($fgw_catrule_mtvtion_multi_msg); ?>">
                      <span class="fgw_desc">Use tag <strong>{categories}</strong> for Categories Names List and <strong>{minprod}</strong> for Min Products in Cart rule and use tag <strong>{minqty}</strong> for Min Qty <strong>{maxqty}</strong> for Max Qty <strong>{allow_gift}</strong> for Allow Gift in Cart rule.</span>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Motivation Message for multiple Price Rule',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_pricerule_mtvtion_multi_msg = $fgw_comman['fgw_pricerule_mtvtion_multi_msg']; ?>
                      <input type="text" class="regular-text" name="fgw_comman[fgw_pricerule_mtvtion_multi_msg]" value="<?php echo esc_attr($fgw_pricerule_mtvtion_multi_msg); ?>">
                      <span class="fgw_desc">Use tag <strong>{mincarttotal}</strong> for Min Cart Total <strong>{maxcarttotal}</strong> for Max Cart Total <strong>{allow_gift}</strong> for Allow Gift in Cart rule.</span>
                    </td>
                  </tr>
                </table>  
              </div> 
            </div>
            <div class="postbox">
              <div class="postbox-header">
                <h2><?php echo __('Gift Eligiblity Settings',  'free-gifts-for-woocommerce' ); ?></h2>
              </div>
              <div class="inside">
                <table>
                  <tr>
                    <th>
                      <?php echo __( 'Eligiblity Message on Cart Page',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_eligiblity_message = $fgw_comman['fgw_eligiblity_message']; ?>
                      <input type="text" class="regular-text" name="fgw_comman[fgw_eligiblity_message]" value="<?php echo esc_attr($fgw_eligiblity_message); ?>">
                      <span class="fgw_desc">Use tag <strong>{allowed_gifts}</strong> to add Number Of Allowed Gifts.</span>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Eligiblity Button Text',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <input type="text" class="regular-text" name="fgw_comman[fgw_eligiblity_btn_text]" value="<?php echo esc_attr($fgw_comman['fgw_eligiblity_btn_text']); ?>">
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Number of item show in Slider',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td class="slider_display_devices">
                      <?php
                      $showslider_item_desktop = $fgw_comman['showslider_item_desktop'];
                      $showslider_item_tablet = $fgw_comman['showslider_item_tablet'];
                      $showslider_item_mobile = $fgw_comman['showslider_item_mobile'];
                      ?>
                      <label><input type="number" class="regular-text" name="fgw_comman[showslider_item_desktop]" value="<?php echo esc_attr($showslider_item_desktop); ?>"/>In desktop</label>
                      <label><input type="number" class="regular-text" name="fgw_comman[showslider_item_tablet]" value="<?php echo esc_attr($showslider_item_tablet); ?>"/>In tablet</label>
                      <label><input type="number" class="regular-text" name="fgw_comman[showslider_item_mobile]" value="<?php echo esc_attr($showslider_item_mobile); ?>"/>In Mobile</label>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Slider Setting Desktop',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $showslider_autoplay_or_not = $fgw_comman['showslider_autoplay_or_not']; ?>
                      <input type="checkbox" name="fgw_comman[showslider_autoplay_or_not]" value="yes" <?php if($showslider_autoplay_or_not == 'yes') { echo 'checked'; } ?>><?php _e( 'AutoPlay Slider', 'woocommerce' ); ?>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __( 'Slider Setting Mobile',  'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $showslider_autoplay_or_not_mob = $fgw_comman['showslider_autoplay_or_not_mob']; ?>
                      <input type="checkbox" name="fgw_comman[showslider_autoplay_or_not_mob]" value="yes" <?php if($showslider_autoplay_or_not_mob == 'yes') { echo 'checked'; } ?>><?php _e( 'AutoPlay Slider', 'woocommerce' ); ?>
                    </td>
                  </tr>
                </table>  
              </div> 
            </div>
          </div>
        </div>
        <input type="hidden" name="action" value="fgw_save_option">
      	<input type="submit" value="Save changes" name="submit" class="button-primary" id="fgw_btn_space">
  		</form>
    </div>
 	</div>  	

  <script  type="application/html" id="fgw_child_div_custom_clone">
          <tr>
            <td>
              <label>Add Your Product</label>
              <input type="hidden" name="fgw_combo_custom[]" value="">
              <select class="fgw_select_product" name="" multiple="multiple" style="width:100%;"></select> 
              
            </td>
            <td><label class="min_qnt">Minimum Quantity</label><input  type="number" name="minimum_custom[]"></td>
            <td><label class="max_qnt">Maximum Quantity</label><input  type="number" name="maximum_custom[]"></td>
            <td><label>Number Of Allowed Gift</label><input type="number" name="allowed_custom[]"></td>
            <td><label>Choose Gift Product</label>
              <input type="hidden" name="fgw_gift_multiple_custom[]" value="">
              <select class="fgw_gift_multiple_custom" name="" multiple="multiple" style="width:100%;"></select> 
            </td>
            <td>
              <a class="addrow button-primary">Add</a>  
            </td>
          </tr>
  </script>
  <script  type="application/html" id="fgw_child_div_category_clone">
          <tr>
             <td>
                <label>Choose Categories</label>
                <input type="hidden" name="fgw_select_cats_category[]" value="">
                <select class="fgw_select_cats_category" name="" multiple="multiple" style="width:100%;">
                  
                  </select> 
              </td>
              <td>
                <label class="min_qnt">Minimum Qty</label>
                <input  type="number" name="minimum_category[]" value="">
              </td>
              <td>
                <label class="max_qnt">Maximum Qty</label>
                <input type="number" name="maximum_category[]" value="">
              </td>
              <td>
                <label>Number Of Allowed Gift</label>
                <input type="number" name="allowed_category[]" value="">
              </td>
              <td>
                <label>Choose Gift Product</label>
                <input type="hidden" name="fgw_gift_multiple_category[]" value="">
                <select class="fgw_gift_multiple_category" name="" multiple="multiple" style="width:100%;">
                </select> 
              </td>
              <td>
                <a class="addrow button-primary">Add</a>
              </td>
              
            </tr>
  </script>
  <script  type="application/html" id="fgw_child_div_price_clone">
          <tr>
                             
            <td>
              <label class="min_qnt">Minimum Price</label>
              <input  type="number" name="minimum_price[]" value="">
            </td>
            <td>
              <label class="max_qnt">Maximum Price</label>
              <input type="number" name="maximum_price[]" value="">
            </td>
            <td>
              <label>Number Of Allowed Gift</label>
              <input type="number" name="allowed_price[]" value="">
            </td>
            <td>
              <label>Choose Gift Product</label>
              <input type="hidden" name="fgw_gift_multiple_price[]" value="">
              <select class="fgw_gift_multiple_price" name="" multiple="multiple" style="width:100%;">
                
                </select> 
            </td>
            <td>
              <a class="addrow button-primary">Add</a>
            </td>
            
          </tr>
  </script>
 	<?php
}

function FGW_recursive_sanitize_text_field($array) {
  if(!empty($array)) {
    foreach ( $array as $key => $value ) {
      if ( is_array( $value ) ) {
        $value = FGW_recursive_sanitize_text_field($value);
      }else{
        $value = sanitize_text_field( $value );
      }
    }
  }
  return $array;
}

add_action( 'wp_ajax_nopriv_fgw_product_ajax','FGW_product_ajax' );
add_action( 'wp_ajax_fgw_product_ajax', 'FGW_product_ajax' );
function FGW_product_ajax() {
  $return = array();
  $post_types = array( 'product','product_variation');

  $search_results = new WP_Query( array( 
    's'=> sanitize_text_field($_GET['q']),
    'post_status' => 'publish',
    'post_type' => $post_types,
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
	      'key' => '_stock_status',
	      'value' => 'instock',
	      'compare' => '=',
      )
    )
  ));   

  if( $search_results->have_posts() ) :
   	while( $search_results->have_posts() ) : $search_results->the_post();   
		  $productc = wc_get_product( $search_results->post->ID );
		  if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
        $title = $search_results->post->post_title;
       	if ( $productc->is_type( "variable" ) ) {
          foreach ( $productc->get_children( false ) as $child_id ) {
            $variation = wc_get_product( $child_id ); 
            if ( ! $variation || ! $variation->exists() ) {
                continue;
            }
          	$title = $variation->get_name();
	        }
	     	}else{
          $title = $search_results->post->post_title;         		
				}
				$price=$productc->get_price_html();
				$return[] = array( $search_results->post->ID, $title , $price);   
      }
  	endwhile;
  endif;

  echo json_encode( $return );
  die;
}

add_action( 'wp_ajax_nopriv_fgw_cats_ajax','FGW_cats_ajax' );
add_action( 'wp_ajax_fgw_cats_ajax', 'FGW_cats_ajax' );
function FGW_cats_ajax() {
  $return = array();
  $product_categories = get_terms( 'product_cat', $cat_args );

  if( !empty($product_categories) ){
    foreach ($product_categories as $key => $category) {
      $category->term_id;
      $title = ( mb_strlen( $category->name ) > 50 ) ? mb_substr( $category->name, 0, 49 ) . '...' : $category->name;
      $return[] = array( $category->term_id, $title );
    }
  }

  echo json_encode( $return );
  die;
}

add_action( 'init',  'FGW_save_options');
function FGW_save_options(){
	if( current_user_can('administrator') ) {
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'fgw_save_option') {
  		if(!isset( $_POST['FGW_meta_save_nounce'] ) || !wp_verify_nonce( $_POST['FGW_meta_save_nounce'], 'FGW_meta_save' ) ) {
        print 'Sorry, your nonce did not verify.';
    		exit;
  		} else {
        $isecheckbox = array(
          'fgw_gift_enable',
          'fgw_ckout_enable',
          'fgw_gift_remove_gift_items',
          'fgw_allow_only_logged_in',
          'fgw_allow_multiple_gift',
          'fgw_allow_incluidve_tax',
          'fgw_mtvtion_msg_enable',
          'showslider_autoplay_or_not',
          'showslider_autoplay_or_not_mob',
        );

        foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
          if(!isset($_REQUEST['fgw_comman'][$value_isecheckbox])){
            $_REQUEST['fgw_comman'][$value_isecheckbox] ='no';
          }
        }

        /*---custom rules---*/
        /*if(!empty($_REQUEST['fgw_select2'])) {
          $fgw_combo = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_select2'] );
          update_option('fgw_combo', $fgw_combo, 'yes');
        } else {
          update_option('fgw_combo', '', 'yes');
        }*/

        /*if(!empty($_REQUEST['fgw_cats_select2'])) {
          $fgw_cats_select2 = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_cats_select2'] );
          update_option('fgw_cats_select2', $fgw_cats_select2, 'yes');  
        } else {
          update_option('fgw_cats_select2', '', 'yes');
        }*/
        //for seinvalue

        /*$totalrow         = sanitize_text_field( $_REQUEST['totalrow'] );
        update_option('totalrow',    $totalrow , 'yes');

        $totalcol         = sanitize_text_field( $_REQUEST['totalcol'] );
        update_option( 'totalcol',  $totalcol,  'yes' );

        $fgw_minimum   = FGW_recursive_sanitize_text_field( $_REQUEST['minimum'] );
        $fgw_minimum_serilized = serialize($fgw_minimum);
        update_option('minimum', $fgw_minimum_serilized, 'yes');

        $fgw_maximum   = FGW_recursive_sanitize_text_field( $_REQUEST['maximum'] );
        $fgw_maximum_serilized = serialize($fgw_maximum);
        update_option('maximum', $fgw_maximum_serilized, 'yes');

        $fgw_allowed   = FGW_recursive_sanitize_text_field( $_REQUEST['allowed'] );
        $fgw_allowed_serilized = serialize($fgw_allowed);
        update_option('allowed', $fgw_allowed_serilized, 'yes');

        $fgw_gift_multiple   = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_gift_multiple'] );       
        $fgw_gift_serilized = serialize($fgw_gift_multiple);
        update_option('fgw_gift_multiple', $fgw_gift_serilized, 'yes');*/


        //for product 
        
        $fgw_minimum   = FGW_recursive_sanitize_text_field( $_REQUEST['minimum_custom'] );
        $fgw_minimum_serilized = serialize($fgw_minimum);
        update_option('minimum_custom', $fgw_minimum_serilized, 'yes');

        $fgw_maximum   = FGW_recursive_sanitize_text_field( $_REQUEST['maximum_custom'] );
        $fgw_maximum_serilized = serialize($fgw_maximum);
        update_option('maximum_custom', $fgw_maximum_serilized, 'yes');

        $fgw_allowed   = FGW_recursive_sanitize_text_field( $_REQUEST['allowed_custom'] );
        $fgw_allowed_serilized = serialize($fgw_allowed);
        update_option('allowed_custom', $fgw_allowed_serilized, 'yes');

        $fgw_gift_multiple   = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_combo_custom'] );       
        $fgw_gift_serilized = serialize($fgw_gift_multiple);
        update_option('fgw_combo_custom', $fgw_gift_serilized, 'yes');

        $fgw_gift_multiple   = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_gift_multiple_custom'] );       
        $fgw_gift_serilized = serialize($fgw_gift_multiple);
        update_option('fgw_gift_multiple_custom', $fgw_gift_serilized, 'yes');

        //for price 
        
        $fgw_minimum   = FGW_recursive_sanitize_text_field( $_REQUEST['minimum_price'] );
        $fgw_minimum_serilized = serialize($fgw_minimum);
        update_option('minimum_price', $fgw_minimum_serilized, 'yes');

        $fgw_maximum   = FGW_recursive_sanitize_text_field( $_REQUEST['maximum_price'] );
        $fgw_maximum_serilized = serialize($fgw_maximum);
        update_option('maximum_price', $fgw_maximum_serilized, 'yes');

        $fgw_allowed   = FGW_recursive_sanitize_text_field( $_REQUEST['allowed_price'] );
        $fgw_allowed_serilized = serialize($fgw_allowed);
        update_option('allowed_price', $fgw_allowed_serilized, 'yes');

        $fgw_gift_multiple   = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_gift_multiple_price'] );       
        $fgw_gift_serilized = serialize($fgw_gift_multiple);
        update_option('fgw_gift_multiple_price', $fgw_gift_serilized, 'yes');

        //for category 
        
        $fgw_minimum   = FGW_recursive_sanitize_text_field( $_REQUEST['minimum_category'] );
        $fgw_minimum_serilized = serialize($fgw_minimum);
        update_option('minimum_category', $fgw_minimum_serilized, 'yes');

        $fgw_maximum   = FGW_recursive_sanitize_text_field( $_REQUEST['maximum_category'] );
        $fgw_maximum_serilized = serialize($fgw_maximum);
        update_option('maximum_category', $fgw_maximum_serilized, 'yes');

        $fgw_allowed   = FGW_recursive_sanitize_text_field( $_REQUEST['allowed_category'] );
        $fgw_allowed_serilized = serialize($fgw_allowed);
        update_option('allowed_category', $fgw_allowed_serilized, 'yes');

        $fgw_gift_multiple   = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_select_cats_category'] );       
        $fgw_gift_serilized = serialize($fgw_gift_multiple);
        update_option('fgw_select_cats_category', $fgw_gift_serilized, 'yes');

        $fgw_gift_multiple   = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_gift_multiple_category'] );       
        $fgw_gift_serilized = serialize($fgw_gift_multiple);
        update_option('fgw_gift_multiple_category', $fgw_gift_serilized, 'yes');


        //comman value
        foreach ($_REQUEST['fgw_comman'] as $key_fgw_comman => $value_fgw_comman) {
          update_option($key_fgw_comman, sanitize_text_field($value_fgw_comman), 'yes');
        } 



        wp_redirect( admin_url( '/admin.php?page=free_gift&message=success' ) );
        exit;
  		}
		}
	}	
}