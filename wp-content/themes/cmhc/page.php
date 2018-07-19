<?php get_header(); ?>
<?php get_template_part( 'template-parts/page-banner','page-banner');?>
 <?php 
      if( is_page( array( 'resources','appointment-faq','payment-and-cancellations','our-policies','privacy-policy-web' ) ))
      {   
      ?>
<div class="sub-content">
    <?php } else {
         ?>
      <div class="sub-content tailor-made">
         <?php }
            ?>
<div class="container">

   <?php 
      if( is_page( array( 'resources','appointment-faq','payment-and-cancellations' ) ))
      {   
      ?>
   <div class="row">
      <?php } else {
         ?>
      <!--<div class="row conditions-row">-->

               <div class="row">

         <?php }
            ?>
         <div class="col-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php   echo wpautop(the_content());?>
            <?php endwhile; else: ?>
            <?php endif; ?>  
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
<?php get_footer('inner'); ?>