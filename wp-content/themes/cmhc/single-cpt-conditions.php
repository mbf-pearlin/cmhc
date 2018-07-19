<?php get_header(); 

	global $post;
	if(is_home()){
		$id = get_option('page_for_posts');
	} 
	else{
		$id = get_the_id();	
	}
?>
  <?php get_template_part( 'template-parts/page-banner','page-banner');?>

<div class="sub-content tailor-made">
   <!-- Generic content start -->
   <div class="container">
      <div class="row">
         <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();
            
            	?>
         <div class="col-8">
            <?php wpautop(the_content()); ?>
         </div>
         <div class="col-4">
            <div class="right-block">
                  <?php 
                     if ( has_post_thumbnail() ) { ?>
               <div class="right-pic">
                  <img src="<?php the_post_thumbnail_url('full');?>"/>
               </div>
                  <?php
                     } ?>
                <?php 
                  $side= get_post_meta(get_the_ID(),'_side_content',true);
        
                  if($side != "") {
              ?>
               <div class="right-content">
                     <?php
                     echo  wpautop(get_post_meta(get_the_ID(),'_side_content',true));
                     ?>
               </div>
                  <?php } ?>
            </div>
         </div>
      </div>
      <?php	endwhile; // End of the loop.
         ?>
   </div>
   <!-- Generic content end -->
   <!-- Treated section start -->
  <?php 
  $treatment= get_post_meta(get_the_ID(),'_how_is_treated',true);
  
  if($treatment != "") {
    ?>
   <div class="content-bg">
      <div class="container">
         <div class="row">
            <div class="col-8">
				<div class="list-box">
				<div class="bullet">
               <?php
                  echo  wpautop(get_post_meta(get_the_ID(),'_how_is_treated',true));
                  
                  
                  ?>
                  </div>                  
                  </div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <!-- Treated section start -->
   <!-- help section start here -->
   <?php /* ?>
   <div class="help-section">
      <div class="container">
         <div class="row button-diraction">
            <div class="col-4 help-content">
               <h4>Talk to us in confidence</h4>
            </div>
            <div class="col-4">
               <a href="<?php echo get_option('con_button_link'); ?>" class="button button-primary"><?php echo get_option('con_button_text'); ?></a>
            </div>
            <div class="col-4">
               <a href="<?php echo site_url(); ?>/book-an-appoinment/?booking_id=<?php echo $id; ?>" class="button"><?php echo get_option('app_button_text'); ?></a>
            </div>
         </div>
      </div>
   </div>
   <?php */ ?>
   <!-- help section end here -->
</div>


			
<?php get_footer(); ?>
