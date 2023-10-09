<?php
/**
 *  ADMIN FUNCTIONS
 */


// ADD CUSTOMIZE CSS JS ADMIN
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script' );
function load_custom_wp_admin_script() {
    wp_enqueue_style( 'customize-admin-css', THEME_URL . '/admin/assets/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_script( 'customize-admin-js', THEME_URL . '/admin/assets/js/admin-script.js', false, '1.0.0' );
}
