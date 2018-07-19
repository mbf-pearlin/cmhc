<?php

if( !class_exists( 'SiteTestimonial' ) ) {
	
	class SiteTestimonial {

		private $post_type = 'cpt-testimonial';
		private $tag 	   = 'site_testimonial';
		
		public function __construct() {
			
			add_action( 'init', array( $this, 'register') );
			
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box') );
			add_action( 'save_post', array( $this, 'save') );
			add_action( 'manage_'.$this->post_type.'_posts_columns', array( $this, 'table_head') );
			add_filter( 'manage_'.$this->post_type.'_posts_custom_column', array( $this, 'table_content') );
			add_shortcode( $this->tag, array( $this, 'shortcode' ) );
		}
		
		public function register() {
			
			$labels = array(
				'name'                	=> _x( 'Testimonial', 'Post Type General Name' ),
				'singular_name'       	=> _x( 'Testimonial', 'Post Type Singular Name' ),
				'menu_name'           	=> __( 'Testimonial' ),
				'name_admin_bar'      	=> __( 'Testimonial' ),
				'all_items'           	=> __( 'Testimonial' ),
				'add_new_item'        	=> __( 'Add New' ),
				'add_new'            	=> __( 'Add New' ),
				'new_item'            	=> __( 'New Testimonial' ),
				'edit_item'           	=> __( 'Edit Testimonial' ),
				'update_item'         	=> __( 'Update Testimonial' ),
				'view_item'           	=> __( 'View Testimonial' ),
				'featured_image' 	  	=> __( 'Testimonial Image' ),
				'set_featured_image'  	=> __( 'Set Testimonial Image' ),
				'remove_featured_image' => __( 'Remove Testimonial Image' ),
				'use_featured_image' 	=> __( 'Use Testimonial Image' ),
				'search_items'        	=> __( 'Search Testimonial' ),
				'not_found'           	=> __( 'No Testimonial found' ),
				'not_found_in_trash'  	=> __( 'No Testimonial found in Trash' ),
			);

			$args = array(
				'description'         => __( 'Create Testimonial' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail', 'editor','page-attributes' ),
				'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'can_export'          => true,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-editor-quote',
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'capability_type'     => 'post',
			);
			
			register_post_type( $this->post_type, $args );
			
		}
		
		
		
		public function add_meta_box() {
			add_meta_box(
				'slider_option'
				,'Testimonial Options'
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
			
			$fields = array( '_authour_btn_text','_testimonial');
			
			foreach( $fields as $field ) {
				if( isset($_POST[$field]) ) {
					$value = sanitize_text_field( $_POST[$field] );
					update_post_meta( $post_id, $field, $value );
				}
			}

		}
		
		public function render_meta_box_content( $post ) {
			
			wp_nonce_field( 'slider_inner_custom_box', 'slider_inner_custom_box_nonce' );
			
			$slider_btn_text = get_post_meta( $post->ID, '_authour_btn_text', true );
			$color = get_post_meta( $post->ID, '_testimonial', true );
			

			echo '<table width="100%" cellpadding="10px">';

			echo '<tr>';
			echo '<td><label for="slider_btn_text"><strong>Role</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_authour_btn_text" name="_authour_btn_text" value="' . esc_attr( $slider_btn_text ) . '" style="width: 100%;"/></td>';
			echo'</tr>';	
			
			
			
			echo '<tr>';
			echo '<td><label for="slider_btn_text"><strong>Color</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_testimonial" name="_testimonial" value="' . esc_attr( $color ) . '" style="width: 100%;"/></td>';
			echo'</tr>';	
			
			echo '</table>';
			
			
		}
		
		
		
		
		
		
	
		public function table_head( $columns ) {
			
			$columns = array(
				"cb"		=> '<input type="checkbox" />',
				"title" 	=> 'Title',
				"image" 	=> 'Testimonial Image',
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
	}
	
	new SiteTestimonial;
}
