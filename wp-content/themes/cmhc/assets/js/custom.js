/*Email validation*/

function isValidEmailAddress(r) {
    var e = RegExp(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i);
    return e.test(r)
}

/*Telephone validation*/
function isNumber(elementRef) {
  keyCode=elementRef.charCode;
  if ((keyCode >= 48) && (keyCode <= 57) || (keyCode <= 32)) {
      return true;
  }  else if (keyCode == 43) {
      if (jQuery('#'+elementRef.target.id).val().trim().length == 0){
          return true;
      } else {
          return false;
      }
  }
  return false;
}

/*Name validation*/
function onlyAlphabets(e) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        }else if (e) {
            var charCode = e.which;
        } else {
            return true;
        }
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode==0 || charCode==8){
            return true;
        }else{
          return false;
        }
    }
    catch (err) {
      alert(err.Description);
    }
}
/*validate email with charCode*/
jQuery(document).on('keypress','#email,#applicantemail',function(e){
    $(this).attr('maxlength','100');
    try {
        if (window.event) {
          var charCode = window.event.keyCode;
        } else if (e) {
          var charCode = e.which;
        } else { return true; }
        if ((charCode > 63 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 47 && charCode < 58) || charCode==0 || charCode==8 || charCode==46 || charCode==45 || charCode==95){
          return true;
        } else {
          return false;
        }
    }
    catch (err) {
      alert(err.Description);
    }
});

jQuery(document).on('keypress','#telephone,#applicanttelephone',function(e){
    var keyCode=e.charCode;
    if (keyCode == 32 && jQuery('#'+e.target.id).val().trim().length == 0) {
        return false;
    }
    if (keyCode == 43 && jQuery('#'+e.target.id).val().trim().length == 0) {
        return true;
    } else {
        if ((keyCode >= 48) && (keyCode <= 57) || (keyCode <= 32)) {
            return true;
        } else {
          return false;
        }
    }
    return false;
});

jQuery(document).on('keypress','#firstname,#applicantname',function(e){
    try {
    if (window.event) {
        var charCode = window.event.keyCode;
    }
    else if (e) {
        var charCode = e.which;
    }
    else { return true; }
    if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode==0 || charCode==8)
        return true;
    else if ((charCode === 32 && !this.value.length))
        return false;
    else if (charCode == 32)
        return true;
    else
        return false;
    }
    catch (err) {
   // alert(err.Description);
  }
});

/*allow only one space*/
var lastkey;
var ignoreChars = ' '+String.fromCharCode(0);
jQuery(document).on('keypress','#firstname,#applicantname,#organization,#message,#applicantmessage,#telephone,#applicanttelephone,#address',function(e){
 e = e || window.event;
 var char = String.fromCharCode(e.charCode);
 if (ignoreChars.indexOf(char) == 0 && ignoreChars.indexOf(lastkey) == 0) {
     lastkey = char;
     return false;
 } else {
     lastkey = char;
     return true;
 }
});

