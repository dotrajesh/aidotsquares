<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
get_header();

//echo post_type();

?>
<main>
	<section class="blogs-slider products custom-header">
		<div class="container">
			<div class="col-md-12">
				<div class="service-detail">
					<h1><?php 
					//echo single_cat_title();
					if ( is_category() ) { 
						//echo 'category'.single_cat_title(); 
						$category = get_the_category(); 
						echo 'Category: ' . $category[0]->name; 
					  }else{
						echo post_type_archive_title('', false);
					  }
					?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="blog-section archive-products-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-md-12 col-xs-12">
					<div class="row">
						<?php while ( have_posts() ) : ?>
						<?php the_post();
						$banner = get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>
						<div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
							<div class="item products-post">
								<div class="products-img">
									<div class="box-transi ">
										<a href="<?php echo get_the_permalink(); ?>">
										<img src="<?php echo $banner; ?>" class="img-fluid" alt="<?php echo strtolower(get_the_title()); ?>" />
										</a>
										<div class="products-heading">
											<div class="inner">
												<div class="heading"><?php echo strtolower(get_the_title()); ?></div>
												<a href="<?php echo get_the_permalink(); ?>">View More</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; 
						echo the_posts_pagination( ); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php

get_footer();
