<?php 
/*** FRONT FUNCTIONS ***/


//FORMAT SHORTCODE TO HTML OF CONFIRM CONTENT
function format_shortcode_to_html($tag = '', $content = ''){
    $class = wpcf7_form_controls_class($tag);
    $regex = '/([a-zA-Z]+)\s|(id:[a-zA-Z0-9-_]+)|(class:[a-zA-Z0-9-_]+)|\"([a-zA-Zぁ-ゟ゠-ヿ⺀-⿕\s]+)\"/';
    $shortcodeInput = get_shortcode_html($tag, $content);
    preg_match_all($regex, $shortcodeInput, $button_data);
    $argsButtonData = $button_data[0];
    $argsInputData = [
        'type' => $tag,
        'id' => '',
        'class' => $class,
        'value' => ''
    ];
    for ($i = 1; $i <= count($argsButtonData); $i++) {
        if (isset($button_data[0][$i])) {
            if (strpos($argsButtonData[$i], 'id:') !== false) {
                $argsInputData['id'] = substr($argsButtonData[$i], 3);
            }
            if (strpos($argsButtonData[$i], 'class:') !== false) {
                $argsInputData['class'] .= ' ' . substr($argsButtonData[$i], 6);
            }
            if (strpos($argsButtonData[$i], '"') !== false) {
                $argsInputData['value'] = str_replace('"', '', $argsButtonData[$i]);
            }
        }
    }
    
    $new_value = ($tag == 'back') ? '戻る' : '送信';
    $argsInputData['value'] = ( $argsInputData['value'] != '' ) ? $argsInputData['value'] : $new_value;
    $type = ($tag == 'back') ? 'button' : 'submit';
    $html = '<input type="'.$type.'" ';

    if( $argsInputData['id'] != '' ){
        $html .= 'id="'.$argsInputData['id'].'" ';
    }

    if( $argsInputData['class'] != '' ){
        $html .= 'class="'.$argsInputData['class'].'" ';
    }
    $html .= 'value="'.$argsInputData['value'].'">';
    return $html;
}

//GET SHORT CODE SUBMIT & BACK TO CONFIRM CONTENT
function get_shortcode_html($tag = '', $content = '') {
    if ($tag == 'submit') {
        $regex = '/\[submit(\s.*?)?\]/';
    }
    if ($tag == 'back') {
        $regex = '/\[back(\s.*?)?\]/';
    }
    preg_match_all($regex, $content, $shortcode);

    if (isset($shortcode[0][0])) {
        return $shortcode[0][0];
    } else {
        return '';
    }
}


// DISPLAY BUTTON BACK AND CONFIRM CF7 FRONT
function wpcf7_confirm_form_tag_handler( $tag ) {
    $class = wpcf7_form_controls_class( $tag->type );
    $atts = array();

    $atts['class'] = $tag->get_class_option( $class );
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );

    $value = isset( $tag->values[0] ) ? $tag->values[0] : '';
    $type = ( $tag->type == 'confirm' ) ? 'submit' : 'button';
    if( empty($value) ){
        $value = $tag->type;
    }
    $atts['type'] = $type;
    $atts['value'] = $value;

    $atts = wpcf7_format_atts( $atts );

    $html = sprintf( '<input %1$s />', $atts );
    return $html;
}