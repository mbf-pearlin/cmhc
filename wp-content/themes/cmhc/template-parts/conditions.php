
<section class="condition-block sub-content">
					<div class="container">
						<div class="row">
								<?php
						$args = array(
						'numberposts' =>-1,
						'post_type' => 'cpt-conditions', 
						'orderby' => 'menu_order', 
						'order' => 'ASC', 
						);
						$uses = get_posts($args);
						$a=1;
						$arr = array(1, 2, 3, 4, 5);	

		
						foreach($uses as $post) {

						shuffle($arr);
						setup_postdata($post); 
						//$button_text=get_post_meta( $post->ID,'_slider_btn_text', true ); 

						$assessments= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
						if($a == 6){
								$a = 1;
						}

						?>
							<div class="col-4 cont-box">
								<a href="<?php the_permalink(); ?>">
								<div class="condition-section cont-card-<?php echo get_post_meta($post->ID,'_bg_block',true); ?>">
									<h4><?php the_title();?></h4>



                                     <p><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></p> 

									<span>Learn More</span>
								</div>
								</a>
							</div>
							

												<?php $a++; }  wp_reset_postdata(); ?>


						</div>
					</div>
				</section>











