<?php
   /*
   * Template Name: Booking
   */
   get_header();
   ?>
<style type="text/css">.checkboxradio-row .error-message {
   color: #e42828;
   display: none;
   font-size: 13px;
   padding: 5px 0;
   }
   .checkboxradio-row-con {
   padding: 0 15px 23px 0;
   }
   select{
   display: block! important;
   }
   option{ padding:5px 0} 
   .ui-selectmenu-button.ui-button{
    display: none;
   }
</style>
<?php
   global $wpdb;
   global $_POST;    
   $_booking_id = $_GET['booking_id'];
   $my_post = get_post($_booking_id);
   //print_r($my_post);
   $title = $my_post->post_title;

   if ($_POST['contact_book_us_form'] != "" && $_POST['contactform_book'] == "") {
 
    $noc = $_POST['nature_of_concerns'];
    $noc_data = implode(",", $noc);
   //var_dump($noc_data);
    //exit();
   $table = $wpdb->prefix . "booking";
   $data['fname']        = sanitize_text_field($_POST['fname']);
   $data['dob']        = sanitize_text_field($_POST['dob']);
   $data['gender']        = sanitize_text_field($_POST['gender']);
   $data['parent_name']            = sanitize_text_field($_POST['parent_name']);
   $data['parent_email']            = sanitize_text_field($_POST['parent_email']);
   $data['parent_contact_number']        = sanitize_text_field($_POST['parent_contact_number']);
   $data['nature_of_concerns']     =  $noc_data;
   $data['message']          = nl2br($_POST['message']);
   $data['posted_date']      = date('Y-m-d H:i:s');
   $data['fname'] = ucwords($data['fname']);


   
   //print_r ( $data['nature_of_concerns']);
  // exit;

   $format = array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');
   $err = 0;
   if (empty($data['fname'])) {
   $error['fname'] = "Please enter your child's name";
   $err++;
   }
   if (empty($data['dob'])) {
   $error['dob'] = "Please enter your Child's Date of Birth";
   $err++;
   }
   if (empty($data['gender'])) {
   // $error['gender'] = "Please enter your dob";
   $err++;
   }
   if (empty($data['parent_name'])) {
   $error['parent_name'] = "Please enter your name";
   $err++;
   }
   if (empty($data['parent_email'])) {
   $error['parent_email'] = "Please enter your email";
   $err++;
   }
   if (empty($data['parent_contact_number'])) {
   $error['parent_contact_number'] = "Please enter your phone number";
   $err++;
   }
   if (empty($data['nature_of_concerns'])) {
   $error['nature_of_concerns'] = "Please enter your nature of concerns";
   $err++;
   }
   if (empty($data['message'])) {
   $error['message'] = "Please enter your message";
   $err++;
   }
   if (empty($err)) {
   $insert_contact = $wpdb->insert($table, $data);
   $lastid = $wpdb->insert_id;
   if($insert_contact != "") {  
   $reurl = get_bloginfo('url') . "/book-an-appoinment/thank-you-appoinment/";
   echo '<script type="text/javascript">document.location="'.$reurl.'";</script>'; ?>
<?php $message = '
   <html>
   <body>
   <div style="max-width:500px">
   <p>Dear Admin,<br /><br />
   The following message was submitted through the website today.<br /><br />
   ---- Message ----<br /><br />
   Name - '. $data['fname'] .'<br />
   DOB - ' . $data['dob'] . ' <br />
   Gender - ' . $data['gender'] . ' <br />
   ParentName - ' . $data['parent_name'] . ' <br />
   Email - ' . $data['parent_email'] . ' <br />
   Phone - ' . $data['parent_contact_number'] . '<br />
   Concerns - ' . $data['nature_of_concerns'] . '<br />
   Message - '. $data['message'] . '<br />
   </p>
   </div>
   </body>
   </html>'
   ?>
<?php $senderMessage = '
   <html>
   <body>
   <div style="max-width:500px">
   <p>Dear '. $data['fname'] .',<br /><br />
   Thank you for writing to us. We have forwarded your email to the
   right department and you should get an answer back in 48 hours.<br /><br />
   Regards,<br /><br />
   On Behalf of CMHC<br /><br />
   ---- Your message ----<br /><br />
   Name - '. $data['fname'] .'<br />
   DOB - ' . $data['dob'] . ' <br />
   Gender - ' . $data['gender'] . ' <br />
   ParentName - ' . $data['parent_name'] . ' <br />
   Email - ' . $data['parent_email'] . ' <br />
   Phone - ' . $data['parent_contact_number'] . '<br />
   Concerns - ' . $data['nature_of_concerns'] . '<br />
   Message - '. $data['message'] . '<br />
   </p>
   </div>
   </body>
   </html>';
   $from = "CMHC<admin@cmhclinic.co.uk>";
   $subject = "Message from the cmhc website";
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
   $headers .= "From: " .  $from."\r\n";
   $to = get_option('contact_us_email');
   if (wp_mail($to, $subject, $message, $headers)) {
   $to = $data['parent_email'];
   $subjectSender ="CMHC - Your message has been received.";
   if (wp_mail($to, $subjectSender, $senderMessage, $headers)) {
   unset($_POST);
   $redirect_url = get_bloginfo('url') . "/book-an-appoinment/thank-you-appoinment/";
   header('Location: '.$redirect_url);
   exit;
   }
   }
   }
   }
   }
   ?>
