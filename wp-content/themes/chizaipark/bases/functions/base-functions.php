<?php
/**
 * THEME BASIC FUNCTIONS
 */



// SETUP THEME
function theme_setup() {
	// SETUP LANGUAGE
	load_theme_textdomain( THEME_NAME, THEME_PATH . '/languages' );

	// ADDS RSS FEED LINKS
	add_theme_support( 'automatic-feed-links' );

	// ADD MENU DEFAULT LOCATION
	register_nav_menu( 'primary', __( 'Navigation Menu', THEME_NAME ) );
	register_nav_menu( 'footer', __( 'Footer Menu', THEME_NAME ) );

	// ADD NEW IMAGES SIZE
	theme_add_images_size();

	// ADD POST THUMBNAILS
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'theme_setup' );



// HEAD TITLE
function theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// ADD THE SITE NAME.
	$title .= get_bloginfo( 'name', 'display' );

	// ADD THE SITE DESCRIPTION FOR THE HOME/FRONT PAGE.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// ADD A PAGE NUMBER IF NECESSARY.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', THEME_NAME ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'theme_wp_title', 10, 2 );



// THEME EXCERPT MORE
if ( ! function_exists( 'theme_excerpt_more' ) && ! is_admin() ) :
function theme_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'theme_excerpt_more' );
endif;



// DISABLE SCALED PHOTO WP
add_filter( 'big_image_size_threshold', '__return_false' );



// ADD NO IMAGE IN THE POST THUMBNAIL
function add_noimage_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    $alt = get_the_title($post_id);
    $class = isset($attr['class']) ? $attr['class'] : '';
    $noimage_id = NOIMAGE_ID;
    // RENDER NO IMAGE
    if( $noimage_id && ( !$html || !has_post_thumbnail( $post_id ) ) ) {
        $noimage_src = wp_get_attachment_image_src($noimage_id, $size);
        $html = '<img src="'.$noimage_src[0].'" class="'.$class.'" alt="No Image">';
    }
    // RETURN
    return $html;
}
add_filter('post_thumbnail_html', 'add_noimage_post_thumbnail_html', 20, 5);



// ADD CUSTOMIZE CSS JS ADMIN
function load_base_theme_script() {
    wp_enqueue_style( '404-base-css', THEME_URL . '/bases/assets/css/404.css', false, '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'load_base_theme_script' );



// FUNCTIONS


// ADD THEME IMAGES SIZE
if ( ! function_exists( 'theme_add_images_size' ) ) :
function theme_add_images_size() {
	if( defined('THEME_NEW_IMAGES_SIZE') && THEME_NEW_IMAGES_SIZE && is_array(THEME_NEW_IMAGES_SIZE) ) {
		foreach (THEME_NEW_IMAGES_SIZE as $size_name => $size_data) {
			if( isset($size_data['width']) && isset($size_data['height']) ) {
				$width = intval($size_data['width']);
				$height = intval($size_data['height']);
				$crop = (isset($size_data['crop']) && is_bool($size_data['crop'])) ? $size_data['crop'] : true;
				add_image_size( $size_name, $width, $height, $crop );
			}
		}
	}
}
endif;


// THE THEME URL
if ( ! function_exists( 'themeUrl' ) ) :
function themeUrl() {
	echo THEME_URL;
}
endif;



// THE THEME DIRECTORY
if ( ! function_exists( 'themeDirectory' ) ) :
function themeDirectory() {
	echo THEME_PATH;
}
endif;


// THE HOME URL
if ( ! function_exists( 'homeUrl' ) ) :
function homeUrl() {
	echo HOME_URL;
}
endif;