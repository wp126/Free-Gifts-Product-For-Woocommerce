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
                      <input type="checkbox" name="fgw_comman[fgw_ckout_enable]" class="fgw_ckout_enable_cls" value="enable" <?php if($fgw_comman['fgw_ckout_enable'] == 'enable' ) { echo 'checked'; } ?>>
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
                      <input type="checkbox" name="fgw_comman[fgw_allow_multiple_gift]" value="enable" <?php if($fgw_allow_multiple_gift == 'enable') { echo 'checked'; } ?>>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <?php echo __('Allow Includive And Excludive tax Count in Minimum Cart Total', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <?php $fgw_allow_incluidve_tax = $fgw_comman['fgw_allow_incluidve_tax']; ?>
                      <input type="checkbox" name="fgw_comman[fgw_allow_incluidve_tax]" value="enable" <?php if($fgw_allow_incluidve_tax == 'enable') { echo 'checked'; } ?>>
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
                  <tr class="fgw_custom_rule">
                    <th>
                      <?php echo __('Add Your Product', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <select id="fgw_select_product" name="fgw_select2[]" multiple="multiple" style="width:60%;">
                        <?php 
                          $productsa = get_option('fgw_combo');
                          if(!empty($productsa)) {
                            foreach ($productsa as $value) {
                              $productc = wc_get_product($value);
                              if ( $productc && $productc->is_in_stock() && $productc->is_purchasable() ) {
                                $title = $productc->get_name();
                                ?>
                                <option value="<?php echo esc_attr($value); ?>" selected="selected"><?php echo esc_html($title); ?></option>
                                <?php
                              }
                            }
                          }
                        ?>
                      </select> 
                    </td>
                  </tr>
                  <tr class="fgw_category_rule">
                    <th>
                      <?php echo __( 'Categories', 'free-gifts-for-woocommerce' ); ?>
                    </th>
                    <td>
                      <select id="fgw_select_cats" name="fgw_cats_select2[]" multiple="multiple" style="width:60%;">
                        <?php
                        $appended_terms = get_option('fgw_cats_select2');
                        if( $appended_terms ) {
                          foreach( $appended_terms as $term_id ) {
                            $term_name = get_term( $term_id )->name;
                            $term_name = ( mb_strlen( $term_name ) > 50 ) ? mb_substr( $term_name, 0, 49 ) . '...' : $term_name;
                            echo '<option value="' . esc_attr($term_id) . '" selected="selected">' . esc_html($term_name) . '</option>';
                          }
                        }
                        ?>
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
                      <div class="fgw_child_div">
                        <?php 
                        $minimum = get_option('minimum');
                        $maximum = get_option('maximum');
                        $allowed = get_option('allowed');
                        $productsa = get_option('fgw_gift_multiple');
                        $table_minimum = unserialize($minimum);
                        $table_maximum = unserialize($maximum);
                        $table_allowed = unserialize($allowed);
                        $table_product_multiple = unserialize($productsa);

                        if(!empty($table_minimum[0])) {
                          $totalcol = get_option('totalcol' , 1);
                       
                          if($totalcol == '') {
                            $totalcol = 1;
                          }
                          $totalrow = get_option('totalrow' , 1);
                        
                          if($totalrow == '') {
                            $totalrow = 1;
                          }

                          echo '<table class="fgw_tbl1">';
                          echo '<input type="hidden" name="totalrow" value="'.esc_attr($totalrow).'">';
                          echo '<input type="hidden" name="totalcol" value="'.esc_attr($totalcol).'">';

                          $count = 0;

                          /*first row create*/
                          $tr = '<tr><td></td>';
                          
                          $tr .= '<td></td></tr>';
                          /*end first row create*/

                          for($i=0; $i<$totalrow; $i++) {          
                            $tr .= "<tr>";
                            $td = "";
                            for($j=0; $j<$totalcol; $j++) {
                              $td .='<td><label class="min_qnt">Minimum Quantity</label><input  type="number" name="minimum[]" value="'.esc_attr($table_minimum[$count]).'"></td>';
                              $td .='<td><label class="max_qnt">Maximum Quantity</label><input type="number" name="maximum[]" value="'.esc_attr($table_maximum[$count]).'"></td>';
                              $td .='<td><label>Number Of Allowed Gift</label><input type="number" name="allowed[]" value="'.esc_attr($table_allowed[$count]).'"></td>';
                              $td .='<td><label>Choose Gift Product</label><input type="hidden" name="fgw_gift_multiple[]" value="'.esc_attr($table_product_multiple[$count]).'"><select class="fgw_gift_multiple" name="" multiple="multiple" style="width:100%;">';

                              if(!empty($table_product_multiple)) {
                                $multiplegift_product_id = explode(",",$table_product_multiple[$count]);
                                foreach ($multiplegift_product_id as  $multiplevalue) {
                                  $productc = wc_get_product($multiplevalue);
                                  if(!empty($productc)){
                                    $title = $productc->get_name();
                                    $td .='<option value='.esc_attr($multiplevalue).' selected="selected">'.esc_html($title).'</option>';
                                  }
                                }
                              }
                                                  
                              $td .='</select> </td>';
                              $count++;
                            }
                            if($count == $totalcol) {
                              $td .='<td><a class="addrow button-primary">Add</a></td>';
                            } else {
                              $td .='<td><a class="addrow button-primary">Add</a><a class="deleterow button-primary">Remove</a></td>';
                            }                
                            $tr .= $td;
                            $tr .= "</tr>";
                          }
                          $allowed_html = array(
                            'tr' => array( 'class' => array(), 'id' => array() ),
                            'td' => array( 'class' => array(), 'id' => array() ),
                            'ul' => array( 'class' => array(), 'id' => array() ),
                            'li' => array( 'class' => array(), 'id' => array() ),
                            'input' => array( 'type' => array(), 'class' => array(), 'id' => array(), 'name' => array(), 'value'     => array() ),
                            'label' => array( 'class' => array(), 'id' => array() ),
                            'select' => array( 'class' => array(), 'name' => array(), 'multiple' => array(), 'style' => array(), 'tabindex' => array(), 'aria-hidden' => array() ),
                            'option' => array( 'value' => array(), 'selected' => array() ),
                            'span' => array( 'class' => array(), 'id' => array(), 'style' => array(), 'role' => array(), 'aria-haspopup' => array(), 'aria-expanded' => array(), 'dir' => array(), 'tabindex' => array(), 'aria-hidden' => array(), 'multiple' => array() ),
                            'a' => array( 'class' => array(), 'href' => array() ),
                          );
                          echo wp_kses($tr,$allowed_html);
                          // echo $tr;
                          echo '</table>';
                        } else {
                          ?>
                          <table class="fgw_tbl1">
                            <input type="hidden" name="totalrow">
                            <input type="hidden" name="totalcol">
                            <tr>
                              <td>
                                
                              </td> 
                              <td></td>
                            </tr>
                            <tr>
                              <td><label class="min_qnt">Minimum Quantity</label><input  type="number" name="minimum[]"></td>
                              <td><label class="max_qnt">Maximum Quantity</label><input  type="number" name="maximum[]"></td>
                              <td><label>Number Of Allowed Gift</label><input type="number" name="allowed[]"></td>
                              <td><lable>Choose Gift Product</lable><input type="hidden" name="fgw_gift_multiple[]" value=""><select class="fgw_gift_multiple" name="fgw_gift_multiple[]" multiple="multiple" style="width:100%;"></select> 
                              </td>
                              <td>
                                <a class="addrow button-primary">Add</a>  
                              </td>
                            </tr>
                          </table> 
                          <?php
                        }
                        ?>
                      </div>
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
        if(!empty($_REQUEST['fgw_select2'])) {
          $fgw_combo = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_select2'] );
          update_option('fgw_combo', $fgw_combo, 'yes');
        } else {
          update_option('fgw_combo', '', 'yes');
        }

        if(!empty($_REQUEST['fgw_cats_select2'])) {
          $fgw_cats_select2 = FGW_recursive_sanitize_text_field( $_REQUEST['fgw_cats_select2'] );
          update_option('fgw_cats_select2', $fgw_cats_select2, 'yes');  
        } else {
          update_option('fgw_cats_select2', '', 'yes');
        }

        $totalrow         = sanitize_text_field( $_REQUEST['totalrow'] );
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
        update_option('fgw_gift_multiple', $fgw_gift_serilized, 'yes');

        foreach ($_REQUEST['fgw_comman'] as $key_fgw_comman => $value_fgw_comman) {
          update_option($key_fgw_comman, sanitize_text_field($value_fgw_comman), 'yes');
        }   

        wp_redirect( admin_url( '/admin.php?page=free_gift' ) );
        exit;
  		}
		}
	}	
}