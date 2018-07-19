<?php
global $_POST;
$load_url = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
include $load_url[0].'wp-load.php';
//$taxonomy = "blog_cat";
$noOfPost = 6;
//$categoryId = get_the_ID();
//$categoryName = $_POST['categoryName'];
$excludePostArray = $_POST['postIdArray'];
$blogArgs = array(
    'orderby'          => 'menu_order',
    'order'            => 'ASC',
    'post_type'        => 'cpt-testimonial',
    'post_status'      => 'publish', 
    'post__not_in' => $excludePostArray,
    'numberposts'      => $noOfPost,
);
$blogCollections = get_posts($blogArgs); ?>

<div id="grid" class="clearfix loadcontent">
  <?php
foreach ($blogCollections as $blogCollection) {
  // if(!in_array($servicePost->ID,$exclud0ePostArray)) {
    $featImage = wp_get_attachment_url(get_post_thumbnail_id($blogCollection->ID) );
   // $imageId = MultiPostThumbnails::get_post_thumbnail_id('blog', 'blogicon', $blogCollection->ID);
   // $imageUrl = wp_get_attachment_url($imageId, NULL);

    
  
               echo'   <div class="cards testone"  data-id="'.$blogCollection->ID.'">
                      <div class="cards-'.get_post_meta($blogCollection->ID, "_testimonial", true).' cards-bgcolor">
                      '. $blogCollection->post_content.'
                        <div class="info">
                        
                        <img src="'.  $featImage.'" alt=""/>
                      
                        <div class="info-content">
                          <h5>'. $blogCollection->post_title.'</h5>
                           <p> '.  get_post_meta($blogCollection->ID,'_authour_btn_text',true).'</p>
                        </div>
                        </div>
                      </div>
                    </div>';


 


   
}

?>
  </div>