<?php

// load plugin textdomain
add_action( 'plugins_loaded', 'FGW_load_textdomain' );
function FGW_load_textdomain() {
    load_plugin_textdomain( 'free-gifts-for-woocommerce', false, dirname( FGW_BASE_NAME ) . '/languages' ); 
}

// load plugin textdomain mofile
function FGW_load_my_own_textdomain( $mofile, $domain ) {
    if ( 'free-gifts-for-woocommerce' === $domain && false !== strpos( $mofile, WP_LANG_DIR . '/plugins/' ) ) {
        $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
        $mofile = WP_PLUGIN_DIR . '/' . dirname( FGW_BASE_NAME ) . '/languages/' . $domain . '-' . $locale . '.mo';
    }
    return $mofile;
}
add_filter( 'load_textdomain_mofile', 'FGW_load_my_own_textdomain', 10, 2 );