/*********Mobile Validation*********/
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("android") > -1 && !(ua.indexOf('chrome firefox') > -1)) {
    $(document).on('keyup keypress','#firstname,#applicantname,#message,#address,#applicantmessage',function(e) {
        var regex = /^[a-zA-Z]$/;
        var regexSpace = /^[a-zA-Z\s]$/;
        var str = $(this).val();
        var subStr = str.substr(str.length - 1);
        if (!regex.test(subStr)) {
            if (str.length == 1) {
                $(this).val(str.substr(0, (str.length - 1)));
            }
            else if (str.length > 1) {
                if (!regexSpace.test(subStr)) {
                    $(this).val(str.substr(0, (str.length - 1)));
                }
            }
            else {
                $(this).val();
            }
        }
    });
}
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("android") > -1 && !(ua.indexOf('chrome firefox') > -1)) {
    $(document).on('keyup keypress','#email','#applicantemail',function(e) {
        var regex = /^[a-zA-Z0-9@_-]$/;
        var regexSpace = /^[a-zA-Z0-9.@_!#$%^&()=,[]|{}]$/;
        var str = $(this).val();
        var subStr = str.substr(str.length - 1);
        if (!regex.test(subStr)) {
            if (str.length == 1) {
                $(this).val(str.substr(0, (str.length - 1)));
            }
            else if (str.length > 1) {
                if (!regexSpace.test(subStr)) {
                    $(this).val(str.substr(0, (str.length - 1)));
                }
            }
            else {
                $(this).val();
            }
        }
    });
}
var ua = navigator.userAgent.toLowerCase();
if (ua.indexOf("android") > -1 && !(ua.indexOf('chrome firefox') > -1)) {
    jQuery('#telephone,#applicanttelephone').prop('type','tel');
    $('#telephone').bind('input keyup keypress', function(e) {
        var regex = /^[0-9]*$/;
        var regexSpace = /^[+0-9]*$/;
        var str = $(this).val();
        var subStr = str.substr(str.length - 1);
        if (regex.test(subStr)) {
           $(this).val();
        }
        else {
            if (str.length == 1) {
               $(this).val(str.substr(0, (str.length - 1)));
            } 
            else if (str.length > 1) {
                if (!regexSpace.test(subStr)) {
                   $(this).val(str.substr(0, (str.length - 1)));
                }
            }
            else {
                $(this).val();
            }
        }
    }); 
}

function trim (el) {
    el.value = el.value.
       replace (/(^\s*)|(\s*$)/gi, ""). // removes leading and trailing spaces
       replace (/[ ]{2,}/gi," ").       // replaces multiple spaces with one space 
       replace (/\n +/,"\n");           // Removes spaces after newlines
    return;
}
  

$(function(){
	
	 $(".tabs .tabs-links a").on("click",function(t){
    console.log('click here');
    console.log($(this).parent('li').is(':last-child'));
    if(!$(this).parent('li').is(':last-child')){
      return false;
    }else{
      return true;
    }
    
   });

	   // $('.extand-section').insertAfter('.col-3.share');
    jQuery( document ).on('click',"#contact_submit",function() {
       var name=jQuery('#firstname').val();
       var email=jQuery('#email').val();
       var telephone=jQuery('#telephone').val();
       var subject=jQuery('#subject').val().trim();
       var message=jQuery('#message').val().trim();
       var terms=jQuery('#terms').val().trim();
       
       var address=jQuery('#address').val();
       var existingCustomer=jQuery('input[name=existing_customer]:checked', '#contact_us_frm').val();
       var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
       var x=0;
       console.log(x);
        if (name=='' || name == undefined) {
           jQuery('#err_firstname').parents('.form-row').addClass('error-row');
           jQuery('#err_firstname').text("Please enter your name").show();

           x++;

        } else {
           jQuery('#err_firstname').parents('.form-row').removeClass('error-row');
           jQuery('#err_firstname').hide();
        }
        if (email!='') {
           if (!regex.test(email)) {
               jQuery('#err_login_email').hide();
               jQuery('#err_login_email').parents('.form-row').addClass('error-row');
               jQuery('#err_login_email').text("Please enter a valid email address").show();
               x++;
           } else {
               jQuery('#err_login_email').parents('.form-row').removeClass('error-row');
               jQuery('#err_login_email').hide();
           }
        } else {
           jQuery('#err_login_email').hide();
           jQuery('#err_login_email').text("Please enter your email address").show();
           jQuery('#err_login_email').parents('.form-row').addClass('error-row');
           x++;
        }
     if (subject=='' || subject == undefined) {
           jQuery('#err_subject').parents('.form-row').addClass('error-row');
           jQuery('#err_subject').text("Please enter your subject").show();
           x++;
        } else {
           jQuery('#err_subject').parents('.form-row').removeClass('error-row');
           jQuery('#err_subject').hide();
        }
        if (telephone=='' || telephone == undefined) {
           jQuery('#err_telephone').parents('.form-row').addClass('error-row');
           jQuery('#err_telephone').text("Please enter your phone number").show();
           x++;
        } else {
           jQuery('#err_telephone').parents('.form-row').removeClass('error-row');
           jQuery('#err_telephone').hide();
        }
        if (message=='' || message ==undefined) {
           jQuery('#err_message').parents('.form-row').addClass('error-row');
           jQuery('#err_message').text("Please enter your message").show();
           x++;
        } else {
             jQuery('#err_message').parents('.form-row').removeClass('error-row');
           jQuery('#err_message').hide();
        }

        console.log($('#terms').is(":checked")  );
        console.log(terms);


  

        if ($('#terms').is(":checked")) {



        
        jQuery('#err_terms').parents('.checkboxradio-row').removeClass('error-row');
        jQuery('#err_terms').hide();

        } else {

        console.log('here1');
        jQuery('#err_terms').parents('.checkboxradio-row').addClass('error-row');
        jQuery('#err_terms').text("Please agree the terms and condition").show();

        x++;

        }
  


        /*if (address=='' || address ==undefined) {
           jQuery('#err_address').parents('.form-row').addClass('error-row');
           jQuery('#err_address').text("Please enter your address").show();
           x++;
        } else {
           jQuery('#err_address').parents('.form-row').removeClass('error-row');
           jQuery('#err_address').hide();
        }*/
       
        if (x==0) {
           return true;
       }
       return false;
    });


	jQuery( document ).on('keyup','form input[type=text]',function() {
    $('.pri-check').fadeIn();
  });
	$('.pri-check').hide();
/* booking form */
	
    // $('.extand-section').insertAfter('.col-3.share');
    jQuery( document ).on('click',"#contact_book_submit",function() {
       var fname=jQuery('#bookfirstname').val().trim();
       var dob=jQuery('#bookdob').val();
       //var gender=jQuery('#bookgender').val();
       var bookparentname=jQuery('#bookparentname').val().trim();
       
       var natcon = [];

       var bookemail=jQuery('#bookemail').val();
       var telephone=jQuery('#booktelephone').val().trim();
       //var nature_of_concerns=jQuery('#nature_of_concerns').val();
       var message=jQuery('#bookmessage').val();
       var address=jQuery('#bookaddress').val();
          var terms_book=jQuery('#terms_book').val().trim();

       var existingCustomer=jQuery('input[name=existing_customer]:checked', '#contact_book_us_frm').val();
       var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
       var x=0;
       console.log(x);
        if (fname=='' || fname == undefined) {


           jQuery('#bookerr_firstname').parents('.form-row').addClass('error-row');
           jQuery('#bookerr_firstname').text("Please enter your Child's name").show();
           x++;
        } else {
           jQuery('#bookerr_firstname').parents('.form-row').removeClass('error-row');
           jQuery('#bookerr_firstname').hide();
        }
        
        if (dob=='' || dob == undefined) {
           jQuery('#bookerr_dob').parents('.form-row').addClass('error-row');
           jQuery('#bookerr_dob').text("Please enter your Child's date of birth").show();
           x++;
        } else {
           jQuery('#bookerr_dob').parents('.form-row').removeClass('error-row');
           jQuery('#bookerr_dob').hide();
        }
        
        
       /* if (gender=='' || gender == undefined) {
           jQuery('#bookerr_gender').parents('.form-row').addClass('error-row');
           jQuery('#bookerr_gender').text("Please enter your dob").show();
           x++;
        } else {
           jQuery('#bookerr_gender').parents('.form-row').removeClass('error-row');
           jQuery('#bookerr_gender').hide();
        }*/
        
          if (bookparentname=='' || bookparentname == undefined) {
           jQuery('#bookerr_parentname').parents('.form-row').addClass('error-row');
           jQuery('#bookerr_parentname').text("Please enter your parentname").show();
           x++;
        } else {
           jQuery('#bookerr_parentname').parents('.form-row').removeClass('error-row');
           jQuery('#bookerr_parentname').hide();
        }
        
        
        
        
        
        if (bookemail!='') {
           if (!regex.test(bookemail)) {
               jQuery('#bookerr_login_email').hide();
               jQuery('#bookerr_login_email').parents('.form-row').addClass('error-row');
               jQuery('#bookerr_login_email').text("Please enter a valid email address").show();
               x++;
           } else {
               jQuery('#bookerr_login_email').parents('.form-row').removeClass('error-row');
               jQuery('#bookerr_login_email').hide();
           }
        } else {
           jQuery('#bookerr_login_email').hide();
           jQuery('#bookerr_login_email').text("Please enter your email address").show();
           jQuery('#bookerr_login_email').parents('.form-row').addClass('error-row');
           x++;
        }
        $('.nature_of_concerns:checked').each(function () {
              natcon.push($(this).val());
        });
        
        console.log(natcon);
    // if (nature_of_concerns=='' || nature_of_concerns == undefined) {
     //      jQuery('#bookerr_nature_of_concerns').parents('.form-row').addClass('error-row');
     //     jQuery('#bookerr_nature_of_concerns').text("Please enter your").show();
      //     x++;
      //  } else {
        //   jQuery('#bookerr_nature_of_concerns').parents('.form-row').removeClass('error-row');
       //    jQuery('#bookerr_nature_of_concerns').hide();
      //  }
        if (telephone=='' || telephone == undefined) {
           jQuery('#bookerr_telephone').parents('.form-row').addClass('error-row');
           jQuery('#bookerr_telephone').text("Please enter your phone number").show();
           x++;
        } else {
           jQuery('#bookerr_telephone').parents('.form-row').removeClass('error-row');
           jQuery('#bookerr_telephone').hide();
        }
        if (message=='' || message ==undefined) {
           jQuery('#bookerr_message').parents('.form-row').addClass('error-row');
           jQuery('#bookerr_message').text("Please enter your message").show();
           x++;
        } else {
           jQuery('#bookerr_message').parents('.form-row').removeClass('error-row');
           jQuery('#bookerr_message').hide();
        }

        /*if (address=='' || address ==undefined) {
           jQuery('#err_address').parents('.form-row').addClass('error-row');
           jQuery('#err_address').text("Please enter your address").show();
           x++;
        } else {
           jQuery('#err_address').parents('.form-row').removeClass('error-row');
           jQuery('#err_address').hide();
        }*/
       



       if ($('#terms_book').is(":checked")) {
        
        jQuery('#err_terms_book').parents('.checkboxradio-row').removeClass('error-row');
        jQuery('#err_terms_book').hide();

        } else {

        console.log('here1');
        jQuery('#err_terms_book').parents('.checkboxradio-row').addClass('error-row');
        jQuery('#err_terms_book').text("Please agree the terms and condition").show();

        x++;

     }  





        if (x==0) {
           return true;
       }
       return false;
    });
    $(".input-item").not(".non-mandatory").bind({                
       keyup: function() {
           var $thisValue = $(this).val();
           var $errorText  = $(this).parents('.form-row').find('label').attr('data-error');
           if ($thisValue.length == 0) {
              if($(this).parents('.form-row').find('.error-message').is(':hidden')) {
                $(this).parents('.floating-item').next('.error-message').css('display','none');
                $(this).parents('.form-row').addClass('error-row');
                $(this).parents('.floating-item').next('.error-message').text($errorText).slideDown();
              }
           } else if ($thisValue.length != 0) {
              $(this).parents('.form-row').removeClass('error-row');
              $(this).parents('.form-row').find('.error-message').hide();
              if ($(this).hasClass('validate-email')) {
                  if (0 == isValidEmailAddress($(this).val())) {
                      e = 'Please enter a valid email address';
                      $(this).parents(".form-row").addClass("error-row");
                      $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

                  } else {
                      $(this).parents(".form-row").removeClass("error-row");
                      $(this).parents(".form-row").find(".error-message").fadeOut(function() {
                          $(this).hide();
                      });
                  }
              } else if ($(this).hasClass('validate-mobile')) {
                  if ($(this).val().length < 10) {
                      e = 'Please enter a valid phone number';
                      $(this).parents(".form-row").addClass("error-row");
                      $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

                  } else {
                      $(this).parents(".form-row").removeClass("error-row");
                      $(this).parents(".form-row").find(".error-message").fadeOut(function() {
                          $(this).hide();
                      });
                  }	
              }
           }
       },
       blur: function() {
           var $thisValue = $(this).val();
           var $errorText  = $(this).parents('.form-row').find('label').attr('data-error');
           $(this).parent('.floating-item').removeClass('input-animate');
           if ($thisValue.length == 0) {
               if($(this).parents('.form-row').find('.error-message').is(':hidden')) {
                $(this).parents('.floating-item').next('.error-message').css('display','none');
                $(this).parents('.form-row').addClass('error-row');
                $(this).parents('.floating-item').next('.error-message').text($errorText).slideDown();
               }
           } else {
               $(this).parents('.form-row').removeClass('error-row');
               $(this).parents('.form-row').find('.error-message').hide();
               if ($(this).hasClass('validate-email')) {
                  if (0 == isValidEmailAddress($(this).val())) {
                          e = 'Please enter a valid email address';
                          $(this).parents(".form-row").addClass("error-row");
                          $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

                      } else {
                          $(this).parents(".form-row").removeClass("error-row");
                          $(this).parents(".form-row").find(".error-message").fadeOut(function() {
                              $(this).hide();
                          });
                      }
                  } else if ($(this).hasClass('validate-mobile')) {
                      if ($(this).val().length < 10) {
                          e = 'Please enter a valid phone number';
                          $(this).parents(".form-row").addClass("error-row");
                          $(this).parents(".form-row").find(".error-message").length ? $(this).parents(".form-row").find(".error-message").text(e).show() : $('<div class="error-message">' + e + "</div>").appendTo($(this).parents(".form-row")).show();

                      } else {
                          $(this).parents(".form-row").removeClass("error-row");
                          $(this).parents(".form-row").find(".error-message").fadeOut(function() {
                              $(this).hide();
                          });
                      }
                  }
           }
       }
   });
});
/*Applu now Form*/
    jQuery( document ).on('click',"#applyonline_submit",function() {
       var name=jQuery('#applicantname').val();
       var email=jQuery('#applicantemail').val();
       var telephone=jQuery('#applicanttelephone').val();
       var message=jQuery('#applicantmessage').val();
       var resume=jQuery('#file-upload-value').val();
       var job_id=jQuery("#career_id").val();
       var regex = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
       var x=0;
       if (name=='' || name == undefined) {
           jQuery('#err_firstname').parents('.form-row').addClass('error-row');
           jQuery('#err_firstname').text("Please enter your name").show();
           x++;
       } else {
           jQuery('#err_firstname').parents('.form-row').removeClass('error-row');
           jQuery('#err_firstname').hide();
       }
        if (email!='') {
            if (!regex.test(email)) {
               jQuery('#err_login_email').hide();
               jQuery('#err_login_email').parents('.form-row').addClass('error-row');
               jQuery('#err_login_email').text("Please enter a valid email address").show();
               x++;
            } else {
               jQuery('#err_login_email').parents('.form-row').removeClass('error-row');
               jQuery('#err_login_email').hide();
            }
        }   else {
           jQuery('#err_login_email').hide();
           jQuery('#err_login_email').text("Please enter your email address").show();
           jQuery('#err_login_email').parents('.form-row').addClass('error-row');
           x++;
        }
        if (telephone=='' || telephone == undefined) {
           jQuery('#err_telephone').parents('.form-row').addClass('error-row');
           jQuery('#err_telephone').text("Please enter your telephone number").show();
           x++;
        } else {
           jQuery('#err_telephone').parents('.form-row').removeClass('error-row');
           jQuery('#err_telephone').hide();
        }
        if (message=='' || message ==undefined) {
           jQuery('#err_message').parents('.form-row').addClass('error-row');
           jQuery('#err_message').text("Please enter your message").show();
           x++;
        } else {
           jQuery('#err_message').parents('.form-row').removeClass('error-row');
           jQuery('#err_message').hide();
        }
        if (resume!='') {
            var fileName = document.getElementById("filename").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile=="doc" || extFile=="docx" || extFile=="pdf" || extFile=="DOC" || extFile=="DOCX" || extFile=="PDF"){
                $('#file-upload-value').parents(".form-row").find(".error-message").remove();
                $('#file-upload-value').parents('.form-row').removeClass('error-row');
                
            }else{
                if ($('#file-upload-value').parents('.form-row').find('.error-message').length==0) {
                $('<div class="error-message">Please Upload doc or pdf files</div>').appendTo($('#file-upload-value').parents(".form-row")).slideDown();
                } else {
                    $('#file-upload-value').parents(".form-row").find(".error-message").text('Please Upload doc or pdf files').slideDown();
                }
                x++;
            }

        } else {
            jQuery('#err_resume').parents('.form-row').addClass('error-row');
            jQuery('#err_resume').text("Please upload your resume").show();
            x++;
        }
        if (x==0) {
           var file = jQuery("#filename").prop("files")[0];
           jQuery.ajax({
                url : templateUri+"/ajax.php",
                type : 'POST',
                data : new FormData($("#applyonline_frm")[0]),
                cache: false,
                contentType: false,
                processData: false,
                success : function(data) {
                    console.log('data');
                    console.log(data);
                    window.location.href = blogUri + "/apply-now/thank-you/"
               }
            });
            return false;
        }
       return false;
   });
