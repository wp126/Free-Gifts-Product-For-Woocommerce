<?php

// Check plugin activted or not
add_action('admin_init', 'FGW_check_plugin_state');
function FGW_check_plugin_state() {
  	if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
    	set_transient( get_current_user_id() . 'fgwerror', 'message' );
  	}
}

// Show admin notice for plugin require
add_action( 'admin_notices', 'FGW_show_notice');
function FGW_show_notice() {

    if ( get_transient( get_current_user_id() . 'fgwerror' ) ) {
      	deactivate_plugins( FGW_BASE_NAME );

      	delete_transient( get_current_user_id() . 'fgwerror' );

      	echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
    }
}
