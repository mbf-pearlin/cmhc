	<section id="about-section" class="section-row">
					  	<div class="container">
						  	<div class="row">
						  		<div class="col-4">
						  			<!-- <img src="img/about-us.jpg" alt="aboutus"/> -->
						  			<h2><?php echo get_option('ss_abt-sub-tit');?></h2>
						  		</div>
					  			<div class="col-8 about-content">

                                     <?php echo wpautop(get_option('ss_abt'));?>  
						  			<a href="<?php echo site_url(); ?>/about/" class="button">Learn more</a>
					  			</div>
						  	</div>
					  	</div>
					</section>



				