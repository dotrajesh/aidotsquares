<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <!-- <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' /> -->
	  <meta name="viewport" 
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	  <title>AI Application Development Company | AI Dotsquares</title>
      <meta name="HandheldFriendly" content="true">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head()?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-MCJ3JGV');</script>
	<!-- End Google Tag Manager -->
	<!-- Favicons -->
  <link href="<?php bloginfo('template_url'); ?>/assets/images/favicon.png" rel="icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script>
			var SITE_URL = '<?php echo get_site_url() ?>';
			var AJAX_URL = '<?php echo admin_url( "admin-ajax.php" ); ?>';
	</script>	

</head>

<body id="home" onload="createCaptcha()" >
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MCJ3JGV"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

  <!-- ======= Header ======= -->
    <?php
      if(is_front_page()){ ?>
        <header id="header" class="header fixed-top " data-scrollto-offset="0">
      <?php
      }
      else{ ?>
      <header id="header" class="header fixed-top  nav-bg" data-scrollto-offset="0"> 
      <?php }
      ?>

    <div class="container d-flex align-items-center justify-content-between">
        <?php echo the_custom_logo(); ?>       
      <div class="d-flex ai-content-div">
        <span class="close"><i class="fas fa-times"></i></span>
        <div class="nav-test">
        <nav id="navbar" class="navbar me-3"> 
            <?php 
              wp_nav_menu( array( 
                'menu' => 'Main Header Menus',
                'container' => 'ul',
                'walker' => new AI_Walker_Nav_Menu()
              ) ); 
            ?>
        </nav>
      </div>
    </div>
    <?php if(is_front_page()){ ?>
      <a class="scroll-top3 btn-getstarted" href="#">Contact Us</a> 
    <?php }
    else{ ?>
      <a class="scroll-top3 btn-getstarted scrollto" href="<?php echo site_url() ?>/">Contact Us</a> 
    <?php } ?>
      <span class="toggle-mobile"><i class="fas fa-bars "></i></span> 
    </div>
  </header><!-- End Header -->
