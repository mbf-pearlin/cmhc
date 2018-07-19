
<?php
	global $post;

	if(is_home()){
		$id = get_option('page_for_posts');
	} 
	else{
		$id = get_the_id();	
	}

	$banner_image = (get_post_meta($id, '_banner_image', true)!='') ? get_post_meta($id, '_banner_image', true) : '';
	//$banner_image =  get_the_post_thumbnail_url($id, 'full'); 
	$banner_text = (get_post_meta($id, '_banner_content', true)!='' ? get_post_meta($id, '_banner_content', true) : get_option('default_banner_content'));	
	$banner_title = (get_post_meta($id, '_banner_title', true)!='' ? get_post_meta($id, '_banner_title', true) : get_option('default_banner_content'));	

	if(is_page() && $banner_image==''){
		if($post->post_parent){
			$banner_image = get_post_meta($post->post_parent, '_banner_image', true);
		}
	}

	if($banner_image==''){
		$banner_image = get_option('banner_default');
	}

if (!is_front_page()) {
$title='';
//$banner_image='';
$blog_id = get_option('page_for_posts');

if(is_home()){
$title = get_the_title($blog_id);
//echo $banner_image ;
} elseif( is_single() ){
$id = get_the_ID();
$title = get_the_title($id);
//echo $banner_image ;
} elseif( is_page() ){
$id = get_the_ID();
$title = get_the_title($id);
//echo $banner_image ;
} else if (is_category()) { 
$title = single_cat_title('',false);
} elseif( is_tag() ) { 
$title = 'Tag: '.single_tag_title('',false);
} elseif (is_day()) { 
$title = 'Archives for '.get_the_time('M jS, Y');
} elseif (is_month()) { 
$title = 'Archives for '.get_the_time('M, Y');
} elseif (is_year()) { 
$title = 'Archives for '.get_the_time('Y');
} elseif (is_author()) { 
$title = 'Archives for '.ucfirst(get_the_author());
} elseif (is_search()) { 
$title = sprintf('Search results for "%s"', get_search_query());

} elseif(is_tax()){
$title = get_queried_object()->name;		
} elseif(is_404()){
$title = '404';		
}
$categories = get_the_category();

     

?>

<div id="condition-banner" class="intro-banner">
				<div class="container">
					<div class="row">
						<div class="col-8">
							<!-- bread-crumb start-->
							<?php if(!is_front_page()){	?>

									<?php site_breadcrumbs(); ?>
									<?php }?>

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





		<?php /* ?><section class="generic-bg">
					<div class="container">
						<div class="generic-banner">
							<figure class="image-with-caption">
								<img src="<?php echo $banner_image ; ?>" alt="banner" />							
							</figure>
						</div>
					</div>
				</section> <?php */ ?>



        



<?php } ?>

