<?php
/*
* Template Name: test
*/
get_header(); ?>
<?php the_content(get_the_ID()); ?>
<main>
	
	<section class="service-slider">
		<div class="container">
			<div class="col-md-12">
				<div class="service-detail">
					<h1><?php echo get_the_title(); ?></h1>
					<p>AI SOLUTION</p>
				</div>
			</div>
		</div>
	</section>
	<section class="smart-snout-content">
		<?php echo get_the_content(); ?>
		<!--<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="smart-snout-img">
						<img src="<?php //bloginfo('template_url'); ?>/assets/images/hsat.png" alt="HSAT/ Geospatial" />
					</div>
				</div>
				<div class="col-md-6 ">
					<div class="smart-heading">
						<h2> HSAT/ Geospatial </h2>
						<p>India is heavily reliant on agriculture.
							Organic, economic, and seasonal factors all influence agricultural yield.
							By fusing images from different satellites and using supervised machine learning models we enabled highly precise information to be obtained about crops.
						</p>
					</div>
				</div>
			</div>
		</div>
		<section class="content-paragraph">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="sub-heading">
							<h3><strong>(1). </strong> Benefits We Delivered</h3>
							<p class="evaltic">  <strong>Estimated agricultural production</strong> with <strong>geospatial technology </strong> that will predict future yield production that can help farmers make the necessary planning for things like storing and marketing.We have used the very latest <strong>satellite technology </strong> together with cutting edge data analytics to help organizations make better decisions.</p>
							<h6>  ○ Provide Insights:</h6>
							<p>We aim to provide insights in the form of dashboards, alerts, or even custom APIs so that organizations have the right information at the right time – be it traders, insurers, farmers or NGOs.</p>
							<h6>  ○ Predict Future yields:</h6>
							<p>We combined the Satellite images of crops with weather data and historical yields is used to predict the future yields based on the current size and state of the crops.</p>
							<h6>  ○ Detect Health of Crops:</h6>
							<p>We pre-owned the capabilities of modern satellites to detect the health of crops and activity of city, town, or factory combined with machine learning to predict yields/output, supply and demand.We have used the geospatial data originated from the satellite imagery to understand, monitor, and predict crops.</p>
							<h6>  ○ Providing satellite data: </h6>
							<p>Build a solution from which framers can request satellite data for their field by providing the geometry of their farm and the date range they want the data. And the process will provide them NDVI or RGB images based on their choice, on their email with an s3 pre-signed URL.</p>
							<hr>
							<h3><strong>(2). </strong>End to End Technical Solution </h3>
							<h6>  ○ Serverless/Event-driven approach </h6>
							<p>We proposed and integrate serverless services/architecture such as lambda. So when an event occurs images/video/text/CSV/JSON file is uploaded into a bucket or cloud watch event is triggered at a predefined time, the lambda gets triggered and performs necessary action.</p>
							<h6>  ○ Reporting </h6>
							<p>We develop automated reporting features for the client. So reports are generated after a pre denied interval of time or when event new data comes in i.e. whenever an event gets triggered, the report gets generated and mailed to the client.</p>
							<h6>  ○ Quality Assurance </h6>
							<p>We have performed different types of testing to ensure the delivery of a quality end product. Different testing conducted was Functional, device, regression, and performance testing. Our team made sure that all the gaps are identified in the testing process and the development team fills those gaps with an optimal solution.</p>
							<h6>  ○ Documentation </h6>
							<p>The team has prepared user manuals, SRS (software requirement specification), wireframes and project plans, change request documents, and system design approval.</p>
							<h6>  ○ Server Infrastructure </h6>
							<p>We used AWS to host the system. Lambda is serverless, S3 is highly scalable and has durable access to the database and EC2 is not public.</p>
						</div>
					</div>
				</div>
			</div>
		</section>-->
	</section>
	
</main>
<!-- ======= Footer ======= -->
<?php get_footer(); ?>