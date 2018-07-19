<?php

if( !class_exists( 'SiteSlider' ) ) {
	
	class SiteSlider {

		private $post_type = 'cpt-slider';
		private $tag 	   = 'site_slider';
		
		public function __construct() {
			
			add_action( 'init', array( $this, 'register') );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box') );
			add_action( 'save_post', array( $this, 'save') );
			add_action( 'manage_'.$this->post_type.'_posts_columns', array( $this, 'table_head') );
			add_filter( 'manage_'.$this->post_type.'_posts_custom_column', array( $this, 'table_content') );
			add_action( 'wp_head',  array( $this,'add_custom_slider_options'), 8 );
			add_shortcode( $this->tag, array( $this, 'shortcode' ) );
		}
		
		public function register() {
			
			$labels = array(
				'name'                	=> _x( 'Banner Sliders', 'Post Type General Name' ),
				'singular_name'       	=> _x( 'Banner Slider', 'Post Type Singular Name' ),
				'menu_name'           	=> __( 'Banner Sliders' ),
				'name_admin_bar'      	=> __( 'Banner Slider' ),
				'all_items'           	=> __( 'All Sliders' ),
				'add_new_item'        	=> __( 'Add New Slider' ),
				'add_new'            	=> __( 'Add New' ),
				'new_item'            	=> __( 'New Slider' ),
				'edit_item'           	=> __( 'Edit Slider' ),
				'update_item'         	=> __( 'Update Slider' ),
				'view_item'           	=> __( 'View Slider' ),
				'featured_image' 	  	=> __( 'Slider Image' ),
				'set_featured_image'  	=> __( 'Set Slider Image' ),
				'remove_featured_image' => __( 'Remove Slider Image' ),
				'use_featured_image' 	=> __( 'Use Slider Image' ),
				'search_items'        	=> __( 'Search Slider' ),
				'not_found'           	=> __( 'No sliders found' ),
				'not_found_in_trash'  	=> __( 'No sliders found in Trash' ),
			);

			$args = array(
				'description'         => __( 'Create banner slider in home page' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
				'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'can_export'          => true,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-images-alt',
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'capability_type'     => 'post',
			);
			
			register_post_type( $this->post_type, $args );
			
		}
		
		public function add_meta_box() {
			add_meta_box(
				'slider_option'
				,'Slider Options'
				,array( $this, 'render_meta_box_content' )
				,$this->post_type
				,'advanced'
				,'high'
			);
		}
		
		public function save( $post_id ) {
			
			if ( !isset($_POST['slider_inner_custom_box_nonce']) )
				return $post_id;
			
			$nonce = $_POST['slider_inner_custom_box_nonce'];
			
			if ( !wp_verify_nonce( $nonce, 'slider_inner_custom_box' ) )
				return $post_id;
				
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return $post_id;
				
			if ( $this->post_type == $_POST['post_type'] ) {
				
				if ( !current_user_can( 'edit_page', $post_id ) )
					return $post_id;
					
			} else {
				
				if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
				
			}
			
			$fields = array( '_slider_btn_text', '_slider_btn_url', '_slider_target' );
			
			foreach( $fields as $field ) {
				if( isset($_POST[$field]) ) {
					$value = sanitize_text_field( $_POST[$field] );
					update_post_meta( $post_id, $field, $value );
				}
			}

		}
		
		public function render_meta_box_content( $post ) {
			
			wp_nonce_field( 'slider_inner_custom_box', 'slider_inner_custom_box_nonce' );
			
			$slider_btn_text = get_post_meta( $post->ID, '_slider_btn_text', true );
			$slider_btn_url  = get_post_meta( $post->ID, '_slider_btn_url', true );
			$slider_target   = get_post_meta( $post->ID, '_slider_target', true );

			echo '<table width="100%" cellpadding="10px">';

			echo '<tr>';
			echo '<td><label for="slider_btn_text"><strong>Button Text</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="slider_btn_text" name="_slider_btn_text" value="' . esc_attr( $slider_btn_text ) . '" style="width: 100%;"/></td>';
			echo'</tr>';
			
			echo '<tr>';
			echo '<td><label for="slider_btn_url"><strong>Button Link</strong></label><div>(<i>Please enter URL with http://</i>)</div></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="slider_btn_url" name="_slider_btn_url" style="width: 100%;" value="' . esc_attr( $slider_btn_url ) . '" /></td>';
			echo'</tr>';
			
			echo '<td><label for="slider_target"><strong>Link Target</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><select name="_slider_target" id="slider_target">';
			echo '<option value="_self" '.(($slider_target=='_self') ? "selected='selected'" : "").'>Same Tab</option>';
			echo '<option value="_blank" '.(($slider_target=='_blank') ? "selected='selected'" : "").'>New Tab</option>';
			echo '</select></td>';
			
			echo '</table>';
			
			
		}
		
	
		
		public function table_head( $columns ) {
			
			$columns = array(
				"cb"		=> '<input type="checkbox" />',
				"title" 	=> 'Title',
				"image" 	=> 'Slider Image',
				"order" 	=> 'Order',
				"date" 		=> 'Date'
			);
			
			return $columns;
			
		}
		
		function table_content( $column ) {
			global $post;

			switch( $column ) {
				case "image":
				if( has_post_thumbnail( $post->ID ) ) {
					the_post_thumbnail(array('75', '75'));
				}
				break;

				case "order":
					echo $post->menu_order;
				break;
			}
		}
		
		public function slider_array(){
			$sliders = array();
			$num_of_slides = get_option( 'num_of_slides' );
			
			$args = array(
				'post_type' 		=> $this->post_type,
				'post_status' 		=> 'publish',
				'posts_per_page' 	=> -1,
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC',
				'meta_key'			=> '_thumbnail_id'
			);

			$sliders = get_posts( $args );

			return $sliders;
		}

		public function add_custom_slider_options(){
			$options = array(
				'speed'     	=> (get_option('slider_speed')!='') ? get_option('slider_speed') : 1000,
				'pause'     	=> (get_option('slider_pause')!='') ? get_option('slider_pause') : 4000,
				'autoplay'		=> (get_option('slider_auto_play')=='0') ? false : true,
				'pager'     	=> (get_option('slider_pager')=='0') ? false : true,
			);
			$output="<script> var slider=". wp_json_encode( $options ) ." </script>";
			echo $output;
		}
		
		public function shortcode( $atts, $content = null ) {

			ob_start();

			$this->show_sliders();
			
			return ob_get_clean();
		}
		
		public function show_sliders() {
			
			global $post;

			$sliders = $this->slider_array();

			if( count( $sliders ) > 0 ) {
				echo '<ul class="main-slider">';
				foreach( $sliders as $post ) {
					setup_postdata( $post );

					$img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
					$btn_text = get_post_meta( $post->ID, '_slider_btn_text', true );
					$btn_url = ( get_post_meta( $post->ID, '_slider_btn_url', true )!='' ) ? get_post_meta( $post->ID, '_slider_btn_url', true ) : 'javascript:void(0);';
					$target = ( get_post_meta( $post->ID, '_slider_target', true )=='1') ? '_blank' : '_self';
			?>	
					<li>
                        <img src="<?php echo $img;?>" alt="" />
                        <div class="hban_info">
                            <?php the_content();?>
                            <?php 
                                if( $btn_text!='' ){
	                               echo '<div class="hbtn_sec"><a class="btn btn1" target="'. $target .'" href="'.$btn_url.'">'. $btn_text .'</a></div>';
                                }
                            ?>
                        </div>
                    </li>
			<?php
				}
				wp_reset_postdata();
				echo '</ul>';
			 } else { 
				if( get_option('slider_default_image')!='' ){
					echo '<div class="no-slider"><img src="'.get_option('slider_default_image').'" alt="no-slider" /></div>';
				}
			}
		}
	}
	
	new SiteSlider;
}
