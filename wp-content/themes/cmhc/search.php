<?php
/**
 * The template for displaying search results pages
 *
 */

get_header(); ?>
<style>
.page-numbers {
	display: inline-block;
	padding: 5px 10px;
	margin: 0 2px 0 0;
	border: 1px solid #eee;
	line-height: 1;
	text-decoration: none;
	border-radius: 2px;
	font-weight: 600;
}
.page-numbers.current,
a.page-numbers:hover {
background: #0E4D82;
    color: #fff;
}
</style>
  <?php get_template_part( 'template-parts/page-banner','page-banner');?>



<div class="section">
   <div class="container">
      <!-- paragraph styles -->
      <div class="row">
         <div class="col-12">
           <?php //printf( __( 'Search Results for: %s' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
       

       <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h4><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h4>
		<?php 
		$search_content=get_post_meta( $post->ID, '_search_content', true ); 
		if($search_content ==""){
		the_excerpt();
		}
		else
		{
		echo $search_content; 
		}
		?>  
    <?php endwhile; 

    the_posts_pagination( array(
                'prev_text'          => __( '&laquo;', 'cmhc' ),
                'next_text'          => __( '&raquo;', 'cmhc' ),
                'before_page_number' => '',
                'screen_reader_text' => ' '
            ) );



    else: ?>
  			<p><?php _e('Sorry, no posts matched your criteria.', 'studiopress'); ?></p><?php endif; ?>
         </div>
       
      </div>

   </div>
</div>


      

<?php get_footer(); ?>

