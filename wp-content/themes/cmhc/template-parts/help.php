<!-- Resources section end -->
<section class="resources-details section-row">
   <div class="row">
      <div class="col-8">
         <h2><?php echo get_option('resource_title'); ?></h2>
      </div>
   </div>
   <div class="resource-tab">
      <!-- tabs start -->
      <div class="tabs">
         <ul class="tabs-links">
            <?php
               $args = array(
               'numberposts' =>5,
               'post_type' => 'cpt-help',
               'orderby' => 'menu_order',
               'order' => 'ASC', 
               );
               $uses = get_posts($args);
               $a=1;
               

               $i = 0;
               
               $len = count($uses);
               
               foreach($uses as $post) {
               $active_class = ($a == 1) ? 'active' : '';
               
               setup_postdata($post); 
               
               $assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
               
            if ($i == $len - 1) {	?>
            <li class=""><a  class="test" href="<?php echo site_url(); ?>/faqs/"><?php the_title(); ?></a></li>
            <?php		} else  { ?>
            <li class="<?php echo $active_class; ?>"><a href="#tab<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
            <?php }
               // …
               $i++;
               
               ?>
            <?php $a++; } wp_reset_postdata(); ?>
         </ul>
         <div class="tabs-content accordion-row help-tab">
            <?php
               $args = array(
               'numberposts' =>5,
               'post_type' => 'cpt-help',
               'orderby' => 'menu_order',
               'order' => 'ASC', 
               );
               $uses = get_posts($args);
               $a=1;
               $i = 0;
               
               $len = count($uses);
                                                 
               foreach($uses as $post) {
               $active_class = ($a == 1) ? 'active' : '';
               
               setup_postdata($post); 
               
               $assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
               
               ?>
            <div id="tab<?php echo $post->ID; ?>" class="tab <?php echo $active_class; ?> tab-content accordion-row-blk">
               <?php  if ($i == $len - 1) { ?>

            <a  class="test" href="<?php echo site_url(); ?>/faqs/"><h6 class="faqs-details"><?php the_title(); ?></h6></a>

            <?php    } else  { ?>
            <h6><?php the_title(); ?></h6>
            <?php }
               // …
               $i++;
 ?>




               <div class="mobile-tabContent">
                  <div class="row">
                     <div class= "col-9 content-details align-self-center">
                        <?php wpautop(the_content()); ?>
                     </div>
                  </div>
               </div>
            </div>
            <?php $a++; } wp_reset_postdata(); ?>
         </div>
      </div>
      <!-- tabs end -->
   </div>
</section>
<!-- Resources section end -->
</div>