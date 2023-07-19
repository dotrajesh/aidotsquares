<?php
/*
* Template Name: Services
*/
get_header(); 
$pageID = get_the_ID();
$bannerContent    =get_field('banner_section',$pageID);
$introSection     =get_field('intro_section',$pageID);
$serviceSection   =get_field('service-section',$pageID);

if((!empty($bannerContent['image'])) || (!empty($bannerContent['heading'])) || (!empty($bannerContent['sub_heading']))){
    $img_data =true;
}else{
    $img_data =false;
}

if((!empty($serviceSection[0]['heading'])) && (!empty($serviceSection[0]['content']))){
    $found =true;
}else if((!empty($serviceSection[0]['heading'])) && (empty($serviceSection[0]['content']))) {
    $found =true;
}else if((empty($serviceSection[0]['heading'])) && (!empty($serviceSection[0]['content']))) {
    $found =true;
}else{
    $found =false; 
}
?>
<main>
    <?php if(($img_data =='true') || ($found=='true')){ ?>
	<section class="service-slider" style="background-image: url(<?php if(!empty($bannerContent['image'])){ echo $bannerContent['image']; } ?>);">
		<div class="container">
			<div class="col-md-12">
				<div class="service-detail" >
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
    <?php 
    ?>
    <section class="smart-snout-content">
        <?php if(!empty($introSection)){ ?>
            <div class="container">
                <div class="row">
                    <?php if((!empty($introSection['images'])) && ((!empty($introSection['contect_group']['heading']))) || (!empty($introSection['contect_group']['content'])) ){ ?>
                        <div class="col-md-6">
                            <div class="smart-snout-img test">
                                <img src="<?php echo $introSection['images']; ?>" class="img-fluid" alt="<?php echo  $introSection['contect_group']['heading']; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="smart-heading">
                                <?php
                                if(!empty($introSection['contect_group']['heading'])){
                                    echo '<h2>'.$introSection['contect_group']['heading'].'</h2>';
                                }
                                if(!empty($introSection['contect_group']['content'])){
                                    echo '<p>'.$introSection['contect_group']['content'].'</p>';

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
        <?php }      
        if($found){ ?>
            <section class="content-paragraph">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sub-heading service-template">
                                <?php foreach($serviceSection as $key => $content){
                                    if(!empty($content['heading'])){
                                        $ID =$key+1;
                                    echo  '<h3><strong>('.$ID.'). </strong>'.$content['heading'].'</h3>';
                                    }
                                    if(!empty($content['content'])){
                                        echo apply_filters('the_content', $content['content']);
                                    }
                                        echo ( $key !== count( $serviceSection ) -1 ) ? "<hr/>" : "";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    </section>
    <?php } ?>

    <?php the_content($pageID); ?>
</main>
<!-- ======= Footer ======= -->
<?php get_footer(); ?>