$(document).ready(function(){
  $('.tab-menu li:first-child').addClass('active');
	$('.tab-header li:first-child').addClass('active');
	$('.price-innerBlk li:first-child').css('display', 'list-item');
	//alert($('.tab-menu li:first-child').addClass('active'));
  //console.log($( 'p:empty' ).parent().get(0));
  $('p:empty').remove();  
  $('.container').each(function() {
    var $this = $(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.parent().remove();
  });
 
});

//$(".dobtext").addClass('textbox');
$( ".dobtext" ).last().addClass( "selected" );

//$('.dobtext').datepicker('remove');







$('.dobtext').on('click', function(){
    $('.dobtext').removeClass('current');
    $(this).addClass('input-email-active');
});



/********Learn-More functions*************/
jQuery(document).on('click','#load-more-products',function(){
    careerAjaxSend = true;
    var val = $('#child-id').val();
 //var categoryId = $('#cat_id').val();
 //var categoryName = $('#cat_name').val();
  var hidden = $('#blogs-hidden').val();
  var postIdArray = [];
  var cntPost = $('#pst_count').val();
  var $container = $('#grid');
 //  console.log('here'+postIdArray);
 //  console.log($(this).parents('.container').find('#grid .testone').length);
  $(this).parents('.container').find('#grid .testone').each(function() {

 // alert('gdfg');


      postIdArray.push($(this).attr('data-id'));
    });
  $.ajax({
        url : templateUri+'/ajax/product_load.php',
       method: 'post',
        data: {postIdArray:postIdArray},
      success: function(data){
      // console.log(data);
        // console.log('cntPost->'+cntPost);
        // console.log('postIdArray->'+parseInt(postIdArray.length));
        // console.log(cntPost +'<='+ parseInt(postIdArray.length+3));
        
    	
         $('.loadcontent').append(data);
         if(cntPost <= parseInt(postIdArray.length+3)){
          $("#loadMore").css("display","none")
         }
        }
    });
});



/* For cookie policy popup */
$(document).ready(function() {
jQuery(document).on('click','.button_cookk',function(){
  var cookie_name = 'cook_pol';
  var cookie_value = "1";
    $.ajax({
      url: templateUri + '/ajax/cookie-ajax.php',
        data: {cookie_name: cookie_name, cookie_value:cookie_value},
        type:"POST",
        success: function(result) {
     
        $("body").removeClass("hide-content");
        $(".cookie-policy").fadeOut('fast');
        // location.reload();
          
        }
  });
});
});
