<?php
/**
 * CONTENT THEME FILE SYNC EDITER
 */


// DEFINE
define('TEMPLATE_CONTENTTHEME', 'templates/content_theme_template.php');
define('EDITCTF_METAKEY', 'theme_editctf_status');


// ADD THEME FUNCTION PAGE FILE CONTENT EDITER
function themefunc_page_filecontent_editor_content( $content ) {
    global $post;
    if( is_admin() && $post && get_post_type($post) == 'page' && get_page_template_slug($post) == TEMPLATE_CONTENTTHEME ) {
    	$pageName = $post->post_name;
    	$pageID = $post->ID;
    	$editctf_status = get_post_meta($pageID, EDITCTF_METAKEY, true);
    	if( $editctf_status == '1' ) {
    		ob_start();
    		get_template_part( 'pages/'.$pageName );
    		$page_file_content = ob_get_contents();
    		ob_end_clean();
    		$content = $page_file_content;
    	}
    }
    return $content;
}
add_filter( 'the_editor_content', 'themefunc_page_filecontent_editor_content' );


// SAVE PAGE FILE CONTENT ON EDITER
function themefunc_save_page_filecontent_editor( $post_id, $post, $update ) {
	if(!current_user_can('edit_post', $post_id)) {
    	return $post_id;
	}

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

	if ( !$post ) {
        return $post_id;
    }

	if ( get_page_template_slug($post) != TEMPLATE_CONTENTTHEME ) {
		return $post_id;		
	}

	// SAVE CONTENT TO PAGE FILE
	$pageName = $post->post_name;
	$editctf_status = get_post_meta($post_id, EDITCTF_METAKEY, true);
	$pageContentPath = get_stylesheet_directory() . '/pages/'. $pageName . '.php';
	if( $editctf_status == '1' && is_file($pageContentPath) ) {
		$post_content = $post->post_content;
		$post_content = str_replace(get_stylesheet_directory_uri(), '<?php echo THEME_URL; ?>', $post_content);
		file_put_contents( $pageContentPath, $post_content );
	}

	// SAVE STATUS
	$editctf_status = isset($_POST['editctf_status']) ? $_POST['editctf_status'] : '0';
	update_post_meta($post_id, EDITCTF_METAKEY, $editctf_status);
}
add_action( 'save_post_page', 'themefunc_save_page_filecontent_editor', 10, 3 );


// BUILD METABOX TOGGLE EDIT PAGE CONTENT FILE
function edit_pagecontent_file_meta_box_markup($object) {
    wp_nonce_field(basename(__FILE__), 'meta-box-nonce');
    ?>
        <div class="toogle-edit-content-file-wrap">
            <!-- <p class="post-attributes-label-wrapper parent-id-label-wrapper">
            	<label class="post-attributes-label" for="editctf_status">Status</label>
            </p> -->
            <?php 
            	$data_select = array( 0 => 'Disable', 1 => 'Enable' );
            	$editctf_status = get_post_meta($object->ID, EDITCTF_METAKEY, true);
            	$editctf_status = $editctf_status ? $editctf_status : 0;
            ?>
            <select id="editctf_status" name="editctf_status">
            	<?php 
            		foreach ($data_select as $key => $value): 
            			$selected = '';
            			if( $key == $editctf_status ) {
            				$selected = 'selected';
            			}
            	?>
            		<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
            	<?php endforeach; ?>
            </select>
        </div>
    <?php
}


// ADD METABOX TOGGLE EDIT PAGE CONTENT FILE
function add_meta_box_toggle_edit_pagecontent_file() {
	global $post;
	if( isset($post) && $post && $post->post_type == 'page' && get_page_template_slug($post) == TEMPLATE_CONTENTTHEME ) {
		add_meta_box('toggle-editcontentfile-meta-box', 'Edit File Content Status', 'edit_pagecontent_file_meta_box_markup', 'page', 'side', 'low', null);
	}
}
add_action('add_meta_boxes', 'add_meta_box_toggle_edit_pagecontent_file');