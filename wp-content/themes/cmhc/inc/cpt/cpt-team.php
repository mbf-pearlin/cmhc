<?php

if( !class_exists( 'Siteteam' ) ) {
	
	class Siteteam {

		private $post_type = 'cpt-team';
		private $tag 	   = 'site_team';
		
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
				'name'                	=> _x( 'Team', 'Post Type General Name' ),
				'singular_name'       	=> _x( 'Team', 'Post Type Singular Name' ),
				'menu_name'           	=> __( 'Team' ),
				'name_admin_bar'      	=> __( 'Team' ),
				'all_items'           	=> __( 'All Team' ),
				'add_new_item'        	=> __( 'Add New' ),
				'add_new'            	=> __( 'Add New' ),
				'new_item'            	=> __( 'New team' ),
				'edit_item'           	=> __( 'Edit team' ),
				'update_item'         	=> __( 'Update team' ),
				'view_item'           	=> __( 'View team' ),
				'featured_image' 	  	=> __( 'team Image' ),
				'set_featured_image'  	=> __( 'Set team Image' ),
				'remove_featured_image' => __( 'Remove team Image' ),
				'use_featured_image' 	=> __( 'Use team Image' ),
				'search_items'        	=> __( 'Search team' ),
				'not_found'           	=> __( 'No team found' ),
				'not_found_in_trash'  	=> __( 'No team found in Trash' ),
			);

			$args = array(
				'description'         => __( 'Create team' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'thumbnail','page-attributes','editor' ),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'can_export'          => true,
				'query_var'           => true,
				'menu_icon'           => 'dashicons-admin-users',
				'exclude_from_search' => true,
				'publicly_queryable'  => true,
				'rewrite' => array('slug' => 'team'),
				'capability_type'     => 'post',
			);
			
			register_post_type( $this->post_type, $args );
			
		}
		
		
		
		
		
		
		public function add_meta_box() {
			add_meta_box(
				'slider_option'
				,'Team Options'
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
			
			$fields = array( '_designation','_facebook','_twitter','_linkedin');
			
			
		
			
			foreach( $fields as $field ) {
				if( isset($_POST[$field]) ) {
					$value = sanitize_text_field( $_POST[$field] );
					update_post_meta( $post_id, $field, $value );
				}
			}

		}
		
		public function render_meta_box_content( $post ) {
			
			wp_nonce_field( 'slider_inner_custom_box', 'slider_inner_custom_box_nonce' );
			
			$designation = get_post_meta( $post->ID, '_designation', true );
			$facebook = get_post_meta( $post->ID, '_facebook', true );
			$twitter = get_post_meta( $post->ID, '_twitter', true );
			$linkedin = get_post_meta( $post->ID, '_linkedin', true );
			

			echo '<table width="100%" cellpadding="10px">';

			echo '<tr>';
			echo '<td><label for="_designation"><strong>Designation</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_designation" name="_designation" value="' . esc_attr( $designation ) . '" style="width: 100%;" placeholder="Manager"/></td>';
			echo'</tr>';	
			
			
			echo '<tr>';
			echo '<td><label for="_facebook"><strong>FaceBook Url</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_facebook" name="_facebook" value="' . esc_attr( $facebook ) . '" style="width: 100%;" placeholder="https://www.facebook.com/" /></td>';
			echo'</tr>';	
			
			
		    echo '<tr>';
			echo '<td><label for="_twitter"><strong>Twitter Url</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_twitter" name="_twitter" value="' . esc_attr( $twitter ) . '" style="width: 100%;" placeholder="https://twitter.com/login?lang=en" /></td>';
			echo'</tr>';	
			
			
			 echo '<tr>';
			echo '<td><label for="_linkedin"><strong>LinkedIn Url</strong></label></td>';
			echo '<td>:</td>';
			echo '<td><input type="text" id="_linkedin" name="_linkedin" value="' . esc_attr( $linkedin ) . '" style="width: 100%;" placeholder="https://www.linkedin.com/uas/login" /></td>';
			echo'</tr>';	
			
			
			echo '</table>';
			
			
		}
		
	
		public function table_head( $columns ) {
			
			$columns = array(
				"cb"		=> '<input type="checkbox" />',
				"title" 	=> 'Title',
				"image" 	=> 'Team Image',
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
	
	new Siteteam;
}
