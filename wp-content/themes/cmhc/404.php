<?php

get_header(); ?>
  <?php get_template_part( 'template-parts/page-banner','page-banner');?>

<div class="sub-content  center-block" style="text-align: center;">	
	<div class="container ">
	<!-- paragraph styles -->
		<div class="row">
			<div class="col-8  center-block">
				

				<i class="fa fa-exclamation-triangle" style="font-size: 40px; color:#0e4d7e"></i>
			<h2>OOPS!</h2>
			<h3>Page not found</h3>
			<p>The page you are looking for might have been removed or is temporarily unavailable.</p>
			<a href="<?php echo site_url(); ?>" class="gohome button">Go to Home</a>
			<a action="action" onclick="window.history.go(-1); return false;" href="javascript(0);"  class="goprevious button">Go to Previous</a>
				
				
				
				
				
			</div>
		
		</div>	
	
	</div>
</div>
	



<?php get_footer('inner'); ?>
