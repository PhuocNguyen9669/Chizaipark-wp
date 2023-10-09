<?php
/**
 * Plugin Name: Contact Form 7 Confirm Step
 * Plugin URI: http://wordpress.org
 * Description: Setup confirm step in contact form 7 plugin
 * Version: 1.0
 * Author: BPO Front Team
 * Author URI: http://wordpress.org
 * License: GPLv2 or later
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


// DEFINE
if ( ! defined( 'CF7CFSTEP_PLUGIN_DIR' ) ) {
    define( 'CF7CFSTEP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'CF7CFSTEP_PLUGIN_URL' ) ) {
    define( 'CF7CFSTEP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'CF7CFSTEP_PLUGIN_FILE' ) ) {
    define( 'CF7CFSTEP_PLUGIN_FILE', __FILE__ );
}


// INCLUDE MODULE
require_once CF7CFSTEP_PLUGIN_DIR . 'includes/define.php';
require_once CF7CFSTEP_PLUGIN_DIR . 'includes/cf7cfstep-functions.php';
require_once CF7CFSTEP_PLUGIN_DIR . 'includes/admin/admin-functions.php';
require_once CF7CFSTEP_PLUGIN_DIR . 'includes/front/front-functions.php';


// STARTING PLUGIN
function cf7cfstep_init() {
	if( is_admin() ) {
		require CF7CFSTEP_PLUGIN_DIR . 'includes/admin/admin-settings.php';
	} else {
		require CF7CFSTEP_PLUGIN_DIR . 'includes/front/front-settings.php';
	}
}
add_action( 'plugins_loaded', 'cf7cfstep_init' );


// REGISTER ACTIVATION FUNCTIONS
function cf7cfstep_activate() {

}
register_activation_hook( __FILE__, 'cf7cfstep_activate' );


// REGISTER DEACTIVATION FUNCTIONS
function cf7cfstep_deactivate() {
    
}
register_deactivation_hook( __FILE__, 'cf7cfstep_deactivate' );

?>