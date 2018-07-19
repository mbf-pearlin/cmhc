			<section class="generic-info">
						<div class="container">
							<div class="info-banner">
									<?php
									$args = array(
									'numberposts' =>1,
									'post_type' => 'cpt-testimonial',
									//'orderby' => 'menu_order', 
									
									'orderby' => 'rand'
									);
									$testimonialimage = get_posts($args);
									foreach($testimonialimage as $post) {
									setup_postdata($post); 
									//$button_text=get_post_meta( $post->ID,'_slider_btn_text', true ); 

									$testimonialimage= wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 

									?>
								    <div class="row">
									<div class=" col-10 align-items-center ">
										<?php the_content(); ?> 
									</div>
								</div>

                                <?php } wp_reset_postdata(); ?>

							</div>
						</div>
					</section>












