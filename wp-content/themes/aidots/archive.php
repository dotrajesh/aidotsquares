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
/*
get_header();

echo 'surendra';

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

	<header class="page-header alignwide">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
	</header><!-- .page-header -->

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
	
		<?php //get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); ?>
	<?php endwhile; ?>

	<?php twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php
get_footer();
*/

get_header();
?>
<main>
	<section class="blogs-slider custom-header">
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
						echo get_the_title( get_option('page_for_posts', true) ); 
					  }
					?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="blog-section">
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
							echo '<img src='.get_the_post_thumbnail_url( get_the_ID(), 'medium' ).' alt=".get_the_title()." />';
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
								      echo wp_trim_words($content, 20, '...<a href="' . get_permalink() . '">Read More</a>'); 
								?>
								<?php //the_content(); ?>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; 
			echo the_posts_pagination( );
				
				?>
				
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
