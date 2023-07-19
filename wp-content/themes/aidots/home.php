<?php
get_header();
?>
<main>
	<section class="blogs-slider">
		<div class="container">
			<div class="col-md-12">
				<div class="service-detail">
					<h1><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="blog-section new-blogs-section">
		<div class="container">
			<div class="row">
				<div class="col-xl-9 col-md-12 col-xs-12">
				 <div class="row">
				<?php
				while ( have_posts() ) : ?>
				<?php the_post();
				?>
				<div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
					<div class="blog-box">
						<div class="blog-img">
							<?php
							echo '<img src='.get_the_post_thumbnail_url( get_the_ID(), 'medium' ).' />';
							?>
						</div>
						
						<div class="inner-box">
						<?php
						?>
						<div class="date-auther">
							<div class="blog-date">
							<?php	echo get_the_date(); ?>
							</div>
							<div class="auther-name">
								<?php echo get_the_author(); ?>
							</div>
						</div>
							
							<div class="blog-title">
							<a href='<?php echo get_the_permalink() ?>'><?php	echo get_the_title(); ?></a>
							</div>
							<div class="blog-inner-content">
								<?php $content = trim(get_the_content(),'');
								      echo wp_trim_words($content, 16, '...<a href="' . get_permalink() . '">Read More</a>'); 
								?>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; 
				?>
				<div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
						<?php
						echo the_posts_pagination( );
					?>
				</div>
				
				</div>
				</div>
				<div class="col-xl-3 col-md-12 col-xs-12 ">
				 	<?php dynamic_sidebar( 'sidebar-5' ); ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();