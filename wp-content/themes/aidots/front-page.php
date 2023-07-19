<!-- End Header -->
<?php get_header();

?>
<?php $pageID = get_the_ID();
$bannerContent    =get_field('banner_group',$pageID);
$serviceSection   =get_field('service_group',$pageID);
$introSection     =get_field('intro_section',$pageID);
$tooldSection     =get_field('tools_section',$pageID);
$caseSection      =get_field('case_study_section',$pageID);
$enquerySection   =get_field('enquery_section',$pageID);
$clientSection   =get_field('clientstatus_group',$pageID);
$developmentSection = get_field('development_group',$pageID);
$technologySection = get_field('technology',$pageID);
$partnerSection = get_field('plogo-group',$pageID);
$blogSection =get_field('post_section',$pageID);
?>

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero  carousel  carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source
            src="<?php if($bannerContent['banner_video']){ echo $bannerContent['banner_video']; }else{ bloginfo('template_url');  ?>/assets/video/video-1.mp4 <?php } ?>"
            type="video/mp4">
    </video>
    <div class="hero-bg"></div>
    <?php if($bannerContent['banner_image']){ $rotedIcon= $bannerContent['banner_image']; }else{ $rotedIcon= bloginfo('template_url').'/assets/images/wheel-2.png'; } ?>
    <div class="icon icon-1 rotate"
        style="background-image: url('<?php echo $rotedIcon; ?>'); background-size: 100% auto;"></div>
    <div class="container">
        <div class="row justify-content-center gy-6">
            <div class="col-lg-7 col-md-12 text-left pt-2 ">
                <div class="type-wrap">
                    <!-- add static words/sentences here (i.e. text that you don't want to be removed)-->
                    <span id="typed" class="typed" data-val='<?php echo $bannerContent['banner_tag_heading']; ?>'>
                        <?php //echo $bannerContent['banner_tag_heading']; ?>
                    </span>
                </div>
                <div class="type-wrap2">
                    <!-- add static words/sentences here (i.e. text that you don't want to be removed)-->
                    <span id="typed0" class="typed" data-val='<?php echo $bannerContent['banner_heading']; ?>'>
                    </span>
                </div>
                <div class="type-wrap2">
                    <!-- add static words/sentences here (i.e. text that you don't want to be removed)-->
                    <span id="typed2" class="typed" data-val='<?php echo $bannerContent['banner_sub_heading']; ?>'>
                    </span>
                </div>
                <!-- <p class="w-75"> We engineer empirical data-driven Algorithms To Power Machine Intelligence for our clients. Accelerate your digital transformation with our AI development services </p>-->
            </div>
            <div class="col-lg-5 col-md-12">
                <div id="content_block_09">
                    <div class="content-box">
                        <form method="post" id="contact-form" class="default-form" novalidate="novalidate">
                            <input type='hidden' name='action' value='enquiryaction' />
                            <p>
                                Book a call with our certified AI / ML Consultants
                            </p>
                            <div class="formMsg" style="display: none;"></div>
                            <div class="form-group">
                                <input type="text" name="name" id="name" placeholder="Enter name here" required=""
                                    aria-required="true">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" placeholder="Phone Number" required=""
                                    aria-required="true">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Email Address" required=""
                                    aria-required="true">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" placeholder="Drop message here"></textarea>
                            </div>
                            <!-- <div class="form-group">
                              <img src="<?php //bloginfo('template_url'); ?>/assets/images/captcha.png" alt="" class="img-fluid">
                              <input type="text" name="capcha" placeholder="Captcha" required="" aria-required="true">
                            </div> -->
                            <div class="form-group">
                                <div id="captcha" style="float: left;" id="captchabox" style="background-color: #f00;">
                                </div>
                                <div>
                                    <img src="<?php bloginfo('template_url'); ?>/assets/images/icon-refresh-white.png"
                                        width="15px;" style="margin-left: 15px; margin-top: 15px; cursor: pointer;"
                                        onclick="createCaptcha()" alt="icon-refresh-white" />
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="cpatchaTextBox" placeholder="Captcha" id="cpatchaTextBox"
                                    class="form-control" />
                            </div>
                            <br>
                            <div class="form-group text-center mb-0">
                                <button class="btn-get-started" type="submit" name="submit-form">Send Your
                                    Message</button>
                                <div class="spinner-border lodder" role="status" style="display: none;">
                                    <span class="visually-hidden"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Section -->
<main id="main" style="overflow: inherit; position: relative;">
    <div class="ai-brain banner-mt">
        <img src="<?php if($bannerContent['banner_static_image']){ echo $bannerContent['banner_static_image']; }else{ bloginfo('template_url').'/assets/images/Ai-brain.svg'; } ?>"
            alt="Ai-brain" />
    </div>
    <!-- ======= Services Section ======= -->
    <?php if(((isset($serviceSection['head-service']['data-service'])) && (!empty($serviceSection['head-service']['data-service']))) || ((isset($serviceSection['service-data'])) && (!empty($serviceSection['service-data'])))){
      ?>
    
    <section id="services" class="why-us">
        <div class="container right">
            <div class="row ">
                <div class="col-lg-3 d-flex align-items-stretch mb-3">
                    <div class="content mb-0 ai-modern">
                        <h3>
                          <?php if(isset($serviceSection['head-service']['data-service'])){
                              echo $serviceSection['head-service']['data-service'];
                          }  ?>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-9 d-flex align-items-stretch">
                    <div class="icon-boxes  flex-column justify-content-center w-100">
                        <div class="row ai-align">
                            <?php  if((isset($serviceSection['service-data'])) && (!empty($serviceSection['service-data']))){
                                foreach($serviceSection['service-data'] as $key => $data){
                                $heading ='';

                                if(isset($data['sheading'])){
                                  $heading =$data['sheading'];
                                  };
                                $url ='';
                                if(isset($data['surl'])){
                                $url =$data['surl'];
                                };
                                $imgID='';
                                if(isset($data['simge'])){
                                  $imgID =$data['simge'];
                                }
                                if(!empty($url)){
                                $link = $url;
                                }else{
                                $link= 'javascript:void(0)';
                                }
                                if(!empty($imgID)){
                                $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) );
                                }else{
                                $imgUrl = '';
                                }
                                ?>
                            <div class="col-xl-3 col-md-4 col-sm-6 d-flex align-items-stretch mb-3">
                                <a href="<?php echo $link; ?>">
                                    <div class="icon-box">
                                      <?php if(!empty($imgUrl)){ ?>
                                        <img src="<?php echo $imgUrl; ?>" alt="<?php echo $heading ?>"
                                            class="img-fluid mb-3" style="width: 100px" />
                                     <?php } ?>
                                        <h4 class="mb-0"><?php echo $heading; ?></h4>
                                    </div>
                                </a>
                            </div>
                            <?php }
                          } ?>
                        </div>
                    </div> <!-- End .content-->
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- End Services Section -->
    <!-- ======= Intro Section ======= -->
    <?php 
    
    if(((!empty($introSection['images']['image_one'])) || (!empty($introSection['images']['image_two'])) || (!empty($introSection['images']['image_three'])))){
      $intro_img=true;
    }else{
      $intro_img=false;
    }

    if((!empty($introSection['contect_group']['heading'])) || (!empty($introSection['contect_group']['content']))){
      $intro_content=true;
    }else{
      $intro_content=false;
    }
    if(($intro_img=='true') || ($intro_content=='true')){
    ?>
    <section class="intro">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-5">
                    <div class="intro-frame">
                        <div class="if-1">
                            <div class="iff">
                                <img src="<?php if($introSection['images']['image_one']){ echo $introSection['images']['image_one'];
                                    } ?>"
                                    alt="<?php  echo $introSection['contect_group']['heading']; ?>" class="img-fluid" />
                            </div>
                        </div>
                        <div class="if-2">
                            <div class="iff">
                                <img src="<?php if($introSection['images']['image_two']){  echo $introSection['images']['image_two']; }
                                    ?>"
                                    alt="<?php  echo $introSection['contect_group']['heading']; ?>" class="img-fluid" />
                            </div>
                        </div>
                        <div class="if-3">
                            <div class="iff">
                                <img src="<?php if($introSection['images']['image_three']){ echo $introSection['images']['image_three']; }
                                   ?>"
                                    alt="<?php  echo $introSection['contect_group']['heading']; ?>" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class=" col-xl-6 col-lg-6 col-md-7 ps-xl-5 ps-md-0  justify-content-center d-flex flex-column align-items-start">
                    <?php if(!empty($introSection['contect_group'])){ ?>
                    <h1 class="mb-4"><?php  echo $introSection['contect_group']['heading']; ?></h1>
                    <div class="topic-content"><?php  echo $introSection['contect_group']['content']; ?></div>
                    <?php } ?>
                    <a href="javascript:void(0)" class="btn-get-started" style="display: none;"> Explore All </a>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
    <!-- End Intro Section -->
    <?php if($clientSection){ ?>
    <section class="client-status" id="counter">
        <div class="container">
            <div class="row">
                <?php 
                  foreach($clientSection as $key => $data){
                    $classHeading ='';
                    if(isset($data['heading'])){
                      if(!(is_numeric($data['heading']))){
                        $classDiv ='office-size';
                        $classHeading = '<h5>'.$data['heading'] .'</h5>';
                        }else{
                        $classDiv ='';
                        if(!empty($data['heading'])){
                          $classHeading = '<h4 class="counter">'.$data['heading'] .'</h4>';
                        }
                        
                        } 
                    }
                  ?>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12 project-team <?php echo $classDiv; ?> ">
                    <?php 
                   $imgID='';
                  if(isset($data['imge'])) {
                      $imgID = $data['imge'];
                  }
                  
                    if(!empty($imgID)){
                      $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) ); ?>
                    <div class="technical-team">
                        <img src="<?php echo $imgUrl; ?>" class="img-fluid"
                            alt="<?php if(isset($data['subheading'])){ echo $data['subheading']; } ?>" />
                    </div>
                    <?php }
                    echo $classHeading;  ?>
                    <p> <?php if(isset($data['subheading'])){ echo $data['subheading']; } ?></p>
                </div>
                <?php  } 
                 ?>
            </div>
        </div>
    </section>
<?php } ?>

    <!-- Case Studies Section -->
    <section id="caseStudies" class="case-study mt-5">
        <div class="container">
            <div class="section-title">
                <?php if($caseSection['heading']){ ?>
                <h3> <em><?php echo $caseSection['heading']; ?></em> </h3>
                <?php }else{ ?>
                <h3> <em>Case Studies</em> </h3>
                <?php }
            if($caseSection['sub_heading']){ ?>
                <p><?php echo $caseSection['sub_heading']; ?></p>
                <?php }else{ ?>
                <p> the best solutions that help your business grow and reap rewards.</p>
                <?php } ?>
            </div>
            <?php
  $args = array(
  'post_type' => 'casestudies',
  'post_status' => 'publish',
  'posts_per_page' => 7,
  'order' => 'DESC',
  );
  $loop = new WP_Query( $args );
  if($loop){  ?>
            <div class="row">
                <div class="owl-carousel owl-theme owl-carousel7">
                    <?php $i=1; while ( $loop->have_posts() ) : $loop->the_post();
          $banner = get_field('banner_section',get_the_ID()); ?>
                    <div class="item">
                        <div class="case-study-img <?php echo countTostring($i); ?>">
                            <div class="box-transi">
                                <a href="<?php echo get_permalink(); ?>">
                                    <img src="<?php echo $banner['feature_image']; ?>" class="img-fluid"
                                        alt="<?php echo strtolower(get_the_title()); ?>" />
                                </a>
                                <div class="case-study-heading <?php echo strtolower(get_the_title()); ?>">
                                    <!--<a href="<?php //echo site_url() ?>/<?php //echo strtolower(get_the_title()); ?>"><?php //echo get_the_title(); ?></a>-->
                                    <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++; 
        endwhile;
        wp_reset_postdata(); ?>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
        </div>
    </section>
    <!-- End Case Studies -->
    <section class="blog-section">
        <div class="container">
            <div class="section-title">
                <?php if(!empty($blogSection['post_title'])){
          echo '<h3> <em>'.$blogSection['post_title'].'</em> </h3>';
      } ?>

                <?php if(!empty($blogSection['post_subtitle'])){
          echo '<p>'.$blogSection['post_subtitle'].'</p>';
      } ?>

            </div>
            <?php
$args = array(
'post_type' => 'post',
'post_status' => 'publish',
'posts_per_page' => 3,
'order' => 'DESC',
);
$loop = new WP_Query( $args );
if($loop){  ?>
            <div class="row">
                <?php $i=1; while ( $loop->have_posts() ) : $loop->the_post();
$banner = get_field('banner_section',get_the_ID()); ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
                    <div class="blog-box">
                        <div class="blog-img">
                            <?php echo '<img src="'.get_the_post_thumbnail_url( get_the_ID(), 'medium' ).'" alt="'.get_the_title().'" />'; ?>
                        </div>
                        <div class="inner-box">
                            <div class="date-auther">
                                <div class="blog-date">
                                    <?php echo get_the_date(); ?>
                                </div>
                                <div class="auther-name">
                                    <?php echo get_the_author(); ?>
                                </div>
                            </div>
                            <div class="blog-title">
                                <a href='<?php echo get_the_permalink() ?>'><?php echo get_the_title(); ?></a>
                            </div>
                            <div class="blog-inner-content">
                                <?php $content = trim(get_the_content(),'');
              echo wp_trim_words($content, 15, '...<a href="' . get_permalink() . '">Read More</a>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
endwhile;
wp_reset_postdata();   ?>
            </div>
            <?php } ?>
        </div>
    </section>
    <!-- Business intelligence tools Section -->
    <section class="mb-0 bi-bg">
        <div class="container mb-0">
            <div class="row">
                <div class="col-md-6 ps-2 justify-content-center d-flex flex-column align-items-start">
                    <h1 class="mb-2 business"><?php echo $tooldSection['tools_heading']; ?></h1>
                    <h5 class="pe-3"><?php echo $tooldSection['tools_sub_heading']; ?></h5>
                    <div class="ms-5">
                        <h3 class="blue-text mb-0 pt-xl-5 pt-sm-0"><?php echo $tooldSection['use_tools']; ?></h3>
                        <?php echo $tooldSection['list_of_tools']; ?>
                        <?php if($tooldSection['cta_button']['cta_label']){ ?>
                        <a href="<?php if($tooldSection['cta_button']['cta_url']){ echo $tooldSection['cta_button']['cta_url']; }else{ echo 'javascript:void(0)'; } ?>"
                            class="btn-get-started"><?php echo $tooldSection['cta_button']['cta_label']; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if($tooldSection['image']){
          $toolsImage =$tooldSection['image'];
          }else{
          $toolsImage =bloginfo('template_url').'/assets/images/elementor-img-03.png';
          } ?>
                    <img src="<?php echo $toolsImage; ?>" alt="<?php echo $tooldSection['tools_heading'] ?>"
                        class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <!-- End Business intelligence tools Section -->
    <!-- Development Technology Stack Section -->
    <?php //the_content($pageID); ?>
    <section id="portfolio" class="portfolio">
        <div class="section-title">
            <h3> <em><?php echo $technologySection['heading']; ?></em> </h3>
            <p><?php echo $technologySection['sub_heading']; ?></p>
        </div>
        <?php
$args = array(
'post_type' => 'technology_stack',
'post_status' => 'publish',
'posts_per_page' => 6,
//'orderby’ => 'title',
'order' => 'ASC',
);
$loop = new WP_Query( $args );
if($loop){  ?>
        <div class="container mb-5" data-aos="fade-up">
            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class=" col-xl-11 col-lg-12 col-md-12  d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <?php $i=0; 
       while($loop->have_posts()){
        $loop->the_post(); ?>
                        <li data-filter=".filter-<?php echo $post->post_name ?>"
                            class="tech-stack li-stack <?php if($i =='0'){ echo 'active'; }?> ">
                            <a class="" href="" aria-label="<?php echo get_the_title(); ?>">
                                <div class="main-cricle">
                                    <div class="circletest"></div>
                                </div>
                                <span> <img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'medium' ); ?>"
                                        alt="<?php echo get_the_title(); ?>" width="80" height="80" class="white" />
                                    <img src="<?php  echo get_the_post_thumbnail_url( $post->ID, 'medium' ); ?>"
                                        alt="<?php echo get_the_title(); ?>" width="80" height="80"
                                        class="black active" />
                                </span><?php echo get_the_title(); ?>
                            </a>
                        </li>
                        <?php $i++; }
        wp_reset_postdata();
        ?>
                    </ul>
                </div>
            </div>
            <div class="portfolio-container">
                <ul id="filter-output">
                    <?php $j=0; while($loop->have_posts()){
      $loop->the_post();
      if($j=='0'){
      $show ='block';
      }else{
      $show='none';
      }
  ?>
                    <li class="filter-results tech-stack-filter filter-<?php echo $post->post_name ?>"
                        style='display:<?php echo $show ?>'>
                        <h3 class="d-block d-lg-none"><?php echo get_the_title(); ?></h3>
                        <?php echo get_the_content(); ?>
                    </li>
                    <?php $j++; }  ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
        <?php } ?>
    </section>
    <!-- End Development Technology Stack Section -->
    <!--     mobile view collapse start -->

    <section class="mobile-view-collapse">
        <div class="section-title">
            <h3> <em> <?php echo $technologySection['heading']; ?> </em> </h3>
            <p><?php echo $technologySection['sub_heading']; ?></p>
        </div>
        <?php if($loop){  ?>
        <div class="container">
            <div class="accordion" id="accordionExample">
                <?php $i =0; while($loop->have_posts()){
      $loop->the_post();?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $i;?>">
                        <button class="accordion-button <?php if($i !='0'){ echo 'collapsed'; }?>" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i;?>" aria-expanded="true"
                            aria-controls="collapseOne">
                            <?php echo get_the_title(); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $i;?>"
                        class="accordion-collapse <?php if($i !='0'){ echo 'collapse'; }?>"
                        aria-labelledby="heading<?php echo $i;?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <li class="filter-results filter-<?php echo $post->post_name ?>">
                                <!-- <h3 class="d-block d-lg-none">DL Framework</h3> -->
                                <?php echo get_the_content(); ?>
                            </li>
                        </div>
                    </div>
                </div>
                <?php $i++; }  ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        <?php } ?>
    </section>

    <!-- mobile view collapse end -->

<?php

if(isset($developmentSection['head-data']['data-imge'])){
  $imgID =$developmentSection['head-data']['data-imge'];
}else{
$imgID='';
}
if(isset($developmentSection['repeat-data'])){
  $repeateData = $developmentSection['repeat-data'];
}else{
  $repeateData ='';
}

if((!empty($developmentSection['head-data']['data-heading']) || (!empty($imgID))) || (!empty($repeateData))){ ?>

<section class="data-science-sec mt-5">
        <div class="dscience-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9 time-mt">
                        <div class="time-head">
                          <?php if(!empty($developmentSection['head-data']['data-heading'])){ ?>
                            <h2 data-aos="fade-down" data-aos-duration="4000">
                              <?php echo $developmentSection['head-data']['data-heading']; ?>
                            </h2>
                            <?php } ?>
                            <?php  
                        if(!empty($imgID)){
                          $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) ); ?>
                         <img src="<?php echo $imgUrl;?>" alt="<?php if(!empty($developmentSection['head-data']['data-heading'])){ 
                            echo $developmentSection['head-data']['data-heading']; } ?>" />
                        <?php } ?>
                      </div>
              <div class="timeline-centered timeline-sm">
              <?php if(isset($developmentSection['repeat-data'])){
              foreach($developmentSection['repeat-data'] as $key => $data){
              $fadeClass = ( ($key + 1) % 2 === 0 ) ? 'fade-right': 'fade-left';
              $divClass = ( ($key + 1) % 2 === 0 ) ? 'left-aligned': '';
              if(!empty($data['colorClass'])){
              $colorClass =$data['colorClass'];
              }else{
              $colorClass ='';
              }
              if(!empty($data['dheading'])){
              $heading =$data['dheading'];
              }else{
              $heading ='';
              }
          ?>
            <article class="timeline-entry <?php echo $divClass ?> ">
                <div class="timeline-entry-inner">
                    <div class="timeline-icon <?php echo $colorClass; ?>">
                        <?php 
                          $imgID='';
                          if(isset($data['dimge'])){
                            $imgID = $data['dimge'];
                          }
                          
                          if(!empty($imgID)){
                            $imgUrl = wp_get_attachment_image_url( $imgID, array( 80, 80 ) );
                          }else{
                            $imgUrl =get_template_directory_uri().'/assets/images/define-business-requirement.png';
                          } ?>
                        <img src="<?php echo $imgUrl ?>" alt="<?php echo $heading; ?>"
                            class="img-fluid" />
                    </div>
                    <div class="timeline-label <?php echo $colorClass; ?>"
                        data-aos="<?php echo $fadeClass ?>" data-aos-duration="4000">
                        <h4 class="timeline-title"><?php echo $heading; ?></h4>
                    </div>
                </div>
            </article>
            <?php  }
          } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php }


