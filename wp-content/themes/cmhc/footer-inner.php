<?php
global $wpdb;
global $_POST; 		
$copyright = ( get_option('footer_copy') != '' ) ? str_replace( '{YEAR}', date('Y'), get_option('footer_copy') )  : "Copyright &copy; ". date('Y') ." ".get_bloginfo('name').". All Rights Reserved";

?>
 

   
 
	</div>
 
 	<footer class="clearfix">	
  <div class="popup">
				  		<h2><i class="la la-phone"></i><?php echo get_option('ss_hours'); ?></h2>
				  		<span class="popup-close"><i class="fa fa-times"></i></span>	
			  		</div>
  



						<div class="container footer">
						
						  <div>
								<?php 
								$defaults = array(
								'theme_location'  => 'footer-menu',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => '',
								'menu_id'         => '',
								'echo'            => true,

								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul id="%1$s" class="%2$s footer-nav">%3$s </ul>',
								'depth'           => 0,
								'walker'          => ''
								);
								wp_nav_menu( $defaults );
								?>
							</div>
<ul class="footer-nav-left">
 	<li>©2018 Child Mental Health Clinic Limited. </li> 
 	<li>&nbsp;All rights reserved.</li>
 	<li> <a href="https://www.madebyfire.com/" target="_blank" rel="noopener">&nbsp;made by fire</a></li>
</ul>




							
						</div>
					</footer>


<?php wp_footer(); ?>
<script type="text/javascript">
	var $container = $('#grid');
    // initialize
    $container.masonry({
     columnWidth: 0,
     itemSelector: '.cards'
    });
</script>
<script>
	NProgress.configure({ showSpinner: false }).start();
	
		for(var j = 0; j < jsArr.length; j++) {
	var script = document.createElement('script')
	script.setAttribute('type', 'text/javascript')
	script.setAttribute('src', jsArr[j])
	document.getElementsByTagName('head')[0].appendChild(script)
	}
</script>
</body>
</html>
<?php if($_COOKIE["cook_pol"]!='no' || $_COOKIE["cook_pol"]=='' ){ ?>

 



<div class="cookie-policy">
						<div class="container">
							<p>Welcome to CMHC. We use cookies to enhance your visit to our site. <a href="<?php echo get_bloginfo('url'); ?>/privacy-policy" target="_blank">Learn more</a></p>
						</div>
						<a href="javascript:void(0)" class="button_cookk ">I Agree <i class="fa fa-close"></i></a>
					</div>

		   
   		<?php } ?>
