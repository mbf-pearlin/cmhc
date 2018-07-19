<!-- banner start here -->
			<section class="banner-section">
				<div class="swiper-container home-banner">
			    <div class="swiper-wrapper">
					<?php
						$defaultslider=get_option('slider_default_image') ;
						$args = array(
						'numberposts' =>-1,
						'post_type' => 'cpt-slider',
						'orderby' => 'menu_order',
						'order' => 'ASC', 
						);
						$uses = get_posts($args);
						foreach($uses as $post) {
						setup_postdata($post); 
						//$button_text=get_post_meta( $post->ID,'_slider_btn_text', true ); 

						$sliderimage= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

						?>
			      <div class="swiper-slide">
					 <img class="mobile-img" src="<?php echo get_post_meta(get_the_ID(),'_mob_image',true);?>" alt="banner2"> 
			        <img class="desktop-img" src="<?php echo  $sliderimage[0] ; ?>">
			        <div class="hero-banner-desc-left">
								<div class="container">
									<div class="hero-banner-content">
										<?php the_content(); ?>
										
										
									</div>
								</div>
							</div>
			      </div>
			    



			                     <?php } wp_reset_postdata(); ?>

			    
			    </div>
			    <div class="swiper-pagination"></div>
			  </div>	
			</section>
			<!-- banner end here -->


	<!-- help section start here -->
			<section class="help-section">
				<div class="container">
				  <div class="row button-diraction">
				  	<div class="col-4 help-content">
			    	  <h4><?php echo get_option('con_button_title'); ?></h4>
			      </div>
			      <div class="col-4">
				    	<a href="<?php echo get_option('con_button_link'); ?>" class="button button-primary"><?php echo get_option('con_button_text'); ?></a>
			 			</div>
				 	
			 			<div class="col-4">
			    	  <a href="<?php echo get_option('app_button_link'); ?>" class="button"><?php echo get_option('app_button_text'); ?></a>
			 			</div>	
			 		</div>
				</div>			 			
			</section>
			<!-- help section end here -->













