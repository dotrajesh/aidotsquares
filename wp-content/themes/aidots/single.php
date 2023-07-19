<?php
/**
 * The template for displaying all single posts
 *
 */

get_header();

if((isset($_GET['email_varify'])) && (isset($_GET['cid']))){
	$newString =substr($_GET['cid'], 8);
	echo 'test'.$newString;
	update_comment_meta($newString,'comment_email_verify','true');
}

?>
<main>
	<?php the_content(); 
/*
	?>
	<section class="blogs-slider inn-blogs">
		<div class="container">
			<div class="col-md-12">
				<div class="service-detail">
					<h1><?php echo get_the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>

	<section class="blogs-post">
	<div class="container">
		<div class="row">
			<div class='col'>
				<?php the_content(); ?>
			</div>

		</div>
	</div>
	</section>
	<section class="comments-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>
			</div>
		</div>
	</section>
</main>
<?php 
/* Start the Loop */
/*
while ( have_posts() ) :
	the_post();

	//get_template_part( 'template-parts/content/content-single' );

	if ( is_attachment() ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: Parent post link. */
				//'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentytwentyone' ), '%title' ),
			//)
		//);
	//}

	//If comments are open or there is at least one comment, load up the comment template.
	// if ( comments_open() || get_comments_number() ) {
	// 	comments_template();
	// }

	// Previous/next post navigation.
// 	$twentytwentyone_next = is_rtl() ? twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' ) : twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' );
// 	$twentytwentyone_prev = is_rtl() ? twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' ) : twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' );

// 	$twentytwentyone_next_label     = esc_html__( 'Next post', 'twentytwentyone' );
// 	$twentytwentyone_previous_label = esc_html__( 'Previous post', 'twentytwentyone' );

// 	the_post_navigation(
// 		array(
// 			'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . $twentytwentyone_next . '</p><p class="post-title">%title</p>',
// 			'prev_text' => '<p class="meta-nav">' . $twentytwentyone_prev . $twentytwentyone_previous_label . '</p><p class="post-title">%title</p>',
// 		)
// 	);
// endwhile; // End of the loop.
?>
<section class="comments-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php 
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>
			</div>
		</div>
	</section>
	</main>
<?php
get_footer();
