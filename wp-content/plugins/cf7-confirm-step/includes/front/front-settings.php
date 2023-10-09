<?php 
/*** FRONT SETTINGS AND HOOKS ***/


// ADD CF7CFSTEP CSS JS FRONT
add_action( 'wp_enqueue_scripts', 'cf7cfstep_load_front_script' );
function cf7cfstep_load_front_script() {
    wp_enqueue_style( 'cf7cfstep_front_css', CF7CFSTEP_PLUGIN_URL . 'assets/css/front-style.css', false, '1.0.0' );
    wp_enqueue_script( 'cf7cfstep_front_js', CF7CFSTEP_PLUGIN_URL . 'assets/js/front-script.js', ['jquery-core'], '1.0.0' );
}


// ADD CF7CFSTEP EVENT SCRIPT
add_action( 'wp_head', 'cf7cfstep_add_valglobal_script_head' );
function cf7cfstep_add_valglobal_script_head() {
?>
<script type="text/javascript">
    var cf7cfstep_gostep2_key = '<?php echo CF7CFSTEP_GOSTEP2_KEY; ?>';
    var cf7cfstep_forminput_class = '<?php echo CF7CFSTEP_FORM_INPUTWRAP_CLASS; ?>';
    var cf7cfstep_formconfirm_class = '<?php echo CF7CFSTEP_FORM_CONFIRMWRAP_CLASS; ?>';
</script>
<?php
}


// ADD CF7CFSTEP WRAP FORM HTML
add_filter( 'wpcf7_form_response_output', 'cf7cfstep_add_confirm_wrap_html_output', 10, 4 );
function cf7cfstep_add_confirm_wrap_html_output( $output, $class, $content, $instance ) {
    $form_id = $instance->id();
    $confirm_content = '';
    if( $form_id ) {
        $confirm_content = get_post_meta( $form_id, CF7CFSTEP_META_FIELD, true );
        $wpcf7_tags = $instance->scan_form_tags();
        foreach($wpcf7_tags as $wpcf7_tag){
            if( !in_array($wpcf7_tag['name'], ['confirm, submit, back']) ){
                $confirm_content = str_replace('['.$wpcf7_tag['name'].']', '<span wpcf7-data-name="'.$wpcf7_tag['name'].'">['.$wpcf7_tag['name'].']</span>', $confirm_content);
            }
        }
        $step_input = '<input type="hidden" name="cf7cfstep_num" value="1">';
    }
    $submit_tag = 'submit';
    $submit_back = 'back';

    //GET HTML INPUT TAB CONFIRM
    $html_submit = format_shortcode_to_html($submit_tag , $confirm_content);
    $html_back = format_shortcode_to_html($submit_back, $confirm_content);

    // GET SHORTCODE INPUT TAB CONFIRM
    $shortcode_submit = get_shortcode_html($submit_tag , $confirm_content);
    $shortcode_back = get_shortcode_html($submit_back , $confirm_content);

    $confirm_content = str_replace($shortcode_submit, $html_submit, $confirm_content);
    $confirm_content = str_replace($shortcode_back, $html_back, $confirm_content);
    $confirm_wrap = '<div class="'.CF7CFSTEP_FORM_CONFIRMWRAP_CLASS.' cf7cfstep-hide">'.$step_input.$confirm_content.'</div>';
    return $confirm_wrap.$output;
};


// BEFORE SEND MAIL
add_action( 'wpcf7_before_send_mail',
    function( $contact_form, &$abort, $submission ) {
        // GET DATA FORM
        $wpcf7      = WPCF7_ContactForm::get_current();
        $submission = WPCF7_Submission::get_instance();

        // GET DATA FORM
        $data = $submission->get_posted_data();
        $cf7cfstep_num = $data['cf7cfstep_num'];

        if( $cf7cfstep_num == '1' ) {
            // CANCEL SEND MAIL
            $abort = true;

            // SHOW MESSAGE GO STEP 2
            $submission->set_response(CF7CFSTEP_GOSTEP2_KEY);
        }
    },
    10, 3
);


// CF7 AJAX JSON
// add_filter( "wpcf7_ajax_json_echo", "wpcf7c_ajax_json_echo_step111", 10, 2 );
// function wpcf7c_ajax_json_echo_step111( $items, $result ) {
//     // if($items['status'] == 'mail_sent' ) {
//     //     $items["message"]  = "";
//     //     $items["mailSent"] = false;
//     //     $items["status"] = 'wpcf7c_confirmed';
//     //     unset( $items['captcha'] );
//     //     return $items;
//     // }
//     return $items;
// }


// ADD WRAP FORM INPUT CONTENT
add_filter( 'wpcf7_contact_form_properties', 'cf7cfstep_add_wrap_form_input_content', 20, 2 ); 
function cf7cfstep_add_wrap_form_input_content( $properties, $instance ) {
    $form_id = $instance->id();
    if( $form_id ) {
        $confirmStatus = get_post_meta($form_id, 'cf7cfstep-confirm-status', true);
        if( $confirmStatus <= 0 ){
            wpcf7_remove_form_tag( 'confirm' );
            wpcf7_remove_form_tag( 'back' );
        }
        $properties['form'] = '<div class="'.CF7CFSTEP_FORM_INPUTWRAP_CLASS.'">' . $properties['form'] . '</div>';
    }
    return $properties;
}


// DISPLAY BUTTON BACK AND CONFIRM CF7 FRONT
add_action( 'wpcf7_init', 'wpcf7_add_form_tag_confirm', 100, 0 );
function wpcf7_add_form_tag_confirm() {
    wpcf7_add_form_tag( 'confirm', 'wpcf7_confirm_form_tag_handler' );
    wpcf7_add_form_tag( 'back', 'wpcf7_confirm_form_tag_handler' );
    wpcf7_add_form_tag( 'submit', 'wpcf7_confirm_form_tag_handler' );
}
