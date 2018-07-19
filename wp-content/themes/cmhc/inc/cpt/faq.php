<?php

if( !class_exists( 'SiteFaq' ) ) {
	
	class SiteFaq {

		private $post_type = 'cpt-faq';
		
		public function __construct() {
			
			add_action( 'init', array( $this, 'register') );
			//add_action( 'add_meta_boxes', array( $this, 'add_meta_box') );
			add_action( 'save_post', array( $this, 'save') );
			add_action( 'manage_'.$this->post_type.'_posts_columns', array( $this, 'table_head') );
			add_filter( 'manage_'.$this->post_type.'_posts_custom_column', array( $this, 'table_content') );
		}
		
		public function register() {
			
			$labels = array(
				'name'                	=> _x( 'Accordion', 'Post Type General Name' ),
				'singular_name'       	=> _x( 'Accordion', 'Post Type Singular Name' ),
				'menu_name'           	=> __( 'Accordion' ),
				'name_admin_bar'      	=> __( 'Accordion' ),
				'all_items'           	=> __( 'All Accordion' ),
				'add_new_item'        	=> __( 'Add New Accordion' ),
				'add_new'            	=> __( 'Add New' ),
				'new_item'            	=> __( 'New Accordion' ),
				'edit_item'           	=> __( 'Edit Accordion' ),
				'update_item'         	=> __( 'Update Accordion' ),
				'view_item'           	=> __( 'View Accordion' ),
				'featured_image' 	  	=> __( 'Accordion Image' ),
				'set_featured_image'  	=> __( 'Set Accordion Image' ),
				'remove_featured_image' => __( 'Remove Accordion Image' ),
				'use_featured_image' 	=> __( 'Use Accordion Image' ),
				'search_items'        	=> __( 'Search Accordion' ),
				'not_found'           	=> __( 'No Accordion found' ),
				'not_found_in_trash'  	=> __( 'No Accordion found in trash' ),
			);

			$args = array(
				'description'         => __( 'Create Accordion' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor',  'page-attributes' ),
				'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'can_export'          => true,
				'query_var'           => true,
				'rewrite' 			  => array('slug' => 'advertisement'),
				'menu_icon'           => 'dashicons-editor-help',
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'capability_type'     => 'post',
			);
			
			register_post_type( $this->post_type, $args );





   register_taxonomy('cpt-faq-cat',array('cpt-faq'), array(
    'hierarchical' => true,
    'labels' => array(
         'name' => _x( 'Category', 'taxonomy general name' ),
         'singular_name' => _x( 'cpt-faq Category', 'taxonomy singular name' ),
         'search_items' =>  __( 'Search Categories' ),
         'all_items' => __( 'All Categories' ),
         'parent_item' => __( 'Parent Categories' ),
         'parent_item_colon' => __( 'Parent Category:' ),
         'edit_item' => __( 'Edit Category' ), 
         'update_item' => __( 'Update Category' ),
         'add_new_item' => __( 'Add New Category' ),
         'new_item_name' => __( 'New Category Name' ),
         'menu_name' => __( 'Categories' ),
       ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cpt-faq' ),
  ));


           












			
		}
		

		
		public function save( $post_id ) {
			
			if ( !isset($_POST['ads_inner_custom_box_nonce']) )
				return $post_id;
			
			$nonce = $_POST['ads_inner_custom_box_nonce'];
			
			if ( !wp_verify_nonce( $nonce, 'ads_inner_custom_box' ) )
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

		
		}
		
	
		
		public function table_head( $columns ) {
			
			$columns = array(
				"cb"		=> '<input type="checkbox" />',
				"title" 	=> 'Title',
				//"content" 	=> 'content',
				"category" 	=> 'Category',
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

              
				

				case "category":

$directors = get_the_terms($post->ID ,'cpt-faq-cat');
foreach($directors as $director){
    $director_name = $director->name;
    $director_desc = $director->description;
}

					echo $director_name;
				break;

              case "order":



					echo $post->menu_order;
				break;


			}
		}
		
	}
	
	new SiteFaq;
}
