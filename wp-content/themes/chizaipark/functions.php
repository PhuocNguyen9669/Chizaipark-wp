<?php
/**
 * 
 * THEME FUNCTIONS
 *
 */


// DEFINE
require get_stylesheet_directory() . '/bases/define.php';


// BASE FUNCTIONS
require get_stylesheet_directory() . '/bases/functions/base-functions.php';


// ADMIN FUNCTIONS
require get_stylesheet_directory() . '/admin/functions/admin-functions.php';


// WIDGETS
require get_stylesheet_directory() . '/inc/widgets/widget-classes.php';
require get_stylesheet_directory() . '/inc/widgets/widget-areas.php';


// SHORTCODE
require get_stylesheet_directory() . '/inc/shortcodes.php';


// ADD CONTENT THEME SYNC EDITER
if( defined('HAS_CTTHEME_EDITER') && HAS_CTTHEME_EDITER ) {
	require get_stylesheet_directory() . '/bases/functions/content-theme-sync-editer-function.php';
}


// ADD ASSETS
require get_stylesheet_directory() . '/inc/add-assets.php';


// MAIN FUNCTIONS
require get_stylesheet_directory() . '/inc/main-functions.php';




















