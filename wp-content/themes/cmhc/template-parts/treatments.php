	<section class= "Assessments section-row">
					<div class="row">
			  	  		<div class="col-8 center-block">
							<h5><?php echo get_option('treatmets_title');?></h5>
							<h2><?php echo get_option('treatmets_sub_title');?></h2>
						</div>
					</div>
					<div class="assessments-tab tabs">
<ul class="tabs-links">
							<?php
						$args = array(
						'numberposts' =>5,
						'post_type' => 'cpt-treatmets',
						'orderby' => 'menu_order',
						'order' => 'ASC', 
						);
						$uses = get_posts($args);
													$a=1;

						foreach($uses as $post) {
												 $active_class = ($a == 1) ? 'active' : '';

						setup_postdata($post); 

						$assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

						?>
							
	        			<li class="<?php echo $active_class; ?>"><a href="#treatments-tab<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
	        		<?php $a++; } wp_reset_postdata(); ?>

	        			
      					</ul>
      					
						<div class="tabs-content treatments-tab">
								
							<?php
						$args = array(
						'numberposts' =>5,
						'post_type' => 'cpt-treatmets',
						'orderby' => 'menu_order',
						'order' => 'ASC', 
						);
						$uses = get_posts($args);
					    $a=1;

						foreach($uses as $post) {
												    $active_class = ($a == 1) ? 'active' : '';

						setup_postdata($post); 
						//$button_text=get_post_meta( $post->ID,'_slider_btn_text', true ); 

						$assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
	              
						?>
							<div class= "tab <?php echo $active_class; ?>" id="treatments-tab<?php echo $post->ID; ?>">
								<div class="row">
									<div class= "col-4 tab-img pr-0">
										<img src="<?php echo $assessments[0]; ?>" alt="tabimgs"/>
									</div>
									<div class= "col-8 tabdetails">
										<div class="row">
											<div class= "col-9 content-details">
												<h3><?php echo get_post_meta($post->ID,'_treatmets_btn_text',true); ?></h3>
                                        <?php wpautop(the_content()); ?>

											</div>
										</div>
									</div>
								</div>
							</div>
					
					                  <?php $a++; }  wp_reset_postdata(); ?>

							
							
						</div>
					</div>
				</section>


				<!-- Treatments section end -->
<?php /* ?>
<!-- Treatments section start -->
				<section class= "Assessments section-row">
					<div class="row">
			  	  		<div class="col-8 center-block">
                          <h5><?php echo get_option('treatmets_title');?></h5>
							<h2><?php echo get_option('treatmets_sub_title');?></h2>
						</div>
					</div>
					<div class="assessments-tab tabs">
    					<ul class="tabs-links">
						<?php
						$args = array(
						'numberposts' =>5,
						'post_type' => 'cpt-treatmets',
						'orderby' => 'menu_order',
						'order' => 'ASC', 
						);
						$uses = get_posts($args);
							$a=1;

						foreach($uses as $post) {
						 $active_class = ($a == 1) ? 'active' : '';

						setup_postdata($post); 

						$assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

						?>

						<li class="<?php echo $active_class; ?>"><a href="#treatments-tab<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
						<?php $a++; } wp_reset_postdata(); ?>

      					</ul>
						<div class="tabs-content treatments-tab">
							<div class="row">
								<div class= "col-4 tab-img pr-0">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2018/04/autism.png"/>
								</div>
								<div class="col-8 tabdetails">
									
									<?php
						$args = array(
						'numberposts' =>5,
						'post_type' => 'cpt-treatmets',
						'orderby' => 'menu_order',
						'order' => 'ASC', 
						);
						$uses = get_posts($args);
					    $a=1;

						foreach($uses as $post) {
												    $active_class = ($a == 1) ? 'active' : '';

						setup_postdata($post); 
						//$button_text=get_post_meta( $post->ID,'_slider_btn_text', true ); 

						$assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
	              
						?>
									
									<div class= "tab <?php echo $active_class; ?>" id="treatments-tab<?php echo $post->ID; ?>">
										<div class="row">
											<div class= "col-9 content-details">
												<h3><?php echo get_post_meta($post->ID,'_treatmets_btn_text',true); ?></h3>
											
																					<?php the_content(); ?>

											
											
											</div>
										</div>
									</div>
									
						                  <?php $a++; }  wp_reset_postdata(); ?>
			
									
								</div>
							</div>
						</div>
					</div>
					
				</section>
				<!-- Treatments section end -->


<?php */?>






















				
