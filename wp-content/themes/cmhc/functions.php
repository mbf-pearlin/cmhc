<?php
/**
 *  Theme functions and definitions
 *
 
 */
 
function theme_setup() {

	// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	//add_image_size( 'custom-image', 300, 180, true );

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
	    'left-menu' => __( 'Top Menu', 'cmhc' ),
		'main-menu' => __( 'Main Menu', 'cmhc' ),
		'footer-menu' => __( 'Footer Menu', 'cmhc' ),
		'condition-menu' => __( 'Condition Menu', 'cmhc' ),
				'about-menu' => __( 'About Menu Home Page', 'cmhc' ),
				'mobile-menu' => __( 'Mobile Menu', 'cmhc' ),

	) );
 
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


}
add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Register widget area.
 */
function theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cmhc' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'cmhc' ),
		'before_widget' => '<div id="%1$s" class="col-3 navs">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'cmhc' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'cmhc' ),
		'before_widget' => '<div id="%1$s" class="col-3 navs">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'cmhc' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'cmhc' ),
		'before_widget' => '<div id="%1$s" class="col-3 navs">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

/**
 * Implement custom functions for the site.
 */
require get_parent_theme_file_path( '/inc/additional_functions.php' );

/**
 * Implement Site Settings
 */
require get_parent_theme_file_path( '/inc/site_settings.php' );

/**
 * Implement CPT
 */
require get_parent_theme_file_path( '/inc/cpt/cpt-assessments.php' );
require get_parent_theme_file_path( '/inc/cpt/cpt-help.php' );
require get_parent_theme_file_path( '/inc/cpt/cpt-treatmets.php' );
require get_parent_theme_file_path( '/inc/cpt/cpt-slider.php' );
require get_parent_theme_file_path( '/inc/cpt/cpt-testimonial.php' );
require get_parent_theme_file_path( '/inc/cpt/cpt-conditions.php' );
require get_parent_theme_file_path( '/inc/cpt/cpt-team.php' );
require get_parent_theme_file_path( '/inc/cpt/faq.php' );


/**
 * Implement Resources
 */
require get_parent_theme_file_path( '/inc/meta-box.php' );

include('inc/contact_list.php');
include('inc/booking_list.php'); 
include_once('inc/shortcodes.php');


 
 
/**
 * Enqueue scripts and styles.
 */
function theme_scripts() {

	/*** CSS ***/
	wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/css/app.css', array(), NULL );
	wp_enqueue_style( 'jquery.datepicker', get_template_directory_uri() . '/assets/css/jquery.datepicker.css', array(), NULL );


	/*** Js ***/

    wp_enqueue_script( 'jquery-new', get_theme_file_uri( '/assets/js/jquery-2.2.0.min.js' ), array( 'jquery' ), NULL, true );

   
    wp_enqueue_script( 'wow', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'app', get_theme_file_uri( '/assets/js/app.js' ), array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'swiper', get_theme_file_uri( '/assets/js/swiper.min.js' ), array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'nprogress', get_theme_file_uri( '/assets/js/nprogress.min.js' ), array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'jquery.datepicker', get_theme_file_uri( '/assets/js/jquery.datepicker.js' ), array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'custom', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), NULL, true );
  
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	
	$logged_in = ( is_user_logged_in() ? 1 : 0 );
	$data = array(
		'ajaxurl'		=> admin_url('admin-ajax.php'),
		'logged_in' 	=> $logged_in,
		'site_url'		=> site_url(),
		'dir_url'		=> get_stylesheet_directory_uri(),
		'subsc_url' 	=> site_url().'/?es=subscribe',
		'site_name'		=> get_bloginfo('blogname'),
		'logo_url'		=> (get_option('site_logo')!='') ? get_option('site_logo') : get_bloginfo('template_directory').'/images/logo.png',
	);
	wp_localize_script( 'validate-booking', 'scriptVars', $data );

}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );


