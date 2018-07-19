<?php 
   /* Template Name: Testimonial Load */ 
   get_header();
   $post_term=get_queried_object();
   $curr_term_id = get_the_ID();
   //$curr_term_name =get_the_title( $curr_term_id );
   $curr_term_content = get_queried_object()->description;
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
   <?php
      global $postId;
      $noOfPost=6;
      $blogFitArgs = array(
      'order'            => 'ASC',
      'post_type'        => 'cpt-testimonial',
      'post_status'      => 'publish', 
      'numberposts'      => -1,
      
      );
      $blogCollCount = get_posts($blogFitArgs);
      $blogArgs = array(
      'orderby'          => 'date',
      'order'            => 'DSC',
      'post_type'        => 'cpt-testimonial',
      'post_status'      => 'publish', 
      'numberposts'      => $noOfPost,
      
      );
      $blogCollections = get_posts($blogArgs);
      //var_dump(count($blogCollections));
      
      
      ?>
   <!-- sub header end -->
   <div class="sub-content">
      <!-- Team section start -->
      <div class="testimonial-section">
         <div class="container">
            <div id="grid" class="clearfix">
               <?php 
                  foreach($blogCollections as $key => $blogCollection) { 
                   $category = get_the_terms( $blogCollection->ID, 'blog_cat' );
                    $totalCount = count($blogCollections);
                    $squareboxStyle = get_post_meta($blogCollection->ID, 'square_box_style', true);
                    $titleTag = get_post_meta($blogCollection->ID, 'title_tag', true);
                    $featImage = wp_get_attachment_url(get_post_thumbnail_id($blogCollection->ID) );
                    $linkUrl = get_post_meta($blogCollection->ID, 'rl_link_url', true);
                    $linkHeading = get_post_meta($blogCollection->ID, 'link_heading', true);
                    
                  //  $imageId = MultiPostThumbnails::get_post_thumbnail_id('cpt-team', 'blogicon', $blogCollection->ID);
                     $imageUrl = wp_get_attachment_url($imageId, NULL);
                    ?>
               <div class="cards testone" data-id="<?php  echo $blogCollection->ID; ?>">
                  <div class="cards-<?php echo get_post_meta($blogCollection->ID, "_testimonial", true); ?> cards-bgcolor">
                     <?php echo $blogCollection->post_content; ?>
                     <div class="info">
                        <img src="<?php echo $featImage; ?>" alt=""/>
                        <div class="info-content">
                           <h5><?php echo $blogCollection->post_title; ?></h5>
                           <p> <?php echo get_post_meta($blogCollection->ID, "_authour_btn_text", true); ?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <?php
                  $i++;
                  }  
                  ?>
            </div>
            <div id="grid" class="loadcontent"></div>
            <input type="hidden" id='load_blog'>
            <input type="hidden" id="cat_id" value="<?php echo $curr_term_id; ?>">
            <input type="hidden" id="pst_count" value="<?php echo count($blogCollCount); ?>">
            <span class="learn-more-service" id="ajax-learnmore" ></span> 
            <?php if(count($blogCollCount)>$noOfPost){ ?>
            <div class="alignBtn button-row" id="loadMore">
               <a href="javascript:void(0)" id="load-more-products" class="button button-big">Load More</a>
            </div>
            <?php } ?>
         </div>
      </div>
      <!-- Team section end -->
   </div>
</div>
<?php get_footer(); ?>