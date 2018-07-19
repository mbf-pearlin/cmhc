<?php
/*
* Template Name: Contact
*/
get_header();
?>
<style type="text/css">.checkboxradio-row .error-message {
    color: #e42828;
    display: none;
    font-size: 13px;
    padding: 5px 0;
}</style>
<?php
global $wpdb;
global $_POST;      
if ($_POST['contact_us_form'] != "" && $_POST['contactform'] == "") {
$table = $wpdb->prefix . "contact";
$data['name']        = sanitize_text_field($_POST['firstname']);
$data['email']            = sanitize_text_field($_POST['email']);
$data['telephone']        = sanitize_text_field($_POST['telephone']);
$data['subject']     = sanitize_text_field($_POST['subject']);
$data['message']          = nl2br($_POST['message']);

$data['posted_date']      = date('Y-m-d H:i:s');
$data['name'] = ucwords($data['name']);
$format = array('%s','%s','%s','%s','%s','%s','%s');
$err = 0;
if (empty($data['name'])) {
$error['firstname'] = "Please enter your name";
$err++;
}
if (empty($data['telephone'])) {
$error['telephone'] = "Please enter your phone number";
$err++;
}
if (empty($data['subject'])) {
$error['subject'] = "Please enter your subject";
$err++;
}
if (empty($data['email'])) {
$error['email'] = "Please enter your email";
$err++;
}
if (empty($data['message'])) {
$error['message'] = "Please enter your message";
$err++;
}



if (empty($err)) {
$insert_contact = $wpdb->insert($table, $data);
$lastid = $wpdb->insert_id;
//var_dump($insert_contact);
if($lastid != "") {  
$reurl = get_bloginfo('url') . "/contact-us/thank-you/";
echo '<script type="text/javascript">document.location="'.$reurl.'";</script>'; ?>
<?php $message = '
<html>
<body>
<div style="max-width:500px">
<p>Dear Admin,<br /><br />
The following message was submitted through the website today.<br /><br />
---- Message ----<br /><br />
Name - '. $data['name'] .'<br />
Email - ' . $data['email'] . ' <br />
Phone - ' . $data['telephone'] . '<br />
Subject - ' . $data['subject'] . '<br />
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
<p>Dear '. $data['name'] .',<br /><br />
Thank you for writing to us. We have forwarded your email to the
right department and you should get an answer back in 48 hours.<br /><br />
Regards,<br /><br />
On Behalf of CMHC<br /><br />
---- Your message ----<br /><br />
Name - '. $data['name'] .' <br />
Email - ' . $data['email'] . ' <br />
Phone - ' . $data['telephone'] . ' <br />
Subject - ' . $data['subject'] . ' <br />
Your Message - ' . $data['message'] . ' <br />
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
$to = $data['email'];
$subjectSender ="CMHC - Your message has been received.";
if (wp_mail($to, $subjectSender, $senderMessage, $headers)) {
unset($_POST);
$redirect_url = get_bloginfo('url') . "/contact-us/thank-you/";
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
    <div class="row contact-details">
      <div class="col-6 form-section contact">



        <div class="contact-us">

        <div class="contuct-details">
          <?php echo apply_filters('the_content',$post->post_content  ); ?>
          </div> 

          <form name="contact_us_frm" id="contact_us_frm" method="post" action="" >
            <?php wp_nonce_field('conactus_nonce','contact_us_form'); ?>
            <div class="form-row">
              <label class="floating-item"  data-error="Please enter your name">
                <input type="text" class="floating-item-input input-item test" name="firstname" maxlength="75" onkeypress="return onlyAlphabets(event, this)" id="firstname" value="" >    
                <span class="floating-item-label">Your name
                </span>
              </label>
              <div class="error-message" id="err_firstname"> 
                <?php echo $error['firstname'];?> 
              </div>                                           
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your email address">
                <input type="text" class="floating-item-input input-item validate-email" maxlength="100" name="email" id="email" value="" />
                <span class="floating-item-label">Your email
                </span>
              </label>
              <div class="error-message" id="err_login_email">
                <?php echo $error['email'];?>
              </div>
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your phone number">
                <input type="text" class="floating-item-input input-item validate-mobile" name="telephone" maxlength="12" onkeypress="return isNumber(event)" id="telephone" value="" />                                         
                <span class="floating-item-label">Contact number
                </span>
              </label>
              <div class="error-message" id="err_telephone">
                <?php echo $error['telephone'];?>
              </div>                                                
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your subject">
                <input type="text" name="subject"  class="floating-item-input input-item"  maxlength="75"  id="subject">  
                <span class="floating-item-label">Subject
                </span>
              </label>
              <div class="error-message" id="err_subject">
                <?php echo $error['subject'];?>
              </div>                                                
            </div>
            <div class="form-row">
              <label class="floating-item" data-error="Please enter your message">
                <input type="text"  class="floating-item-input input-item" name="message" id="message">   
                <span class="floating-item-label">Your message
                </span>
              </label>
              <div class="error-message" id="err_message">
                <?php echo $error['message'];?>
              </div>                                            
            </div>

          <?php echo '<div class="checkboxradio-row pri-check">
                <input class="checkboxradio-item checkboxradio-invisible" name="terms" id="terms" type="checkbox" >
                      <label class="checkboxradio-label checkbox-label" for="terms">Your information will be used to communicate and provide safe care. Your data will not be shared with any third party. Find out more information on CMHC<a href=
                        " '. site_url() .'/privacy-policy-web/" target="_balnk"> <u>Privacy Policy Here.</u> </a></label>
              <div class="error-message" id="err_terms">
                "'. $error['terms'].'"
              </div>    
            </div>'; ?>



            <button class="msg-button button-message button" name="contact_submit" id="contact_submit">Send Message
            </button>
            <div id ="dispnone" class="dispnone" style="display: none;">
              <input type="text" name="contactform" id="contactform" value="">
            </div>
          </form>
                 
        </div>
      </div>

      



      <div class="col-6 form-section contact-block">


      <div>

        <div class="contact-content" style="background-image: url(<?php echo get_template_directory_uri();
                                            ?>/assets/images/hand-contactus.png);">
          <ul>
            <li>
              <i class="la la-map-marker">
              </i>
              <?php echo get_option('ss_contact'); ?>
            </li>
            <li>
              <i class="la la-phone">
              </i>
              <?php echo get_option('ss_hours'); ?>
            </li>
          </ul>
        </div>

  <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2499.066400752085!2d-0.7951637486688758!3d51.2178524395531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48742d00331b7bd3%3A0xddd487c844fdc8f0!2sChild+Mental+Health+Clinic!5e0!3m2!1sen!2sin!4v1527682064930" frameborder="0" style="border:0" allowfullscreen></iframe>
                      </div>



      </div>

</div>




    </div>
  </div>
</div>

<?php get_footer(); ?>
