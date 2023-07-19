<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
 <!-- ======= Footer ======= -->
  <footer id="footer">
     <div class="footer-top">
       <div class="container">
         <div class="row">
           <div class="col-lg-4 col-md-6 footer-contact">
              <?php //dynamic_sidebar( 'sidebar-1' ); 
              $getOptionVal =get_option('saddress'); 

              if((!empty($getOptionVal[0]['sofficeadd'])) || (!empty($getOptionVal[0]['sofficeimg']))){
                $found =true;
              }else{
                $found =false;
              }
              ?>
            <h3>Contact</h3>
           <?php if($found){  ?>
             <h4>Sales Office:</h4>
              <ul>
                <?php foreach($getOptionVal as $key => $data){ ?>
                  <li>
                    <?php if(!empty($data['sofficeimg'])){
                       $imgUrl = wp_get_attachment_image_url($data['sofficeimg'], array( 80, 80 ) );
                       ?>
                       <img src="<?php echo $imgUrl; ?>" alt="office-<?php echo $key+1; ?>" width="61" height="61" />
                       <?php
                    } ?>
                  <span>
                   <?php if(!empty($data['sofficeadd'])){
                          echo $data['sofficeadd'];
                     } ?>
                  </span>
                </li>
              <?php  }
              $doffice =get_option('daddress');
              if((!empty($doffice['dofficeadd'])) || (!empty($doffice['dofficeimg']))){ ?>
                <h4 class="mt-4">Development Office:</h4>
             <ul>
                <li>
                <?php if(!empty($doffice['dofficeimg'])){
                    $imgUrl = wp_get_attachment_image_url($doffice['dofficeimg'], array( 80, 80 ) ); ?>
                    <img src="<?php echo $imgUrl; ?>" alt="office-4" width="61" height="61" />
                <?php } ?>
                  <span>
                  <?php if(!empty($doffice['dofficeadd'])){
                          echo $doffice['dofficeadd'];
                     } ?>
                  </span>
                </li>                  
             </ul>
             <?php }
              
              ?>
               <!--  <li>
                  <img src="<?php //bloginfo('template_url'); ?>/assets/images/office-1.png" alt="office-1" width="61" height="61" />
                  <span>
                    Unit 2, Albourne Court, Henfield Road, Albourne<br>
                    West Sussex, BN6 9FF, UK<br>
                    +44 1273 575190
                  </span>
                </li>
                <li>
                  <img src="<?php //bloginfo('template_url'); ?>/assets/images/office-2.png" alt="office-2" width="61" height="61" />
                  <span>
                    6701 Democracy Blvd. Suite 300, Bethesda, MD<br>
                   20817, USA<br>
                   +301 563 9488
                 </span>
                </li>
                <li>
                  <img src="<?php //bloginfo('template_url'); ?>/assets/images/office-3.png" alt="office-3" width="61" height="61" />
                  <span>897 Waverly Road, Glen Waverly, VIC 3150<br>
                     Australia<br>
                     +61 03 8676 8288(M)
                  </span>
                </li>
             </ul>
             <?php }
              ?>
             <h4 class="mt-4">Development Office:</h4>
             <ul>
                <li>
                  <img src="<?php //bloginfo('template_url'); ?>/assets/images/office-4.png" alt="office-4" width="61" height="61" />
                  <span>
                    J3, Jhalana Institutional Area, Jhalana Dungri, Jaipur.<br>
                       302004, India<br>
                       +91-141-2651369
                  </span>
                </li>                  
             </ul>-->
           </div>
           <div class="col-lg-4 col-md-6 footer-links">
           <?php dynamic_sidebar( 'sidebar-2' ); ?>
            <!-- <h3>Site Links</h3>
             <ul>
               <li><a href="https://www.dotsquares.com/" aria-label="About Dotsquares" target="_blank">About Dotsquares</a></li>
               <li><a href="https://www.dotsquares.com/contact" aria-label="Contact Us" target="_blank">Contact Us</a></li>
             </ul>-->
           </div>
           <div class="col-lg-4 col-md-6 footer-links">
           <?php //dynamic_sidebar( 'sidebar-3' ); 
           $socialmedia =get_option('socialmedia');

           if((!empty($socialmedia[0]['smedianame'])) || (!empty($socialmedia[0]['smediaimg']))){
            $found_social =true;
          }else{
            $found_social =false;
          }

          if($found_social){ ?>
            <h3>Follow Us</h3>
            <div class="social-links mt-3">
          <?php foreach($socialmedia as $social){ 
             $imgUrl = wp_get_attachment_image_url($social['smediaimg'], array( 80, 80 ) );
            ?>
             <a href="<?php echo $social['smedianame']; ?>" class="social" target="_blank"><img src='<?php echo $imgUrl; ?>'>
            </a>

         <?php }
          echo '</div>';
         }
           
           ?>
           </div>
         </div>
         <div class="row">
           <div class="col-lg-12">
           <div class="copyright">
           <?php $cpywritemsg =get_option('cpywritemsg'); 
           if(!empty($cpywritemsg['cpywritemsg'])){
            echo $cpywritemsg['cpywritemsg'];
        
           }
           ?>
           </div>
           <?php //dynamic_sidebar( 'sidebar-4' ); ?>
           </div>
         </div>
       </div>
     </div>
   </footer>
  <!-- End Footer -->



