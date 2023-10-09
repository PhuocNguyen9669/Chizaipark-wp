<?php 
/*** ADMIN SETTINGS AND HOOKS ***/


// ADD CF7CFSTEP CSS JS ADMIN
add_action( 'admin_enqueue_scripts', 'load_cf7cfstep_admin_script' );
function load_cf7cfstep_admin_script() {
    wp_enqueue_style( 'cf7cfstep_admin_css', CF7CFSTEP_PLUGIN_URL . 'assets/css/admin-style.css', false, '1.0.0' );
    wp_enqueue_script( 'cf7cfstep_admin_js', CF7CFSTEP_PLUGIN_URL . 'assets/js/admin-script.js', false, '1.0.0' );
}


// ADD TAB PANEL CF7
add_filter( 'wpcf7_editor_panels', 'cf7cfstep_add_confirm_tab_panels', 20, 1 );
function cf7cfstep_add_confirm_tab_panels( $panels ) { 
	$panels['cf7cfstep-panel'] = array(
		'title' => 'Confirm',
		'callback' => 'cf7cfstep_confirm_tab_content',
	);
    return $panels;
}


// GET AND SHOW DATA CONFIRM AREA TO TAB
add_filter( 'wpcf7_contact_form_properties', 'cf7cfstep_get_confirm_contact_form_properties', 20, 2 ); 
function cf7cfstep_get_confirm_contact_form_properties( $properties, $instance ) {
	$form_id = $instance->id();
	if( $form_id ) {
		$properties['confirm'] = get_post_meta( $form_id, CF7CFSTEP_META_FIELD, true );
	}
    return $properties; 
}


// SAVE DATA CONFIRM FORM TAB
add_action( 'wpcf7_save_contact_form', 'cf7cfstep_save_confirm_contact_form_action', 20, 3 );
function cf7cfstep_save_confirm_contact_form_action( $contact_form, $args, $context ) {
	$form_id = $contact_form->id();
	if( $form_id ){
		$value = 0;
		if( isset( $args['cf7cfstep-confirm-status'] ) ){
			$value = 1;
		}
		update_post_meta($form_id, 'cf7cfstep-confirm-status', $value);
	}
	if( $form_id && isset($args[CF7CFSTEP_ADMIN_FIELD_NAME]) ) {
		$confirm_data = wpcf7_sanitize_form( $args[CF7CFSTEP_ADMIN_FIELD_NAME] );
		update_post_meta( $form_id, CF7CFSTEP_META_FIELD, $confirm_data );
		return;
	}
}


// ADD CONFIRM ACTIVE SWITCH META BOX
add_action('add_meta_boxes', 'add_confirm_active_switch_meta_box');
function add_confirm_active_switch_meta_box() {
    add_meta_box('cf7cfstep-active-switch-meta-box', 'Confirm Active', 'custom_meta_box_markup', 'toplevel_page_wpcf7', 'side', 'high', null);
}


// ADD MENU BUTTON CONFIRM & BACK TO ADMIN MENU CF7
add_action( 'wpcf7_admin_init', 'wpcf7_add_tag_generator_menu_add', 100, 0 );
function wpcf7_add_tag_generator_menu_add() {
	$tag_generator = WPCF7_TagGenerator::get_instance();
	if( isset( $_GET['post'] ) && $_GET['post'] ) {
		$post_id = $_GET['post'];
		$confirmStatus = get_post_meta($post_id, 'cf7cfstep-confirm-status', true);
		if( $confirmStatus > 0 ){
			$tag_generator->add( 'confirm', __( 'Button Confirm', 'contact-form-7' ),
				'wpcf7_tag_generator_menu_confirm' );
			$tag_generator->add( 'back', __( 'Button Back', 'contact-form-7' ),
				'wpcf7_tag_generator_menu_back' );
			$tag_generator->add( 'submit', __( 'submit', 'contact-form-7' ),
				'wpcf7_tag_generator_menu_submit_cus' );
		}
	}
}

?>