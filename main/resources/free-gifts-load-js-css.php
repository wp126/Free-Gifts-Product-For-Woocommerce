<?php 

//Add JS and CSS on Backend
add_action( 'admin_enqueue_scripts', 'FGW_load_admin_js_css');
function FGW_load_admin_js_css() {
	global $fgw_comman;
  	wp_enqueue_style( 'FGW_admin_style', FGW_PLUGIN_DIR . '/assets/css/back.css', false, '1.0.0' );
  	wp_enqueue_script( 'FGW_admin_script', FGW_PLUGIN_DIR . '/assets/js/back.js', array( 'jquery', 'select2'), false, '1.0.0', true );
  	wp_localize_script( 'ajaxloadpost', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
  	wp_enqueue_style( 'woocommerce_admin_styles-css', WP_PLUGIN_URL. '/woocommerce/assets/css/admin.css',false,'1.0',"all");
  	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker-alpha', FGW_PLUGIN_DIR . '/assets/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
	$FGW_array_img = FGW_PLUGIN_DIR;
  	wp_localize_script( 'FGW_admin_script', 'FGW_DATA', array('FGW_array_img' => $FGW_array_img));
}

//Add JS and CSS on Frontend
add_action( 'wp_enqueue_scripts',  'FGW_load_front_js_css');
function FGW_load_front_js_css() {
	global $fgw_comman;
 	wp_enqueue_style( 'FGW_front_style', FGW_PLUGIN_DIR . '/assets/css/front.css', false, '1.0.0' );
	wp_enqueue_style( 'FGW_owl-min', FGW_PLUGIN_DIR . '/assets/js/owlcarousel/assets/owl.carousel.min.css' );
    wp_enqueue_style( 'FGW_owl-theme', FGW_PLUGIN_DIR . '/assets/js/owlcarousel/assets/owl.theme.default.min.css');
    wp_enqueue_script( 'FGW_owl', FGW_PLUGIN_DIR . '/assets/js/owlcarousel/owl.carousel.js', false, '1.0.0', true );
    wp_enqueue_script( 'FGW_front_script', FGW_PLUGIN_DIR . '/assets/js/front.js',array("jquery"), false, '1.0.0', true );

	$showslider_item_desktop = $fgw_comman[ 'showslider_item_desktop'];
  	$showslider_item_tablet = $fgw_comman[ 'showslider_item_tablet'];
  	$showslider_item_mobile = $fgw_comman[ 'showslider_item_mobile'];
 	$showslider_autoplay_or_not = $fgw_comman['showslider_autoplay_or_not']; 
 	$showslider_autoplay_or_not_mob = $fgw_comman['showslider_autoplay_or_not_mob'];
 	 
 	wp_localize_script( 'FGW_front_script', 'FGWWdata', 
		array(
            'fgw_ajax_url'=>admin_url('admin-ajax.php'),
			'showslider_item_desktop' => $showslider_item_desktop,
            'showslider_item_tablet'=> $showslider_item_tablet,
            'showslider_item_mobile' => $showslider_item_mobile,
            'showslider_autoplay_or_not' => $showslider_autoplay_or_not,
            'showslider_autoplay_or_not_mob'=> $showslider_autoplay_or_not_mob       
      	)
 	);
}