?>
    

<?php 
if(isset($partnerSection['heading'])){
  $pheading = $partnerSection['heading'];
   }else{
    $pheading ='';
   }
$image_ids = $partnerSection['logos'][0];
if((!empty($pheading)) || (!empty($image_ids))){ ?>
    <section class="global-leaders">
        <?php if(!empty($pheading)){ ?>
        <div class="section-title">
            <h3 class=""><em><?php echo $pheading; ?></em></h3>
        </div>
        <?php } 
      if(!empty($image_ids)){ ?>
        <div class="container">
            <div class="row">
                  <div class="owl-carousel owl-theme test1">
                    <?php $image_id;
                    $image_id = explode(',', $image_ids);
                    if(!empty($image_id)){
                      foreach($image_id as $j =>$ID){
                      $url = wp_get_attachment_image_url( $ID, array( 80, 80 ) );
                      if($url){  ?>
                        <div class="item">
                            <img src="<?php echo $url; ?>" alt="<?php echo get_the_title($ID); ?>" />
                        </div>
                        <?php }
                        }
                      } ?>
                  </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <?php } ?>

    <section class="send-enquiry">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <h2><?php echo $enquerySection['heading'];  ?></h2>
                    <p class=""><?php echo $enquerySection['sub_heading'];  ?></p>
                    <?php if($enquerySection['cta_label']){ ?>
                    <a href="#"
                        class="scroll-top2 outer-white-btn px-4 py-2 rounded-pill"><?php echo $enquerySection['cta_label']; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial">
        <div class="container">
            <div class="section-title">
                <div class="section-title">
                    <h3 class=""> <em><?php echo get_field('testimonial_heading',$pageID) ?></em></h3>
                </div>
            </div>
            <?php $args = array(
              'post_type' => 'testimonial',
              'post_status' => 'publish',
              'posts_per_page' => 6,
              //'orderby’ => 'title',
              'order' => 'DESC',
              );
          $loop = new WP_Query( $args ); 
          if($loop){  ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="owl-carousel1" class="owl-carousel owl-theme">
                        <?php  while($loop->have_posts()){
                            $loop->the_post();  ?>
                        <div class="item">
                            <div class="content">
                                <?php $data= get_field('testimonial_section');
                                if(!empty($data['comment'])){
                                  echo '<p> <i class="fas fa-quote-left"></i>&nbsp; '.$data['comment'].' &nbsp;<i class="fas fa-quote-right"></i></p>';
                                } 
                                if(!empty($data['rating'])){
                                  echo '<div class="rating-icon">';
                                    for($i=0;$i<$data['rating']; $i++){
                                      echo '<i class="fas fa-star"></i>';
                                    }
                                  echo '</div>';  
                                } ?>
                            </div>
                            <div class="author-info">
                                <div class="thumb">
                                    <?php if(!empty($data['image'])){
                                      echo '<img src="'.$data['image'].'" alt="'.$data['client_name'].'" />';
                                  } ?>
                                </div>
                                <div class="info">
                                    <?php if(!empty($data['client_name'])){
                                      echo '<h6 class="title">'.$data['client_name'].'</h6>';
                                }
                                if(!empty($data['client_profession'])){
                                  echo '<span class="subtitle">'.$data['client_profession'].'</span>';
                                } ?>
                                </div>
                            </div>
                        </div>
                        <?php }  ?>
                        <?php wp_reset_postdata(); ?>

                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <?php the_content($pageID); ?>
</main>

<!-- End #main -->
<?Php function countTostring($num){
  if($num=='1'){
  $res ='one';
  }else if($num=='2'){
  $res ='two';
  }else if($num=='3'){
  $res ='three';
  }else if($num=='4'){
  $res ='four';
  }else if($num=='5'){
  $res ='five';
  }else if($num=='6'){
  $res ='six';
  }else if($num=='7'){
  $res ='seven';
  }
  return $res;
  } ?>

<!-- ======= Footer ======= -->
<?php get_footer(); ?>