<?php
/**
 * REGISTER WIDGET AREAS
 */


// ADD WIDGETS
add_action( 'widgets_init', 'theme_widgets_init' );
function theme_widgets_init() {

	// DEFAULT WIDGET
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', THEME_NAME ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', THEME_NAME ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
