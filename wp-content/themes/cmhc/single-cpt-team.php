<?php get_header(); 

	global $post;
	if(is_home()){
		$id = get_option('page_for_posts');
	} 
	else{
		$id = get_the_id();	
	}
?>

<div id="condition-banner" class="intro-banner">
            <div class="container">
               <div class="row">
                  <div class="col-8">
                     <!-- bread-crumb start-->
                  <div class="bread-crumb" xmlns:v="http://rdf.data-vocabulary.org/#"><ul class="clearfix"><li><a href="<?php echo site_url();?>" rel="v:url" property="v:title">Home</a></li>
                  <li><a href="<?php echo site_url();?>/about/" rel="v:url" property="v:title">About</a></li>

                    <li><a rel="v:url" property="v:title" href="<?php echo site_url();?>/team/">Team</a></li><li><?php the_title(); ?></li></ul></div>

                     <!-- bread-crumb end-->
                     <?php if($banner_title == ""){ ?>
                           <h1><?php the_title(); ?></h1>
                                <?php } else {  ?>
                              <h1><?php echo $banner_title; ?></h1>
                              
                              <?php } ?>
                           <div class="intro"><p><?php echo $banner_text; ?></p>
                           </div>
                  </div>
               </div>
            </div>
         </div>

  <?php//get_template_part( 'template-parts/page-banner','page-banner');?>

<div class="sub-content conditions">
   <!-- Generic content start -->
   <div class="container">
      <div class="row conditions-row">
         <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();
            
            	?>
         <div class="col-8">
            <?php wpautop(the_content()); ?>
         </div>
         <div class="col-4">
            <div class="right-block">
               <div class="right-pic">
                  <?php 
                     if ( has_post_thumbnail() ) { ?>
                  <img src="<?php the_post_thumbnail_url('full');?>"/>
                  <?php
                     } ?>
               </div>
               
            </div>
         </div>
      </div>
      <?php	endwhile; // End of the loop.
         ?>
   </div>
   <!-- Generic content end -->
 
  
   <!-- help section end here -->
</div>


			
<?php get_footer(); ?>
