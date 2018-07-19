<?php get_header(); ?>
<style type="text/css">.misha_loadmore{
	background-color: #ddd;
	border-radius: 2px;
	display: block;
	text-align: center;
	font-size: 14px;
	font-size: 0.875rem;
	font-weight: 800;
	letter-spacing:1px;
	cursor:pointer;
	text-transform: uppercase;
	padding: 10px 0;
	transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.3s ease-in-out;  
}
.misha_loadmore:hover{
	background-color: #767676;
	color: #fff;
}</style>
<div class="wrap">
	

	<div id="primary" class="content-area">
		
		<?php
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => '1',
		//'paged' => 1,
	);
	$my_posts = new WP_Query( $args );
	if ( $my_posts->have_posts() ) :
	  while ( $my_posts->have_posts() ) : $my_posts->the_post();

the_title();

the_content();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */

				endwhile;

		


			

			endif;
			?>

<?php
global $wp_query; // you can remove this line if everything works for you
 
// don't display the button if there are not enough posts
if (  $my_posts->max_num_pages > 1 )
	echo '<div class="misha_loadmore button">More posts</div>'; // you can use <a> as well
?>
</div><!-- .wrap -->

<?php get_footer();
