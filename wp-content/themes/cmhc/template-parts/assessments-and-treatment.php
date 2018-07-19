

				<div class="container">
					<!--  Assessments and treatement section Start -->
						<section class="treat-assessments section-row">
							<div class="row">
								<div class="col-4 navs">
									<div class="treat-head">
						  				<h2><?php echo get_option('assessments_title'); ?></h2>
						  				<p><?php echo get_option('assessments_sub_title'); ?></p>
						  			</div>
					  			</div> 		
								<div class="col-4 navs">
									<div class="assess-nav first-box">
										<h5>Conditions</h5>
					  				<ul class="nav-box">
					  					


										<?php
										$args = array(
										'numberposts' =>-1,
										'post_type' => 'cpt-conditions',


										);
										$count=1;
										$uses = get_posts($args);
										foreach($uses as $post) {
										setup_postdata($post); 

                                         //print_r($count);
                                         if(($count >=1) && ($count<=6)) {

                      
										?>


                                     
						  				<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
						  			
                                        <?php } $count++; } wp_reset_postdata(); ?>  



					  				</ul>
					  				</div> 
					  			</div> 		
								<div class="col-4 navs">
							       <div class="assess-nav second-box">
					  				<ul class="nav-box">
					  					



						  				<?php
						  				$count=1;
										$args = array(
										'numberposts' =>-1,
										'post_type' => 'cpt-conditions',


										);
										$uses = get_posts($args);
										foreach($uses as $post) {
										setup_postdata($post);

 										                                         if(($count >=7) && ($count<=12)) {







										 ?>
						  				<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
						  			
                                        <?php } $count++; } wp_reset_postdata(); ?>  
						  				





					  				</ul>
					  			</div> 
					  				</div> 	
					  					
					  					
							</div>
						</section>
					<!--  Assessments and treatement section End -->
					<!-- Helpful resource section start -->
						

<?php /* ?>




<div class="container"><section class= "Assessments section-row">
					<div class="row">
			  	  		<div class="col-8 center-block">
								<h5><?php echo get_option('assessments_title');?></h5>
							<h2><?php echo get_option('assessments_sub_title');?></h2>
						</div>
					</div>
					<div class="assessments-tab tabs">
    					<ul class="tabs-links">
								<?php
								$args = array(
								'numberposts' =>5,
								'post_type' => 'cpt-assessments',
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

								<li class="<?php echo $active_class; ?>"><a href="#assessments-tab<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>

								<?php $a++; } wp_reset_postdata(); ?>
      					</ul>
						<div class="tabs-content assessments-content">
							
							<?php
						$args = array(
						'numberposts' =>5,
						'post_type' => 'cpt-assessments',
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
							<div class= "tab <?php echo $active_class; ?>" id="assessments-tab<?php echo $post->ID; ?>">
								<div class="row">
									<div class= "col-4 tab-img pr-0">
										<img src="<?php echo $assessments[0]; ?>" alt="tabimgs"/>
									</div>
									<div class= "col-8 tabdetails">
										<div class="row">
											<div class= "col-9 content-details">
												<h3><?php echo get_post_meta($post->ID,'_assessments_btn_text',true); ?></h3>
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
				
				
				
				
				
				
				
				
				<!-- Assessments section end -->



<div class="container">
				<!-- Assessments section start -->
				<section class= "Assessments section-row">
					<div class="row">
			  	  		<div class="col-8 center-block">
							<h5><?php echo get_option('assessments_title');?></h5>
							<h2><?php echo get_option('assessments_sub_title');?></h2>
						</div>
					</div>
					<div class="assessments-tab tabs">
    					<ul class="tabs-links">
							<?php
						$args = array(
						'numberposts' =>5,
						'post_type' => 'cpt-assessments',
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
	        				<li class="<?php echo $active_class; ?>"><a href="#assessments-tab<?php echo $post->ID; ?>"><?php the_title(); ?></a></li>
	        				
	        				   <?php $a++; } wp_reset_postdata(); ?>
      					</ul>
						<div class="tabs-content assessments-content">
							<div class="row">
								<div class= "col-4 tab-img pr-0">
									<img src="<?php echo site_url(); ?>/wp-content/uploads/2018/04/adhd-treatment.png"/>
								</div>
								<div class="col-8 tabdetails">
									
								<?php
								$args = array(
								'numberposts' =>5,
								'post_type' => 'cpt-assessments',
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
									
									<div class= "tab  <?php echo $active_class; ?>" id="assessments-tab<?php echo $post->ID; ?>">
										<div class="row">
											<div class= "col-9 content-details">
												<h3><?php echo get_post_meta($post->ID,'_assessments_btn_text',true); ?></h3>
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
				<!-- Assessments section end -->
<?php */ ?>





















