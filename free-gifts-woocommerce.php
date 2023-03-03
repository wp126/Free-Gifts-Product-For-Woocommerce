<?php
/**
* Plugin Name: Free Gifts Product For Woocommerce
* Description: This plugin allows create Free Gifts For Woocommerce plugin.
* Version: 1.0
* Copyright: 2023
* Text Domain: free-gifts-for-woocommerce
* Domain Path: /languages 
*/

if (!defined('ABSPATH')) {
  	die('-1');
}

// Define plugin file
define('FGW_PLUGIN_FILE', __FILE__);

// Define plugin dir
define('FGW_PLUGIN_DIR',plugins_url('', __FILE__));

// Define base name
define('FGW_BASE_NAME', plugin_basename(FGW_PLUGIN_FILE));


// Load wordpress plugins file
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


//Load all includes files
include_once('main/backend/free-gifts-comman.php');
include_once('main/backend/free-gifts-backend.php');
include_once('main/frontend/free-gifts-frontend.php');
include_once('main/frontend/free-gifts-frontend-function.php');
include_once('main/frontend/free-gifts-frontend-action.php');
include_once('main/resources/free-gifts-installation-require.php');
include_once('main/resources/free-gifts-load-js-css.php');
include_once('main/resources/free-gifts-language.php');

function FGW_support_and_rating_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
    if ($plugin_file_name !== plugin_basename(__FILE__)) {
      return $links_array;
    }

    $links_array[] = '<a href="https://www.plugin999.com/support/">'. __('Support', 'free-gifts-for-woocommerce') .'</a>';
    $links_array[] = '<a href="https://wordpress.org/support/plugin/free-gifts-product-for-woocommerce/reviews/?filter=5">'. __('Rate the plugin ★★★★★', 'free-gifts-for-woocommerce') .'</a>';

    return $links_array;

}
add_filter( 'plugin_row_meta', 'FGW_support_and_rating_links', 10, 4 );