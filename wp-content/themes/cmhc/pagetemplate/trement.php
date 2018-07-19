<?php 
   /* Template Name:  Treatment */ 
   get_header();
   ?>
<?php get_template_part( 'template-parts/page-banner','page-banner');?>
<div class="sub-content tailor-made">
   <div class="container">
      <div class="row">
         <div class="col-8">
            <?php
               $args = array(
               'numberposts' =>-1,
               'post_type' => 'cpt-treatmets',
               
               
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

</div>
<?php get_footer(); ?>