<?php 
/*** ADMIN FUNCTIONS ***/
// ADD CONFIRM ACTIVE SWITCH META BOX
function custom_meta_box_markup($object) {
    wp_nonce_field(basename(__FILE__), 'meta-box-nonce');
    ?>
        <div>
            <label for="meta-box-text">Text</label>
            <input name="meta-box-text" type="text" value="<?php echo get_post_meta($object->ID, 'meta-box-text', true); ?>">

            <h3>CHECK</h3>
        </div>
    <?php  
}

// ADD TAB PANEL CF7
function cf7cfstep_confirm_tab_content( $post ) {
	$description = esc_html( 'You can edit the confirm template here.' );
	$post_id = $post->id;
	$confirmStatus = get_post_meta($post_id, 'cf7cfstep-confirm-status', true);
	$confirmStatusData = ( $confirmStatus > 0 ) ? $confirmStatus : 0;
	$active = ( $confirmStatus > 0 ) ? 'checked' : '';
?>
	<h2><?php echo esc_html( 'Confirm' ); ?></h2>

	<fieldset>
	<legend>
	<?php 
		echo '<h2>On/Off Tab Confirm</h2><label><input type="checkbox" name="cf7cfstep-confirm-status" class="custom_css_checkbox" value="'.$confirmStatusData.'" '.$active.'><span></span></label>';
		echo '<br />';
		echo '<br />';
		if( $confirmStatus > 0 ):
			echo $description;
			echo '<br />';
			echo esc_html( 'In the following fields, you can use these mail-tags:' );

			$confirm = array(get_post_meta( $post_id, CF7CFSTEP_META_FIELD, true ));
			foreach ( (array) $post->collect_mail_tags() as $mail_tag ) {
				$pattern = sprintf(
					'/\[(_[a-z]+_)?%s([ \t]+[^]]+)?\]/',
					preg_quote( $mail_tag, '/' )
				);

				$used = preg_grep( $pattern, $confirm );

				echo sprintf(
					'<span class="%1$s">[%2$s]</span>',
					'mailtag code ' . ( $used ? 'used' : 'unused' ),
					esc_html( $mail_tag )
				);
			}
	?>
	</legend>

	<span id="tag-generator-list">
		<a href="#TB_inline?width=600&amp;height=500&amp;inlineId=tag-generator-panel-submit" class="thickbox button" title="Form-tag Generator: submit">Submit</a>
		<a href="#TB_inline?width=600&amp;height=500&amp;inlineId=tag-generator-panel-back" class="thickbox button" title="Form-tag Generator: Button Back">Button Back</a>
	</span>
	
	<textarea id="cf7cfstep-confirm" name="<?php echo CF7CFSTEP_ADMIN_FIELD_NAME; ?>" cols="100" rows="24" class="large-text code" data-config-field="confirm.body"><?php echo esc_textarea( $post->prop( 'confirm' ) ); ?></textarea>
	</fieldset>
	<style type="text/css">
		#form-panel #tag-generator-list a[title="Form-tag Generator: submit"],
		#form-panel #tag-generator-list a[title="Form-tag Generator: Button Back"]{
			display: none;
		}
	</style>
<?php
	endif;
}


// POPUP HTML TAG BUTTON CONFIRM
function wpcf7_tag_generator_menu_confirm( $contact_form, $args = '' ) {
	template_popup_button_insert('confirm');
}


// POPUP HTML TAG BUTTON BACK
function wpcf7_tag_generator_menu_back( $contact_form, $args = '' ) {
	template_popup_button_insert('back');
}


function wpcf7_tag_generator_menu_submit_cus( $contact_form, $args = '' ) {
	template_popup_button_insert('submit');
}


//TEMPLATE POPUP BUTTON INSERT
function template_popup_button_insert($tag = 'confirm'){
$class = 'insert-tag-confirm';
if( $tag == 'confirm' ){
    $class = 'insert-tag';
}
?>
    <div class="control-box">
        <fieldset>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Label', 'contact-form-7' ) ); ?></label></th>
                        <td><input type="text" name="values" class="oneline" id="<?php echo esc_attr( $args['content'] . '-values' ); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>">
                                <?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
                        <td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>">
                                <?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
                        <td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="insert-box">
        <input type="text" name="<?php echo $tag; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
        <div class="submitbox">
            <input type="button" class="button button-primary <?php echo $class; ?>" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
        </div>
    </div>
<?php
}
?>