<?php
/*
* Template Name: Services layout
*/
get_header(); 
$pageID = get_the_ID();
$bannerContent    =get_field('banner_section',$pageID);
$introSection     =get_field('intro_section',$pageID);
$serviceSection   =get_field('servicelayout_group',$pageID);
$application      =$serviceSection['application'];
$process          =$serviceSection['process'];
$techenical       =$serviceSection['technical'];

if(!empty($application)){
    if(((!empty($application['head']['headheading'])) || (!empty($application['head']['sappsubhead']))) && ((!empty($application['content'][0]['appheading'])) || (!empty($application['content'][0]['appdescription'])) || (!empty($application['content'][0]['appimages'])))){
        $found_app =true;
    }else if(((!empty($application['head']['headheading'])) || (!empty($application['head']['sappsubhead']))) && ((empty($application['content'][0]['appheading'])) || (empty($application['content'][0]['appdescription'])) || (empty($application['content'][0]['appimages'])))){
        $found_app =true;
    }else if(((!empty($application['head']['headheading'])) || (!empty($application['head']['sappsubhead']))) && ((!empty($application['content'][0]['appheading'])) || (!empty($application['content'][0]['appdescription'])) || (!empty($application['content'][0]['appimages'])))){
        $found_app =true;
    }else{
        $found_app =false;
    }

}else{
    $found_app =false;
}


if(!empty($process)){
    if((!empty($process['headheading'])) && ((!empty($process['content'][0]['sproheading'])) || (!empty($process['content'][0]['sprodescription'])) || (!empty($process['content'][0]['sproimages'])))){
        $found_process =true;
    }else if((!empty($process['stechheading'])) && ((empty($process['content'][0]['sproheading'])) || (empty($process['content'][0]['sprodescription'])) || (empty($process['content'][0]['sproimages'])))){
        $found_process =true;
    }else if((empty($process['stechheading'])) && ((!empty($process['content'][0]['sproheading'])) || (!empty($process['content'][0]['sprodescription'])) || (!empty($process['content'][0]['sproimages'])))){
        $found_process =true;
    }else{
        $found_process =false;
    }
}else{
    $found_process =false;
}

if(!empty($techenical)){
    if((!empty($techenical['stechheading'])) && ((!empty($techenical['content'][0]['stechheading'])) || (!empty($techenical['content'][0]['stechdescription'])) || (!empty($techenical['content'][0]['stechimages'])))){
        $found_tech =true;
    }else if((!empty($techenical['stechheading'])) && ((empty($techenical['content'][0]['stechheading'])) || (empty($techenical['content'][0]['stechdescription'])) || (empty($techenical['content'][0]['stechimages'])))){
        $found_tech =true;
    }else if((empty($techenical['stechheading'])) && ((!empty($techenical['content'][0]['stechheading'])) || (!empty($techenical['content'][0]['stechdescription'])) || (!empty($techenical['content'][0]['stechimages'])))){
        $found_tech =true;
    }else{
        $found_tech =false;
    }

}else{
    $found_tech =false;
}
?>
<main>
    <section class="service-slider" style="background-image: url(<?php if(!empty($bannerContent['image'])){ echo $bannerContent['image']; } ?>);">
        <div class="container">
            <div class="col-md-12">
                <div class="service-detail">
                    <?php if(!empty($bannerContent['heading'])){
                        echo '<h1>'.$bannerContent['heading'].'</h1>';
                    }
                    if(!empty($bannerContent['sub_heading'])){
                        echo '<p>'.$bannerContent['sub_heading'].'</p>';
                    }
                    if(empty($bannerContent['heading']) && empty($bannerContent['sub_heading'])){
                        echo '<h1>'.get_the_title().'</h1>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php if(!empty($introSection)){ ?>
        <section class="deep-learn-content">
		<div class="container">
			<div class="row">
            <?php if((!empty($introSection['images'])) && ((!empty($introSection['contect_group']['heading']))) || (!empty($introSection['contect_group']['content'])) ){ ?>
                <div class="col-md-6">
                    <div class="deep-learn-img">
                        <img src="<?php echo $introSection['images']; ?>" class="img-fluid"
                            alt="<?php echo  $introSection['contect_group']['heading']; ?>" />
                    </div>
                </div>
                <div class="col-md-6  d-flex align-items-center justify-content-center">
					<div class="deep-learn">
                        <?php
                            if(!empty($introSection['contect_group']['heading'])){
                                echo '<h2>'.$introSection['contect_group']['heading'].'</h2>';
                            }
                            if(!empty($introSection['contect_group']['content'])){
                                echo $introSection['contect_group']['content'];
                            }
                        ?>
					</div>
				</div>
                <?php  }else{
                    if(!empty($introSection['contect_group']['heading'])){ 
                        echo '<div class="col-md-12 ">';
                        echo '<div class="smart-heading">';
                        echo '<h2>'.$introSection['contect_group']['heading'].'</h2>';
                        echo '<p>'.$introSection['contect_group']['content'].'</p>';
                        echo '</div>';
                        echo '</div>';
                    }else if(!empty($introSection['images'])){
                        $id  = attachment_url_to_postid( $introSection['images'] );
                        echo '<div class="col-md-12 ">';
                        echo '<div class="smart-snout-img">';
                       echo  '<img src="'.$introSection['images'].'" class="img-fluid test" alt="'.get_the_title( get_the_ID($id) ).'" />';
                        echo '</div>';
                        echo '</div>';
                    }
                } ?>
			</div>
		</div>
	</section>
<?php } ?>

