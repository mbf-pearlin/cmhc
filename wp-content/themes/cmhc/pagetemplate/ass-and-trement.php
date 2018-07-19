<?php 
   /* Template Name: Assessments & Treatment */ 
   get_header();
   ?>
<?php get_template_part( 'template-parts/page-banner','page-banner');?>
<div class="sub-content tailor-made">
   <!-- Generic content start -->
   <div class="container">
      <div class="row">
         <div class="col-8">
            <?php
               $args = array(
               'numberposts' =>-1,
               'post_type' => 'cpt-assessments',
               
               
               );
               $uses = get_posts($args);
               foreach($uses as $post) {
               setup_postdata($post); ?>
            <h4><?php the_title();?></h4>
            <?php wpautop(the_content()); ?>
            <?php } wp_reset_postdata(); ?>  
         </div>
         <?php $sidebar =get_post_meta(get_the_ID(),'_side_bar_pages',true); 
            if(!empty($sidebar)){
            
            ?>
         <div class="col-4">
            <div class="right-block">
               <div class="right-content">
                  <?php echo wpautop($sidebar); ?>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>
   <!-- Generic content end -->
   <!-- Treated section start -->
   <!-- Treated section start -->
   <!-- help section end here -->
</div>
<?php get_footer(); ?>