<?php get_template_part( 'template-parts/page-banner','page-banner');?>
<div class="contactinfo-section">
   <div class="container">
      <div class="row contact-detail">
         <div class="col-8 form-section contact">
            <div class="contact-us">
               <div class="contuct-details">
                  <?php echo apply_filters('the_content',$post->post_content  ); ?>
               </div>
               <form name="contact_book_us_frm" id="contact_book_us_frm" method="post" action="">
                  <?php wp_nonce_field('conactus_book_nonce','contact_book_us_form'); ?>
                  <div class="form-row">
                     <label class="floating-item"  data-error="Please enter your Child's name">
                     <input type="text" class="floating-item-input input-item" name="fname" id="bookfirstname" maxlength="75" onkeypress="return onlyAlphabets(event, this)" value="" >  
                     <span class="floating-item-label">Your Child's Name
                     </span>
                     </label>
                     <div class="error-message" id="bookerr_firstname"> 
                        <?php echo $error['fname'];?> 
                     </div>
                  </div>
                  <div class="form-row">
                     <label class="floating-item"  data-error="Please enter your Child's date of birth">
                     <input type="text" class="floating-item-input input-item dobtext current" name="dob" maxlength="75" id="bookdob" value="" data-select="datepickerss" >  
                     <span class="floating-item-label">Child's Date of Birth (dd/mm/yy)
                     </span>
                     </label>
                     <div class="error-message" id="bookerr_dob"> 
                        <?php echo $error['dob'];?> 
                     </div>
                  </div>
                  <div class="form-row">
                     <label class="floating-item"  data-error="Please enter your Child's date of birth">
                        <div  class="floating-item-input input-item dobtext current" name="dob" maxlength="75" id="bookdob" value="" data-select="datepickerss" style="border-bottom: 0px solid #eff1f0;" >  </div>
                        <span class="floating-item-label">Child's Gender
                        </span>
                     </label>
                  </div>
                  <div class="form-row checkboxradio radio-row clearfix">
                     <div class="checkboxradio-row-con">
                        <input class="checkboxradio-item checkboxradio-invisible" name="gender" id="radiobutton1" type="radio" value="male" checked>
                        <label class="checkboxradio-label radio-label" for="radiobutton1">Male
                        </label>
                     </div>
                     <div class="checkboxradio-row-con">
                        <input class="checkboxradio-item checkboxradio-invisible" name="gender" id="radiobutton2" type="radio"  value="female">
                        <label class="checkboxradio-label radio-label" for="radiobutton2">Female
                        </label>
                     </div>
                     <div class="checkboxradio-row-con">
                        <input class="checkboxradio-item checkboxradio-invisible" name="gender" id="radiobutton3" type="radio" value="other">
                        <label class="checkboxradio-label radio-label" for="radiobutton3">Other
                        </label>
                     </div>
                  </div>
                  <div class="form-row">
                     <label class="floating-item"  data-error="Please enter your parentname">
                     <input type="text" class="floating-item-input input-item" name="parent_name" maxlength="75" id="bookparentname" value="" >  
                     <span class="floating-item-label">Parent Name
                     </span>
                     </label>
                     <div class="error-message" id="bookerr_parentname"> 
                        <?php echo $error['parent_name'];?> 
                     </div>
                  </div>
                  <div class="form-row">
                     <label class="floating-item" data-error="Please enter your email address">
                     <input type="text" class="floating-item-input input-item validate-email" maxlength="100" name="parent_email" id="bookemail" value="" />
                     <span class="floating-item-label">Parent Email
                     </span>
                     </label>
                     <div class="error-message" id="bookerr_login_email">
                        <?php echo $error['parent_email'];?>
                     </div>
                  </div>
                  <div class="form-row">
                     <label class="floating-item" data-error="Please enter your phone number">
                     <input type="text" class="floating-item-input input-item validate-mobile" name="parent_contact_number" id="booktelephone"  maxlength="12" onkeypress="return isNumber(event)" id="booktelephone" value="" />                      
                     <span class="floating-item-label">Parent contact number
                     </span>
                     </label>
                     <div class="error-message" id="bookerr_telephone">
                        <?php echo $error['parent_contact_number'];?>
                     </div>
                  </div>
                  <div class="form-row">
                     <label class="floating-item"  data-error="Please enter your DOB">
                        <div  class="floating-item-input input-item dobtext current" name="dob" maxlength="75" id="bookdob" value="" data-select="datepickerss" style="border-bottom: 0px solid #eff1f0;" >  </div>
                        <span class="floating-item-label">Potential Condition(s)
                        </span>
                     </label>
                  </div>
                  <?php /*  if(  $_booking_id !=  $my_post->ID) {  ?>
                  <div class="form-row select-row">
                     <select multiple class="select-menu" name="nature_of_concerns[]"  id="nature_of_concerns"  >
                        <?php
                           $topics_array = array(
                           'post_type' => 'cpt-conditions',
                           'numberposts' => -1,
                           'orderby' => 'menu_order',
                           'order' => 'ASC',
                           'suppress_filters' => false
                           );
                           $topics = get_posts( $topics_array );
                           
                           if( !empty($topics) ){ 
                           foreach($topics as $topic){ 
                           
                           
                           ?>
                        <option value="<?php echo $topic->post_title; ?>">
                           <?php echo $topic->post_title; ?>
                        </option>
                        <?php 
                           }  }
                           ?>
                     </select>
                  </div>
                  <?php } */ ?>



                     <?php  if(  $_booking_id !=  $my_post->ID) {  ?>


                     <div class="form-row checkboxradio book-an-check">

<div class="checkboxradio-options">
                                 <ul>

                     <?php
                     $topics_array = array(
                     'post_type' => 'cpt-conditions',
                     'numberposts' => -1,
                     'orderby' => 'menu_order',
                     'order' => 'ASC',
                     );
                     $topics = get_posts( $topics_array );

                     if( !empty($topics) ){ 
                     foreach($topics as $topic){ 

                     ?>


<li>
                     <div class="checkboxradio-row">
                     <input class="checkboxradio-item checkboxradio-invisible nature_of_concerns" name="nature_of_concerns[]" id="nature_of_concerns<?php echo $topic->ID; ?>" type="checkbox" value=<?php echo $topic->post_title; ?> />
                     <label class="checkboxradio-label checkbox-label" for="nature_of_concerns<?php echo $topic->ID; ?>"><?php echo $topic->post_title; ?></label>
                     </div>
</li>
                     <?php } } ?>


</ul>
</div>
                     </div>
                     <?php }  ?>





                  <div class="form-row">
                     <label class="floating-item" data-error="Please enter your message">
                     


