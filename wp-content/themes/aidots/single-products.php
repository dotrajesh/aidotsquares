<?php
get_header();
?>

<main>

<section class="blogs-slider products custom-header">
		<div class="container">
			<div class="col-md-12">
				<div class="service-detail">
					<h1><?php echo get_the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>


</main>
<?php the_content();

get_footer();





?>