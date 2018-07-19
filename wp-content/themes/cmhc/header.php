<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta content="user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,width=device-width,shrink-to-fit=no" name="viewport" >

<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800" rel="stylesheet">
	<script>
			var templateUri = "<?php  echo get_bloginfo('template_url'); ?>";
			var blogUri = "<?php echo get_bloginfo('url'); ?>";
			var tmpl_url = '<?php echo TMPL_URL; ?>';
	</script>	

<style>
	body{
			background-color: #fff;
		}  
		.render-blk{ opacity:0; }
		
	.bread-crumb li:last-child {
    margin-right: 0;
    display: none;
} 

	</style>
	
	<noscript>
		<style media="screen">
			.render-blk{ opacity: 1; }	
		</style>
	</noscript>



<?php wp_head(); ?>
</head>



<body <?php body_class(); ?>>

		<div class="render-blk">
			<!-- header start here -->
			<header>
				<div class="container">
					<div class="menu-blk">	
						<div class="row">
						    <a href="<?php echo site_url(); ?>" class="col-3 logo"><img src="<?php echo get_option('site_logo');?>" alt="logo" title="Child Mental Health Clinic"/></a>
						  <div class="col-9">
						  	<nav>
								<div class="nav-menubar">
									<div class="logo"></div>
							  			<!--<a href="<?php //echo site_url(); ?>" class="logo"><img src="<?php //echo get_option('site_logo');?>" alt="logo" title="child Mental health clinic"/></a> -->
							  			<a href="mailto:<?php echo get_option('ss_mail');?>"><i class="la la-envelope"></i><?php echo get_option('ss_mail');?></a>
			            				<a href="tel:<?php echo get_option('ss_hours');?>"><i class="la la-phone"></i><?php echo get_option('ss_hours');?></a>
							  		</div>
								
								<?php 
								$defaults = array(
								'theme_location'  => 'main-menu',
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
								'items_wrap'      => '<ul id="%1$s" class="%2$smenu-list">%3$s <li id="menu-item-626" class="last-book menu-item menu-item-type-post_type menu-item-object-page menu-item-626"><a title="Contact" href='.site_url().'/book-an-appointment/>BOOK AN APPOINTMENT</a></li></ul>',
								'depth'           => 0,
								'walker'          => ''
								);
								wp_nav_menu( $defaults );
								?>
								
								</nav>
							</div>	
								<div class="contact-menu">
					         	<ul>
					            	<li><a href="tel:<?php echo get_option('ss_hours');?>"><i class="la la-phone"></i></a></li>
					         	</ul>
				         	</div>
					 		<div class="menu-toggle">
	             	<div class="hamburger"></div>
	         			<div class="hamburger"></div>
	         			<div class="hamburger"></div>
   					  </div>
	         	</div>
         	</div>
         
        <div>
					<div class="social-content">
					<ul><li><a href="<?php echo get_option('app_button_link'); ?>">BOOK AN APPOINTMENT</a></li></ul>

					</div>
					<div class="social-content-phone">
					<ul>
					<li>	<a href="tel:<?php echo get_option('ss_hours');?>"><i class="la la-phone"></i><?php echo get_option('ss_hours');?></a></li>
					</ul>
					</div>
					</div>
	         	 	
        </div>
</header>


<?php if(!is_front_page()) { ?>
			<div class="landing-element">
				<?php } ?>

			<!-- header end here -->

	
