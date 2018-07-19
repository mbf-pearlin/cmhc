<?php

    // create custom plugin settings menu
    add_action('admin_menu', 'site_create_content');
	function site_create_content() {
		$themepage = add_theme_page('Site Settings', 'Site Settings', 'administrator','common-settings', 'site_settings_form');
		
		//call register settings function
		add_action( 'admin_init', 'register_site_settings' );
		add_action('admin_print_styles-' . $themepage, 'site_settings_admin_styles');
	}
	function register_site_settings(){
		$settings_val = array( 'site_logo','sticky_logo','mobile_logo','site_favicon', 'footer_copy',   'ss_linkedIn','ss_youtube','ss_facebook', 'ss_twitter','ss_mail','ss_hours','banner_default', 'ft_email','ft_callus','ft_sclshar','ft_form','ss_abt-sub-tit','ss_contact','partnerslogo1','partnerslogo2','partnerslogo3','partnerslogo4','ss_abt','ss_abt-tit','ss_testi-tit','ss_abt_image','ss_abt','tours_title','pop_dess','new_dess_','new_dess_sub','ss_dollor','to_mail','from_email','offers_title','offers_text','offers_pdf_english','offers_pdf_chinese','offers_image','conditions_sub_title','conditions_title','assessments_title','assessments_sub_title','treatmets_title','treatmets_sub_title','resource_title','resource_content','resource_button_text','resource_button_link','footer_content','con_button_title','con_button_text','con_button_link','app_button_text','app_button_link','contact_us_email','ss_abt_one','ss_abt_image_link','Sidebar_ass','Sidebar_tre'
);
			
		foreach($settings_val as $set )
			register_setting( 'common-settings-group', $set );
	}  

	function site_settings_admin_styles(){
		wp_enqueue_style('jquery-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style('farbtastic');
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_style('thickbox');
		//wp_enqueue_script('jquery');
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
	}

	function site_settings_form(){
		get_template_part('inc/upload-scripts');
		
?>
		<div class="wrap">
		<p style="text-align: center;"><img src="<?php echo get_option('site_logo'); ?>" style="text-align: center;height: 83px!important;"></p>
			<form class="site-setting-form" method="post" id="point-settings" name="common-settings" action="options.php">
				<?php settings_fields('common-settings-group');?>
					<div class="settings-container">
						<ul class='k2b-tabs'>
							
							<li><a href="#k2b-tab1"><span class="dashicons dashicons-admin-generic"></span> Common Settings</a></li>
							<li><a href="#k2b-tab2"><span class="dashicons dashicons-admin-home"></span> Home Page</a></li>
					 		<li><a href="#k2b-tab4"><span class="dashicons dashicons-location"></span> Contact Details</a></li>
					 	    

							<li><a href="#k2b-tab8"><span class="dashicons dashicons-welcome-widgets-menus"></span> Footer Settings</a></li>
							
						</ul>
						<div class="set_tab">
		
						<div id="k2b-tab1" class="tab-wrapper">
						   	<h2>Common Settings</h2>
							<table class="form-table">
								<?php		 
								  //echo get_admin_input('up_image', 'site_favicon', 'Favicon', get_option('site_favicon'), '');
									echo get_admin_input('up_image', 'site_logo', 'Site Logo', get_option('site_logo'), '');
									echo get_admin_input('up_image', 'banner_default', 'Default Banner', get_option('banner_default'), '');
								
									 
								?>
						  	</table>  							  	
						</div>
						
						

							
						
						<div id="k2b-tab2" class="tab-wrapper">
						  <h2>Talk to us in confidence</h2>
						  <i>Contact Us Button</i>
							<table class="form-table">
								<?php		 
								echo get_admin_input('text', 'con_button_title', 'Title', get_option('con_button_title'), '');	   
								echo get_admin_input('text', 'con_button_text', 'Button Text', get_option('con_button_text'), '');	   
								echo get_admin_input('text', 'con_button_link', 'Button Link', get_option('con_button_link'), '');	  

								?>
						  	</table> 
						  	
						  	 <i>Appoiment Button<i>
							<table class="form-table">
								<?php		 
								echo get_admin_input('text', 'app_button_text', 'Button Text', get_option('app_button_text'), '');	   
								echo get_admin_input('text', 'app_button_link', 'Button Link', get_option('app_button_link'), '');	  

								?>
						  	</table> 
						  	
						  	<hr/>
							
							<h2>About Us</h2>
							<table class="form-table">
								<?php		 
								 // echo get_admin_input('text', 'ss_abt-tit', 'Title', get_option('ss_abt-tit'), '');
								  echo get_admin_input('text', 'ss_abt-sub-tit', 'Sub Title', get_option('ss_abt-sub-tit'), '');
								  echo get_admin_input('editor', 'ss_abt', 'Content One', get_option('ss_abt'), '');
								 // echo get_admin_input('editor', 'ss_abt_one', 'Content Two', get_option('ss_abt_one'), '');
								 // echo get_admin_input('up_image', 'ss_abt_image', 'Background Image', get_option('ss_abt_image'), '');
								 // echo get_admin_input('text', 'ss_abt_image_link', 'Image Link', get_option('ss_abt_image_link'), '');
								
									 
									 
								?>
						  	</table> 
						  	<hr/>
						  	
						

						  	
						  	<h2>Assessments & Treatmets Section</h2>
							<table class="form-table">
								<?php		 
								echo get_admin_input('text', 'assessments_title', 'Title', get_option('assessments_title'), '');	   
								echo get_admin_input('text', 'assessments_sub_title', 'Sub Title', get_option('assessments_sub_title'), '');	   
								?>
						  	</table>
						  	
						  	<hr/>
						  	
						  	
						   <h2>Resource Section</h2>
							<table class="form-table">
								<?php	                                
								echo get_admin_input('text', 'resource_title', 'Title', get_option('resource_title'), '');	   
								//echo get_admin_input('editor', 'resource_content', 'Content', get_option('resource_content'), '');	   
								//echo get_admin_input('text', 'resource_button_text', 'Button Text', get_option('resource_button_text'), '');	   
								//echo get_admin_input('text', 'resource_button_link', 'Button Link', get_option('resource_button_link'), '');	   
								?>
						  	</table> 
						   
						 						  	
						</div>
						
						<div id="k2b-tab4" class="tab-wrapper">
							<h2>Contact Details</h2>

						   	<table class="form-table">
								<?php
									
									
							 echo get_admin_input('text', 'ss_mail', 'Mail', get_option('ss_mail'), '');
							 echo get_admin_input('text', 'ss_hours', 'Call Us', get_option('ss_hours'), '');
							 echo get_admin_input('textarea', 'ss_contact', 'Address', get_option('ss_contact'), '');
							 echo get_admin_input('text', 'from_email', 'Footer Email', get_option('from_email'), '');
							 echo get_admin_input('text', 'contact_us_email', 'From Email', get_option('contact_us_email'), '');
																 
								
								?>
						  	</table>
							</div>
						
							 
					
						
					  	
									
						<div id="k2b-tab8" class="tab-wrapper">
							<h2>Footer Settings</h2>
							<table class="form-table">
								 <?php
								//echo get_admin_input('editor', 'footer_copy', 'Footer Copyright Text', get_option('footer_copy'), '');
								echo get_admin_input('editor', 'footer_content', 'Footer Contact Us Form Content', get_option('footer_content'), '');
									?>
							</table>
						</div>
						
						</div>

						<br/>
					  	<p class="submit" style=" text-align: center;"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" name="submit-settings" /></p>
				</div><!-- settings-container -->		
			</form>
		</div><!-- wrap -->
<?php }?>
