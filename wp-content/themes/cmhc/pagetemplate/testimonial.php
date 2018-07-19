<?php 
   get_header();
   ?>
<div class="testimonial">
   <!-- sub header Start -->
   <div class="intro-banner">
      <div class="container">
         <div class="row">
            <div class="col-8">
               <!-- bread-crumb start-->
               <?php site_breadcrumbs(); ?>
               <!-- bread-crumb end-->
               <h1><?php echo get_post_meta(get_the_ID(), '_banner_title', true); ?></h1>
               <div class="intro">
                  <p><?php echo get_post_meta(get_the_ID(), '_banner_content', true); ?></p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- sub header end -->
   <div class="sub-content">
      <!-- Team section start -->
      <div class="testimonial-section">
         <div class="container">
            <div id="grid" class="clearfix">
               <?php
                  $defaultslider=get_option('slider_default_image') ;
                  $args = array(
                  'numberposts' =>-1,
                  'post_type' => 'cpt-testimonial',
                     'orderby' => 'menu_order', 
                  'order' => 'ASC', 
                  );
                  $testimonialimage = get_posts($args);
                  foreach($testimonialimage as $post) {
                  setup_postdata($post); 
                  //$button_text=get_post_meta( $post->ID,'_slider_btn_text', true ); 
                  
                  $testimonialimage= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
                  
                  ?>
               <div class="cards test">
                  <div class="cards-<?php echo get_post_meta(get_the_ID(), "_testimonial", true); ?> cards-bgcolor">
                     <p><?php the_content(); ?></p>
                     <div class="info">
                        <?php if($testimonialimage != ""){ ?>
                        <img src="<?php echo  $testimonialimage[0] ; ?>" alt=""/>
                        <?php } ?>
                        <div class="info-content">
                           <h5><?php the_title(); ?></h5>
                           <p> <?php echo get_post_meta(get_the_ID(), "_authour_btn_text", true); ?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } wp_reset_postdata(); ?>
            </div>
            <!---<div class="button-row">
               <a href="#" class="button">Read More</a>
               </div>-->
         </div>
      </div>
      <!-- Team section end -->
   </div>
</div>
<?php get_footer(); ?>