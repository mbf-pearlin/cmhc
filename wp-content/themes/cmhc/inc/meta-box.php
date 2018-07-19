<?php
/*** Metabox for page, post ***/

add_action("add_meta_boxes", "add_page_settings_custom_meta_box");
add_action("save_post", "save_page_settings_custom_meta_box", 10, 3);

function add_page_settings_custom_meta_box(){
	add_meta_box("banner-meta-box", "Inner Page Banner", "banner_page_settings_box_markup", array('page','post','cpt-conditions'), "normal", "high", null);
}
 
function banner_page_settings_box_markup($post){
	wp_nonce_field(basename(__FILE__), "page-settings-nonce");
	
	$banner_title = get_post_meta( $post->ID, '_banner_title', true );
	$banner_content = get_post_meta( $post->ID, '_banner_content', true );
	
	get_template_part('inc/upload-scripts');
	
	echo '<style type="text/css"> .page_settings_tbl td, .page_settings th{ padding: 7px 0px; } .page_settings textarea{ width: 25em;} </style>';
	echo '<table width="100%" class="page_settings" style="text-align: left;">';
		//echo get_admin_input('up_image', '_banner_image', 'Upload', $banner_image , '');

	echo get_admin_input('text', '_banner_title', 'Intro Title', $banner_title , '');
	echo get_admin_input('editor', '_banner_content', 'Intro Content', $banner_content , '');
	
	echo '</table>';
}

function save_page_settings_custom_meta_box( $post_id ) {
			
	if (!isset($_POST["page-settings-nonce"]) || !wp_verify_nonce($_POST["page-settings-nonce"], basename(__FILE__)))
        return $post_id;
		
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
	if ( in_array($_POST['post_type'], array('page','post','cpt-conditions')) ) {
		
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
			
	} else {
		
		if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;
		
	}
	
	$fields = array( '_banner_content','_banner_image','_banner_title' );
	
	foreach( $fields as $field ) {
		if(isset($_POST[$field])){
			$value = ( $_POST[$field] );
			update_post_meta( $post_id, $field, $value );
		}
	}
	
}

add_action("add_meta_boxes", "add_page_settings_custom_meta_box_condtion");
add_action("save_post", "save_page_settings_custom_meta_box_condtion", 10, 3);

function add_page_settings_custom_meta_box_condtion(){
	add_meta_box("bannerd-meta-box", "Content", "banner_page_settings_box_markup_condtion", array('cpt-conditions'), "normal", "high", null);
}

function banner_page_settings_box_markup_condtion($post){
	wp_nonce_field(basename(__FILE__), "page-settings-nonce");
	
	$_side_content = get_post_meta( $post->ID, '_side_content', true );
	$symptoms_content = get_post_meta( $post->ID, '_symptoms_content', true );
	$how_is_content = get_post_meta( $post->ID, '_how_is_treated', true );
	
	get_template_part('inc/upload-scripts');
	
	echo '<style type="text/css"> .page_settings_tbl td, .page_settings th{ padding: 7px 0px; } .page_settings textarea{ width: 25em;} </style>';
	echo '<table width="100%" class="page_settings" style="text-align: left;">';

	echo get_admin_input('editor', '_side_content', 'Right Side Content', $_side_content , '');
	echo get_admin_input('editor', '_symptoms_content', 'Symptoms', $symptoms_content , '');
	echo get_admin_input('editor', '_how_is_treated', 'How Is It Treated', $how_is_content , '');
	
	echo '</table>';
}

function save_page_settings_custom_meta_box_condtion( $post_id ) {
			
	if (!isset($_POST["page-settings-nonce"]) || !wp_verify_nonce($_POST["page-settings-nonce"], basename(__FILE__)))
        return $post_id;
		
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
	if ( in_array($_POST['post_type'], array('cpt-conditions')) ) {
		
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
			
	} else {
		
		if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;
		
	}
	
	$fields = array( '_symptoms_content','_side_content','_how_is_treated' );
	
	foreach( $fields as $field ) {
		if(isset($_POST[$field])){
			$value = ( $_POST[$field] );
			update_post_meta( $post_id, $field, $value );
		}
	}
	
}

add_action("add_meta_boxes", "add_page_settings_custom_meta_box_bannerimage");
add_action("save_post", "save_page_settings_custom_meta_box_bannerimage", 10, 3);

function add_page_settings_custom_meta_box_bannerimage(){
	add_meta_box("bannerds-meta-box", "Mobile Image", "banner_page_settings_box_markup_bannerimage", array('cpt-slider'), "normal", "high", null);
}

function banner_page_settings_box_markup_bannerimage($post){
	wp_nonce_field(basename(__FILE__), "page-settings-nonce");
	
	
	$mob_image = get_post_meta( $post->ID, '_mob_image', true );
	
	get_template_part('inc/upload-scripts');
	
	echo '<style type="text/css"> .page_settings_tbl td, .page_settings th{ padding: 7px 0px; } .page_settings textarea{ width: 25em;} </style>';
	echo '<table width="100%" class="page_settings" style="text-align: left;">';

	echo get_admin_input('up_image', '_mob_image', 'Mobile Image', $mob_image , '');
	
	
	echo '</table>';
}

function save_page_settings_custom_meta_box_bannerimage( $post_id ) {
			
	if (!isset($_POST["page-settings-nonce"]) || !wp_verify_nonce($_POST["page-settings-nonce"], basename(__FILE__)))
        return $post_id;
		
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
	if ( in_array($_POST['post_type'], array('cpt-slider')) ) {
		
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
			
	} else {
		
		if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;
		
	}
	
	$fields = array('_mob_image');
	
	foreach( $fields as $field ) {
		if(isset($_POST[$field])){
			$value = ( $_POST[$field] );
			update_post_meta( $post_id, $field, $value );
		}
	}
	
}


add_action("add_meta_boxes", "add_page_settings_custom_meta_box_sidebar");
add_action("save_post", "save_page_settings_custom_meta_box_sidebar", 10, 3);

function add_page_settings_custom_meta_box_sidebar(){
	add_meta_box("bannerds-meta-box", "Side Bar", "banner_page_settings_box_markup_side", array('page'), "normal", "high", null);
}

function banner_page_settings_box_markup_side($post){
	wp_nonce_field(basename(__FILE__), "page-settings-nonce");
	
	
	$_side_bar_pages = get_post_meta( $post->ID, '_side_bar_pages', true );
	
	get_template_part('inc/upload-scripts');
	
	echo '<style type="text/css"> .page_settings_tbl td, .page_settings th{ padding: 7px 0px; } .page_settings textarea{ width: 25em;} </style>';
	echo '<table width="100%" class="page_settings" style="text-align: left;">';

	echo get_admin_input('editor', '_side_bar_pages', 'Side bar', $_side_bar_pages , '');
	
	
	echo '</table>';
}

function save_page_settings_custom_meta_box_sidebar( $post_id ) {
			
	if (!isset($_POST["page-settings-nonce"]) || !wp_verify_nonce($_POST["page-settings-nonce"], basename(__FILE__)))
        return $post_id;
		
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
	if ( in_array($_POST['post_type'], array('page')) ) {
		
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
			
	} else {
		
		if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;
		
	}
	
	$fields = array('_side_bar_pages');
	
	foreach( $fields as $field ) {
		if(isset($_POST[$field])){
			$value = ( $_POST[$field] );
			update_post_meta( $post_id, $field, $value );
		}
	}
	
}







