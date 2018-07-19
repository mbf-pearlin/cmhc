<?php 
   /* Template Name: Team */ 
   get_header();
   ?>
<div class="team">
   <!-- sub header Start -->
   <div class="intro-banner">
      <div class="container">
         <div class="row">
            <div class="col-8">
               <!-- bread-crumb start-->
               <?php site_breadcrumbs(); ?>
               <!-- bread-crumb end-->
               <h1>
                  <?php echo get_post_meta(get_the_ID(), '_banner_title', true); ?>
               </h1>
               <div class="intro">
                  <p>
                     <?php echo get_post_meta(get_the_ID(), '_banner_content', true); ?>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- sub header end -->
   <!-- Team section start -->



<div class="condition-team">
               <!-- Generic content start -->
               <div class="container">
                  <div class="row ">
                     <div class="col-6">
                        <div class=" accordion-row team-accordin">

                              <?php
                              $args = array(
                              'numberposts' =>-1,
                              'post_type' => 'cpt-team',


                              );
                              $count=1;
                              $uses = get_posts($args);
                              foreach($uses as $post) {
                              setup_postdata($post); 

                              //print_r($count);


                              ?>


                           <a href="<?php the_permalink(); ?>" class="accordion-row-blk">
                              <h6><?php the_title();?></h6>
                           </a>
                           <?php  } wp_reset_postdata(); ?>  

                        </div>
                     </div>

                  </div>
               </div>
               <!-- Generic content end -->
               </div>












</div>

<?php get_footer('inner'); ?>







<?php /* ?>



         <div class="row team-row">
            <?php
               $args = array(
               'numberposts' =>-1,
               'post_type' => 'cpt-team',
               );
               $uses = get_posts($args);
               foreach($uses as $post) {
               setup_postdata($post); ?>
            <div class="col-3 team-members">
               <a href="<?php the_permalink(); ?>">
                  <?php 
                     if ( has_post_thumbnail() ) { ?>
                  <img src="<?php the_post_thumbnail_url('full');?>" alt="<?php the_title();?>"/>
                  <?php
                     }
                     ?>
                  <div class="team-title">
                     <h3>
                        <?php the_title();?>
                     </h3>
                     <h5>
                        <?php echo get_post_meta(get_the_ID(),'_designation',true); ?>
                     </h5>
                  </div>
               </a>
            </div>
            <?php } wp_reset_postdata(); ?>  
         </div>
         <div class="button-row">
            <a href="javascript:void(0)" class="button" id="team-button">Show More
            </a>
         </div>
      </div>
      <!-- Team section end -->
   </div>
</div> 
<?php * / ?>