<?php if($found_app){ ?>
    <section class="Deep-Learning-Applications">
    <?php 
    if((!empty($application['head']['headheading'])) || (!empty($application['head']['sappsubhead']))){ ?>
    <div class="section-title appplication">
        <?php if(!empty($application['head']['headheading'])){ ?>
            <h3><em><?php echo $application['head']['headheading']; ?></em></h3>
        <?php }
        if(!empty($application['head']['sappsubhead'])){ ?>
            <p><?php echo $application['head']['sappsubhead']; ?></p>
       <?php } ?>
    </div>
   <?php } ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php  
                        $numberData =count($application['content']);
                        $countData =($numberData/2); 
                        //echo $countData; ?>
                <?php foreach($application['content'] as $key => $data){ 
                    if((!empty($data['appimages'])) || (!empty($data['appheading'])) || (!empty($data['appdescription']))){
                    if($key < $countData){ ?>
                    <div class="box">
                        <?php if(!empty($data['appimages'])){ 
                            $imgUrl = wp_get_attachment_image_url($data['appimages'], array( 80, 80 ) ); ?>
                            <div class="vision-content-img">
                                <img src="<?php echo $imgUrl; ?>" alt="<?php if(isset($data['appheading'])){ echo $data['appheading']; } ?>" class="img-fluid" />
                            </div>
                        <?php } ?>
                        <div class="vision-content">
                            <?php if(!empty($data['appheading'])){ ?>
                                <h6><?php echo $data['appheading']; ?></h6>
                            <?php } 
                            if(!empty($data['appdescription'])){ ?>
                            <p><?php echo $data['appdescription']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }
                    else{
                        continue;
                    }
                }
                } ?>
            </div>
            <div class="col-md-4">
           <?php if(!empty($application['head']['sheadappimge'])){ 
                 $imgUrl = wp_get_attachment_image_url($application['head']['sheadappimge'], array( 80, 80 ) ); ?>
                <div class="application-image">
                    <img src="<?php echo $imgUrl; ?>" alt="<?php if(isset($application['head']['headheading'])){ echo $application['head']['headheading']; } ?>" class="img-fluid" />
                </div>
            <?php } ?>
            </div>
            <div class="col-md-4">
            <?php foreach($application['content'] as $key => $data){ 
                 if((!empty($data['appimages'])) || (!empty($data['appheading'])) || (!empty($data['appdescription']))){
                    if($key < $countData){
                        continue;
                    }else{ ?>  
                    <div class="box">
                        <?php if(!empty($data['appimages'])){ 
                            $imgUrl = wp_get_attachment_image_url($data['appimages'], array( 80, 80 ) ); ?>
                            <div class="vision-content-img">
                                <img src="<?php echo $imgUrl; ?>" alt="<?php if(isset($data['appheading'])){ echo $data['appheading']; } ?>" class="img-fluid" />
                            </div>
                        <?php } ?>
                        <div class="vision-content">
                            <?php if(!empty($data['appheading'])){ ?>
                                <h6><?php echo $data['appheading']; ?></h6>
                            <?php } 
                            if(!empty($data['appdescription'])){ ?>
                            <p><?php echo $data['appdescription']; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }
                    }
                } ?>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if($found_process){
     ?>
<section id="recent-blog-posts" class="recent-blog-posts">
<?php if(!empty($process['headheading'])){ ?>
    <div class="section-title appplication">
        <h3><em><?php echo $process['headheading']; ?></em></h3>
    </div>
<?php }  ?>
<div class="container">
    <div class="row justify-content-center">
        <?php  foreach($process['content'] as $key=>$data){ 
            if((!empty($data['sproimages']) || (!empty($data['sproheading'])) || (!empty($data['sprodescription'])))){
            ?>
            <div class="col-lg-4 col-md-6 mb-3">
            <div class="post-box">
                <div class="step">
                <?php  if(!empty($data['sproimages'])){
                        $imgUrl = wp_get_attachment_image_url($data['sproimages'], array( 80, 80 ) ); ?>
                        <div class="learning-img">
                            <img src="<?php echo $imgUrl; ?>" class="img-fluid" alt="<?php if(isset($data['sproheading'])){ echo $data['sproheading']; } ?>" />
                        </div>
                <?php } ?>
                <h6>Step-<?php echo $key+1; ?></h6>
             </div>
            <div class="blog-details">
            <div>
                <?php if(!empty($data['sproheading'])){ ?>
                    <h3 class="post-title"><?php echo $data['sproheading']; ?></h3>
                <?php } if(!empty($data['sprodescription'])){ ?>
                    <p><?php echo $data['sprodescription']; ?></p>
                <?php } ?>
            </div>
            </div> 
            </div>
        </div>  
        <?php } } ?>             
    </div>
</div>
</section>
<?php  }  ?>

<?php if($found_tech){ ?>
<section class="type-deeplearning">
<?php if(!empty($techenical['stechheading'])){ ?>
    <div class="section-title appplication pb-5">
        <h3><em><?php echo $techenical['stechheading']; ?></em></h3>
    </div>
<?php } ?>    
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach($techenical['content'] as $data){ 
                if((!empty($data['stechimages'])) || (!empty($data['stechheading'])) || (!empty($data['stechdescription']))){
                ?>
                <div class="col-md-3 h-100 mb-3">
                <div class="flip-card ">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <?php if(!empty($data['stechimages'])){ 
                                    $imgUrl = wp_get_attachment_image_url($data['stechimages'], array( 80, 80 ) ); ?>
                                <div class="Networks-img">
                                    <img src="<?php echo $imgUrl; ?>"
                                        alt="<?php if(isset($data['stechheading'])){ echo $data['stechheading']; } ?>" class="img-fluid" />
                                </div>
                            <?php }  
                            if(!empty($data['stechheading'])){ ?>
                                <div class="neural">
                                    <h6><?php echo $data['stechheading']; ?></h6>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="flip-card-back">
                            <?php if(!empty($data['stechdescription'])){ ?>
                                <p><?php echo $data['stechdescription']; ?></p>
                            <?php } ?>   
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>
<?php } ?>
</main>
<?php the_content(get_the_ID()); ?>
<!-- ======= Footer ======= -->
<?php get_footer(); ?>