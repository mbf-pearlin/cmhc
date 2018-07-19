<?php
/*** Credit Module Section Shortcode ***/
function accordion_module( $atts, $content = null ){
	ob_start();
	$counter_img = get_option('counter_img');
    $a = shortcode_atts( array(
        'category' => '',
        'limit' => '-1',
    ), $atts );
?>       

<div class="accordion-row">
    <?php	
$args = array('numberposts' =>$a['limit'],'post_type' => 'cpt-faq','post_status' => 'publish');
if( $a['category']!='' ){
	$args['tax_query']= array(
        array(
            'taxonomy' => 'cpt-faq-cat', // This is the taxonomy's slug!
            'field' => 'slug',
            'terms' => array($a['category']) // This is the term's slug!
        )
    );
}
$credit_posts = get_posts($args);
foreach($credit_posts as $key => $credit_post){
	$img= wp_get_attachment_image_src( get_post_thumbnail_id($credit_post->ID), 'full' ); 	
?>
                                <div class="accordion-row-blk">
                                    <h6><?php echo $credit_post->post_title; ?></h6>
                                    <div class="accordion-content">
                                        <p><?php echo wpautop(apply_filters('the_content',$credit_post->post_content)); ?></p> 
                                      </div>
                                </div>
                              
<?php } ?> 
</div>
       
<?php
	return ob_get_clean();
}
add_shortcode('accordion_faq', 'accordion_module');



/*****
Short codes
*****/
/*******
For empty paragraph
*******/
function shortcode_empty_paragraph_fix_tag($content) {
    $array = array(
        '<p>[' => '[',
        ']</p>' => ']',
        '<p></p>' => '',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
function container( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="container">'.do_shortcode($content).'</div>';
}
add_shortcode('container', 'container');

function row( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="row">'.do_shortcode($content).'</div>';
}
add_shortcode('row', 'row');

function col_eight( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-8">'.do_shortcode($content).'</div>';
}
add_shortcode('col_eight', 'col_eight');

function intro_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="intro-content">'.do_shortcode($content).'</div>';
}
add_shortcode('intro_content', 'intro_content');

 
function intro_condition( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="intro-condition">'.do_shortcode($content).'</div>';
}
add_shortcode('intro_condition', 'intro_condition');


function col_6( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-6 list list-box">'.do_shortcode($content).'</div>';
}
add_shortcode('col_6', 'col_6');

function list_col( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="list-box">'.do_shortcode($content).'</div>';
}
add_shortcode('list_col', 'list_col');



function list_col_bullet( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="list-box bullet">'.do_shortcode($content).'</div>';
}
add_shortcode('list_col_bullet', 'list_col_bullet');

/* banner Image */

function banner_image( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="generic-banner">'.do_shortcode($content).'</div>';
}
add_shortcode('banner_image', 'banner_image');

function banner_image_caption( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figure class="image-with-caption">'.do_shortcode($content).'</figure>';
}
add_shortcode('banner_image_caption', 'banner_image_caption');


function banner_image_caption_text( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<figcaption>'.do_shortcode($content).'</figcaption>';
}
add_shortcode('banner_image_caption_text', 'banner_image_caption_text');

/* End banner Image */


/* accordion section */
function accordion_section( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion-row">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion_section', 'accordion_section');

function accordion( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion-row-blk">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion', 'accordion');

function accordion_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="accordion-content">'.do_shortcode($content).'</div>';
}
add_shortcode('accordion_content', 'accordion_content');

/* end accordion section */

/* Two Column */

function col_two( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-6">'.do_shortcode($content).'</div>';
}
add_shortcode('col_two', 'col_two');




function col_three( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-4">'.do_shortcode($content).'</div>';
}
add_shortcode('col_three', 'col_three');



function phone_link_popup( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="call-popup">'.do_shortcode($content).'</div>';
}
add_shortcode('phone_link_popup', 'phone_link_popup');

/* End Two Column */

/* Organisation Column */

function organisation( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="organisation">'.do_shortcode($content).'</div>';
}
add_shortcode('organisation', 'organisation');

function organisation_content( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="align-items-center cmh-bg">'.do_shortcode($content).'</div>';
}
add_shortcode('organisation_content', 'organisation_content');

function organisation_authour_name( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<h6 class="post-author">'.do_shortcode($content).'</h6>';
}
add_shortcode('organisation_authour_name', 'organisation_authour_name');


/* End Organisation Column */
/* Clinical Section*/
function clinical_section( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="row clinical-section">'.do_shortcode($content).'</div>';
}
add_shortcode('clinical_section', 'clinical_section');

function col_four( $atts, $content = null ) {
   $content = preg_replace('#^<\/p>|<p>$#', '', $content);
   $content=shortcode_empty_paragraph_fix_tag($content);
   return '<div class="col-4">'.do_shortcode($content).'</div>';
}
add_shortcode('col_four', 'col_four');

/* EndClinical Section*/


add_action('admin_menu', 'short_code');

function short_code() {
    $types = array( 'post', 'page','cpt-assessments','cpt-help','cpt-treatmets','cpt-slider','cpt-testimonial','cpt-conditions','cpt-team','cpt-faq' );
foreach ($types as $type){
    add_meta_box('shortCodes', 'Add Short Codes', 'short_codes', $type,'normal', 'high');
}

}

function short_codes($post_id) {
    global $post;
    ?>

    <table class="shtCode" style="width:100%">
        <tr>
            <th style="text-align: left"><label for="image_left_aside">Short Codes</label></th>
            <th style="text-align: left"><p>Description</p></th>
    </tr>
    <tr>
        <td class="left heading">[row]</td>
        <td  class="right description" ><p>Row</p></td>
    </tr>


    <tr>
        <td class="left heading">[col_eight]</td>
        <td  class="right description" ><p>Column Eight</p></td>
    </tr>

     <tr>
        <td class="left heading">[intro_condition]</td>
        <td  class="right description" ><p>Intro Condition</p></td>
    </tr>
  
    <tr>
        <td class="left heading">[list_col]</td>
        <td  class="right description" ><p>List Column</p></td>
    </tr>
    <tr>
        <td class="left heading">[list_col_bullet]</td>
        <td  class="right description" ><p>List Column bullet</p></td>
    </tr>
     <tr>
        <td class="left heading">[banner_image]</td>
        <td  class="right description" ><p>Banner Image Outter Div</p></td>
    </tr>
    <tr>
        <td class="left heading">[banner_image_caption]</td>
        <td  class="right description" ><p>Banner Image</p></td>
    </tr>
    <tr>
        <td class="left heading">[banner_image_caption_text]</td>
        <td  class="right description" ><p>Banner Image Caption</p></td>
    </tr>
    <tr>
        <td class="left heading">[col_two]</td>
        <td  class="right description" ><p>Two Columns</p></td>
    </tr>
    <tr>
        <td class="left heading">[clinical_section]</td>
        <td  class="right description" ><p>Clinical Section Outter Div</p></td>
    </tr>


     <tr>
        <td class="left heading">[accordion_faq]</td>
        <td  class="right description" ><p>Accordion (Note : Display the Full Accordion)</p></td>
    </tr>



      <tr>
        <td class="left heading">[accordion_faq category="your category name here..."]</td>
        <td  class="right description" ><p>Accordion (Note : Display the Specific Catgory )</p></td>
    </tr>
    
    </table>
    <?php

}
?>