<?php wp_footer(); ?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="fas fa-chevron-up"></i>
  </a>
 
 
  <!-- Vendor JS Files -->
     <script>
      jQuery('.owl-carousel7').owlCarousel({
          loop:true,
          margin:10,
          nav:true,
          autoplay:true,
           // autoplay:true,
          autoplaySpeed:1000,
          responsive:{
              0:{
                  items:1
              },
              
              600:{
                  items:2
              },
             800:{
                 items:2
             },
              1000:{
                  items:3
              },
              1200:{
                  items:3
              },
              // breakpoint from 768 up
              1201:{
                  items:3
              }
          }
      })
     
          var owl = jQuery('#owl-carousel1');
          owl.owlCarousel({
            margin: 10,
            nav: true,
            autoplay:true,
            autoplayTimeout:5000,
            loop: true,
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 2
              },
              800: {
                items: 2
              },
              1000: {
                items: 2
              },
              1200: {
                items: 3
              }
            }
          })
       
    </script>
     <script>
      jQuery('.test1').owlCarousel({
          loop:true,
          margin:10,
          nav:true,
           autoplay:true,
          // autoplaySpeed:1000,
          responsive:{
              0:{
                  items:3
              },
              600:{
                  items:5
              },
              1000:{
                  items:6
              }
          }
      })
    </script>
    <script>
    jQuery(document).ready(function(){
      jQuery(".header .toggle-mobile").click(function(){
        jQuery("body").addClass("active");
      });
      jQuery(".header .navbar a.nav-link").click(function(){
        jQuery("body").removeClass("active");
      });
       jQuery(".header .close").click(function(){
        jQuery("body").removeClass("active");
      });

      //  jQuery('#navbar ul li a').click(function(){
      //     jQuery('#navbar ul li a').removeClass("active");
      //     jQuery(this).addClass("active");
      // });
      //   jQuery('.header .scroll-top3').click(function(){
      //      jQuery('#navbar ul li a[href="home"]').addClass("active");
      //  });
    });

   

  </script>

  <!-- <COUNTER -->

    <script>
   // Counter To Count Number Visit
  var a = 0;
  jQuery(window).scroll(function() {

    var oTop = jQuery('#counter').offset().top - window.innerHeight;
    // Md.Asaduzzaman Muhid
    if (a == 0 && jQuery(window).scrollTop() > oTop) {
      jQuery('.counter').each(function() {
          var $this = jQuery(this);
          //console.log( $this.text());
          jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
              duration: 3000,
              easing: 'swing',
              step: function () {
                  $this.text(Math.ceil(this.Counter));
              }
          });
      });
      a = 1;// Md.Asaduzzaman Muhid
    }
  });
  </script>

  <script>

      jQuery("#typed").typed({
        //strings: ["<span>Let’s Design The future with</span>"],
        strings: ["<span>"+jQuery('#typed').attr('data-val')+"</span>"],
         //stringsElement: document.getElementById('typed'),
        typeSpeed: 10,
        startDelay: 0,
        backSpeed: 50,
        backDelay: 500,
        loop: false,
        contentType: 'html'
      });

      jQuery("#typed0").typed({
       //strings: [" AI Together"],
       strings: [jQuery('#typed0').attr('data-val')],
        typeSpeed: 120,
        startDelay: 0,
        backSpeed: 300,
        backDelay: 2000,
        loop: false,
        contentType: 'html'
      });

      jQuery("#typed2").typed({
        //strings: ["<b>We engineer empirical data-driven Algorithms To Power Machine Intelligence for our clients. Accelerate your digital transformation with our AI development services.</b> "],
        strings: ["<br>"+jQuery('#typed2').attr('data-val')+"</b>"],
        typeSpeed: 10,
        startDelay: 0,
        backSpeed: 100,
        backDelay: 200,
        loop: false,
        contentType: 'html'
      });
  </script>


    <script type="text/javascript">

            var code;
            function createCaptcha() {
              //clear the contents of captcha div first 
              document.getElementById('captcha').innerHTML = "";
              var charsArray =
              "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
              var lengthOtp = 6;
              var captcha = [];
              for (var i = 0; i < lengthOtp; i++) {
              //below code will not allow Repetition of Characters
              var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
              if (captcha.indexOf(charsArray[index]) == -1)
              captcha.push(charsArray[index]);
              else i--;
              }
              var canv = document.createElement("canvas");
              canv.id = "captcha";
              canv.width = 100;
              canv.height = 50;
              var ctx = canv.getContext("2d");
              ctx.font = "25px Georgia";
              ctx.strokeText(captcha.join(""), 0, 30);
              //storing captcha so that can validate you can save it somewhere else according to your specific requirements
              code = captcha.join("");
              document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
            }
            function validateCaptcha() {
                  event.preventDefault();
              // console.log(code);
              jQuery("#captcha-error").remove();
              if (document.getElementById("cpatchaTextBox").value == code) {
                  jQuery("#captcha-error").remove();
                  return true;
              } else {
                  jQuery("#cpatchaTextBox").parent().append('<label id="captcha-error" class="error" for="captcha">Please enter valid captcha.</label>'); 
                  return false;
              }
            }

            jQuery("#cpatchaTextBox").blur( function() {
                jQuery("#captcha-error").remove();
                if( jQuery(this).val() == '') {
                      jQuery("#cpatchaTextBox").parent().append('<label id="captcha-error" class="error" for="captcha">This field is required.</label>');  
                      return false;
                } else { 
                  validateCaptcha();
                }
            });

              jQuery(document).ready(function() {
                jQuery("#contact-form").validate({
                  rules: {
                      name: {
                        required: true,
                        normalizer: function( value ) {                
                          return jQuery.trim( value );
                        }
                      },
                      email: {
                        required: true,
                        email: true,
                        normalizer: function( value ) {                
                          return jQuery.trim( value );
                        }
                      },
                      phone: {
                        required: true,
                        normalizer: function( value ) {                
                          return jQuery.trim( value );
                        },
                        
                      },
                      // message: {
                      //   required: true,
                      //   normalizer: function( value ) {                
                      //     return jQuery.trim( value );
                      //   }
                      // }
                  }
            });

              // this is the id of the form
              jQuery("#contact-form").submit(function(e) {
                  e.preventDefault(); // avoid to execute the actual submit of the form.
             
                  var form = jQuery(this);
                  //var url = form.attr('action');
                  if(jQuery("#phone").val() !=''){
                    jQuery("#phone").siblings('#phone-error').remove();
                    if(!jQuery.isNumeric(jQuery("#phone").val())){
                    jQuery("#phone").parent().append('<label id="phone-error" class="error" for="phone" style="">Phone number format not valid.</label>');  
                      return false;

                  }else if( (jQuery("#phone").val().toString().length > 15) || (jQuery("#phone").val().toString().length < 6) ) {
                      jQuery("#phone").parent().append('<label id="phone-error" class="error" for="phone" style="">Phone number not valid.</label>'); 
                      return false;
                  }else{
                    jQuery("#phone").siblings('#phone-error').remove();
                    jQuery("#phone").parent().append('<label id="phone-error" class="error" for="phone" style="display:none">This field is required.</label>');
    
                  }

                  }
                  

                  jQuery("#captcha-error").remove();
                  if( jQuery("#cpatchaTextBox").val() == '') {
                      jQuery("#cpatchaTextBox").parent().append('<label id="captcha-error" class="error" for="captcha">This field is required.</label>');  
                      return false;
                  } 
                  var captchaMsg = validateCaptcha();
                  jQuery("#captcha-error").remove();
                  if (captchaMsg != false) {
                  if(jQuery("#name").val() !='' && jQuery("#email").val() !='' && jQuery("#phone").val() !='') {
                      jQuery('.lodder').show();
                      jQuery.ajax({
                          type: "POST",
                          url: AJAX_URL,
                          data: form.serialize(), // serializes the form's elements.
                          success: function(data)
                          {
                            let res = JSON.parse(data);
                            jQuery('.lodder').hide();
                            //  console.log(data);
                            //  return false;
                            jQuery("#name, #email, #phone, #message, #country, #cpatchaTextBox").val('');
                            if(res['type'] == 'success') {
                                jQuery('.formMsg').html('Thank you for your enquiry. We will contact you shortly.').addClass('alert alert-success').show();
                                // location.href = "thankyou.html";
                            } else {
                            jQuery('.formMsg').html('There is some error in sending your enquiry.').addClass('alert alert-danger').show();
                            }
                          }
                      });
                    } 
                  } else {
                      // alert("The captcha you entered is incorrect");
                        jQuery("#cpatchaTextBox").parent().append('<label id="captcha-error" class="error" for="captcha">Please enter valid captcha.</label>'); 
                        return false;
                  }
              });
          });


    </script>

    <style>

      #footer .footer-top .footer-links  ul.wp-block-social-links li{
        padding-top:0px;
      }
      #footer .footer-top .footer-links  ul.wp-block-social-links li a:hover{
        color:#ffffff;
      }
      /*spinner css start*/
      #content_block_09 .content-box #contact-form .form-group.text-center.mb-0 {
          display: flex;
          justify-content: center;
      }
      #content_block_09 .content-box #contact-form .form-group.text-center.mb-0 .spinner-border {
          position: absolute;
          left: 42%;
          top: 40%;
          width: 70px;
          height: 70px;
      }

      @media(max-width:700px){
       #content_block_09 .content-box #contact-form .form-group.text-center.mb-0 .spinner-border {
           right: -3px;
       } 
      }
      /*spinner css End*/
    </style>
</body>
</html>
