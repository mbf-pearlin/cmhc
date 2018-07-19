<?php

if( !class_exists( 'Sitetreatmets' ) ) {
	
	class Sitetreatmets {

		private $post_type = 'cpt-treatmets';
		private $tag 	   = 'site_treatmets';
		
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
				'name'                	=> _x( 'Treatments', 'Post Type General Name' ),
				'singular_name'       	=> _x( 'Treatments', 'Post Type Singular Name' ),
				'menu_name'           	=> __( 'Treatments' ),
				'name_admin_bar'      	=> __( 'Treatments' ),
				'all_items'           	=> __( 'All Treatments' ),
				'add_new_item'        	=> __( 'Add New' ),
				'add_new'            	=> __( 'Add New' ),
				'new_item'            	=> __( 'New Treatments' ),
				'edit_item'           	=> __( 'Edit Treatments' ),
				'update_item'         	=> __( 'Update Treatments' ),
				'view_item'           	=> __( 'View Treatments' ),
				'featured_image' 	  	=> __( 'Treatments Image' ),
				'set_featured_image'  	=> __( 'Set Treatments Image' ),
				'remove_featured_image' => __( 'Remove Treatments Image' ),
				'use_featured_image' 	=> __( 'Use Treatments Image' ),
				'search_items'        	=> __( 'Search Treatments' ),
				'not_found'           	=> __( 'No Treatments found' ),
				'not_found_in_trash'  	=> __( 'No Treatments found in Trash' ),
			);   

			$args = array(
				'description'         => __( 'Create treatmets' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail','page-attributes','editor' ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'can_export'          => true,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-admin-tools',
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
			);
			
			register_post_type( $this->post_type, $args );
			
		}
		
		
		
		
		
		
		public function add_meta_box() {
			add_meta_box(
				'slider_option'
				,'Treatmets Options'
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
			
			$fields = array( '_treatmets_btn_text');
			
			foreach( $fields as $field ) {
				if( isset($_POST[$field]) ) {
					$value = sanitize_text_field( $_POST[$field] );
					update_post_meta( $post_id, $field, $value );
				}
			}

		}
		
		public function render_meta_box_content( $post ) {
			
			wp_nonce_field( 'slider_inner_custom_box', 'slider_inner_custom_box_nonce' );
			
			$slider_btn_text = get_post_meta( $post->ID, '_treatmets_btn_text', true );
			

			echo '<table width="100%" cellpadding="10px">';

			echo '<tr>';
			echo '<td><label for="slider_btn_text"><strong>Tab Title</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_treatmets_btn_text" name="_treatmets_btn_text" value="' . esc_attr( $slider_btn_text ) . '" style="width: 100%;"/></td>';
			echo'</tr>';	
			echo '</table>';
			
			
		}
		
	
		public function table_head( $columns ) {
			
			$columns = array(
				"cb"		=> '<input type="checkbox" />',
				"title" 	=> 'Title',
				"image" 	=> 'Image',
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
	
	new Sitetreatmets;
}
