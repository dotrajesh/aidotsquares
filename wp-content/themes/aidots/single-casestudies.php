<?php
/**
* The template for displaying all single posts
*
*/
get_header();
while ( have_posts() ) :
	the_post();
$postID= get_the_ID();
$bannerSection =get_field('banner_section',$postID);
$imgContSection =get_field('image_content_section',$postID);
$contectSection =get_post_meta($postID, 'casestudypost_group', true);

if((!empty($imgContSection['image'])) || ((!empty($imgContSection['heading_content']['heading'])) || (!empty($imgContSection['heading_content']['content'])))){
    $found =true;
}else{
    $found =false;
}
if(!empty($contectSection['layout'])){
    $data_found =true;
}else{
    $data_found =false;
}
?>
<main>
    <section class="casestudy-banner service-slider-learn"
        style="background-image: url(<?php echo $bannerSection['banner_image'] ?>);">
        <div class="container">
            <div class="col-md-12">
                <div class="service-detail">
                    <h1 class="cmal">
                        <?php if($bannerSection['banner_title']){ echo $bannerSection['banner_title']; }else{ echo get_the_title(); }?>
                    </h1>
                    <p><?php if($bannerSection['banner_sub_title']){ echo $bannerSection['banner_sub_title']; }  ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php if(($found =='true') || ($data_found =='true')){ ?>
    <section class="smart-snout-content">
        <?php if($found){ ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php if($imgContSection['image']){ 
                                $imgUrl =$imgContSection['image'];
                                ?>
                                <div class="smart-snout-img">
                            <img src="<?php echo $imgUrl; ?>">
                            </div>
                        <?php } ?> 
                    </div>
                    <div class="col-md-6 ">
                        <div class="smart-heading">
                            <h2><?php if($imgContSection['heading_content']['heading']){ echo $imgContSection['heading_content']['heading']; }  ?>
                            </h2>
                            <?php if($imgContSection['heading_content']['content']){ echo $imgContSection['heading_content']['content']; }  ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        
		if(!empty($contectSection['layoutone']['content'])){ ?>
            <section class="content-paragraph">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sub-heading">
                                <?php	
                                foreach($contectSection['layoutone']['content'] as $key => $content){ ?>
                                <h3><strong>(<?php echo $key+1 ?>).</strong>
                                    <?php if(isset($content['heading'])){ echo $content['heading']; } ?></h3>
                                    <?php  if(isset($content['description'])){ echo apply_filters('the_content', $content['description']);} 
                                    if(!empty($content['images'])){ ?>
                                        <div class="row this">
                                            <?php $imgArr =   explode(',',$content['images']);
                                                    foreach($imgArr as $img){ 
                                                    $imgUrl = wp_get_attachment_image_url( $img, array( 80, 80 ) ); ?>
                                            <div class="col-md-3">
                                                <div class="chat-image">
                                                    <img src="<?php echo $imgUrl; ?>"
                                                        alt="<?php if(isset($content['heading'])){ echo $content['heading']; } ?>" />
                                                </div>
                                            </div>
                                            <?php  } ?>
                                        </div>
                                    <?php } 
                                        echo ( $key !== count( $contectSection['layoutone']['content'] ) -1 ) ? "<hr/>" : "";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }
		if(!empty($contectSection['layouttwo'])){
			if(!empty($contectSection['layouttwo']['application'])){ 
				$app =$contectSection['layouttwo']['application'];
				if((!empty($app['headheading'])) || (!empty($app['content']['appimages']))){ ?>
                    <section class="benifits">
                        <div class="section-title appplication">
                            <h3> <em><?php if(isset($app['headheading'])){ echo $app['headheading']; }?></em></h3>
                        </div>

                        <?php if(!empty($app['content'])){ ?>
                        <div class="container">
                            <div class="row mt-3">
                                <?php foreach($app['content'] as $content){ 
                                    $imgUrl ='';
                                    if(isset($content['appimages'])){
                                        $imgUrl = wp_get_attachment_image_url($content['appimages'], array( 80, 80 ) );
                                    }
                                    $heading ='';
                                    if(isset($content['appheading'])){
                                        $heading = $content['appheading'];
                                    }
                                    $des ='';
                                    if(isset($content['appdescription'])){
                                        $des = $content['appdescription'];
                                    }
                                    if((!empty($imgUrl)) || (!empty($heading)) || (!empty($des))){
                                ?>
                                    <div class="col-md-3 h-100">
                                        <div class="flip-card ">
                                            <div class="flip-card-inner wound-healing-1"
                                                style='background-image: url(<?php echo $imgUrl; ?>)'>
                                                <div class="flip-card-front">
                                                <?php if(isset($content['appheading'])){ 
                                                        if(!empty($content['appheading'])){ ?>
                                                        <div class="deliverd-box">
                                                            <h6><?php echo $content['appheading'] ?></h6>
                                                        </div>
                                                    <?php } 
                                                } ?>
                                                    
                                                </div>
                                                <div class="flip-card-back">
                                                    <?php if(isset($content['appdescription'])){
                                                        echo '<p>'.$content['appdescription'].'</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </section>
                <?php } 
                }
			if(!empty($contectSection['layouttwo']['product'])){
				$pro =$contectSection['layouttwo']['product']; 
				if((!empty($pro['headheading'])) || (!empty($pro['content']['prodescription']))){ ?>
                    <section class="product">
                        <div class="section-title appplication">
                            <h3 class="pb-4"> <em> <?php if(isset($pro['headheading'])){ echo $pro['headheading']; }?></em> </em></h3>
                        </div>
                        <div class="container">
                            <div class="row justify-content-center">
                                <?php if(!empty($pro['content'])){
                                    foreach($pro['content'] as $content){ 
                                        $imgUrl ='';
                                        if(isset($content['proimages'])){
                                            $imgUrl = wp_get_attachment_image_url($content['proimages'], array( 80, 80 ) );
                                        }
                                        $heading ='';
                                        if(isset($content['proheading'])){
                                            $heading =$content['proheading'];
                                        }

                                        $descri ='';
                                        if(isset($content['prodescription'])){
                                            $descri = $content['prodescription'];
                                        }
                                        
                                    if((!empty($heading)) || (!empty($descri)) || (!empty($imgUrl))){ ?>
                                        <div class="col-md-4 mb-3 ">
                                            <div class="user-friendly">
                                                <div class="user-friendly-img">
                                                    <?php if(!empty($imgUrl)){ ?>
                                                    <img src="<?php echo $imgUrl; ?>"
                                                        alt="<?php if(isset($content['proheading'])){
                                                            echo $content['proheading'];
                                                        } ?>" />
                                                    <?php } ?>
                                                </div>
                                                <div class="user-friendly-heading">
                                                    <?php if(isset($content['proheading'])){
                                                            echo '<h6>'.$content['proheading'].'</h6>';
                                                        } ?>
                                                    <?php if(isset($content['prodescription'])){
                                                            echo '<p>'.$content['prodescription'].'</p>';
                                                        } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    }
                                } ?>
                            </div>
                        </div>
                    </section>
                <?php }
            }

            if(!empty($contectSection['layouttwo']['blogs'])){
                $blogs =$contectSection['layouttwo']['blogs']; 
                if((!empty($blogs['headheading'])) || (!empty($blogs['content']['blogimages']))){
                ?>
                <section class="blog " >
                    <div class="section-title appplication">
                        <h3><em> <?php if(isset($blogs['headheading'])){ echo $blogs['headheading']; }?> </em></h3>
                    </div>							
                    <div class="container">
                        <div class="row mt-3">
                            <?php if(!empty($blogs['content'])){
                                foreach($blogs['content'] as $content){
                                $imgUrl ='';
                                if(isset($content['blogimages'])){
                                    $imgUrl = wp_get_attachment_image_url($content['blogimages'], array( 80, 80 ) );
                                }
                                
                                $heading ='';
                                if(isset($content['blogheading'])){
                                    $heading = $content['blogheading'];
                                }
                                if((!empty($heading)) || (!empty($imgUrl))){
                                ?>
                                <div class="col-md-4">
                                    <div class="card" >
                                        <img src="<?php echo $imgUrl ?>" alt="<?php if(isset($content['blogheading'])){
                                                echo $content['blogheading'];
                                            } ?>" />
                                        <div class="card-body blog-content">
                                        <?php if(isset($content['blogheading'])){
                                                echo '<p class="card-text">'.$content['blogheading'].'</p>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } 
                                }
                            } ?>
                        </div>
                    </div>
                </section>
            <?php } 
            }
	    } ?>
    </section>
    <?php } ?>
<?php the_content($postID); ?>
</main>
<?php
endwhile;
get_footer();