<textarea class="floating-item-input input-item" name="message" id="bookmessage"></textarea>

                     <span class="floating-item-label">Your message
                     </span>
                     </label>
                     <div class="error-message" id="bookerr_message">
                        <?php echo $error['message'];?>
                     </div>
                  </div>
                  <div class="checkboxradio-row pri-check">
                     <input class="checkboxradio-item checkboxradio-invisible" name="terms" id="terms_book" type="checkbox" >
                     <label class="checkboxradio-label checkbox-label" for="terms_book">Your information will be used to communicate and provide safe care. Your data will not be shared with any third party. Find out more information on CMHC <a href="<?php echo site_url(); ?>/privacy-policy-web/" target="_balnk"><u>Privacy Policy Here.</u></a></label>
                     </label>
                     <div class="error-message" id="err_terms_book">
                        <?php echo $error['terms'];?>
                     </div>
                  </div>
                  <button class="msg-button button-message button" name="contact_book_submit" id="contact_book_submit">Submit
                  </button>
                  <div id ="dispnone" class="dispnone" style="display: none;">
                     <input type="text" name="contactform_book" id="contactform_book" value="">
                  </div>
               </form>
               <div class="contuct-details">
                  <?php //echo get_option('footer_content'); ?>
               </div>
               <?php //echo apply_filters('the_content',$post->post_content  ); ?>
            </div>
         </div>
         <?php $sidebar =get_post_meta(get_the_ID(),'_side_bar_pages',true); 
            if(!empty($sidebar)){
            
            ?>
         <div class="col-4">
            <div class="right-block">
               <div class="right-content">
                  <?php echo wpautop($sidebar); ?>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>
</div>
<?php get_footer(); ?>