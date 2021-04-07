<!DOCTYPE HTML>
<html>
<head>

	<title><?php the_title(); ?> | Degrees at Cal Lutheran</title>

	<?php
		$large_hero = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'large');
		$small_hero = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'medium');
	?>

	<style type="text/css">
			.degree-detail .page-hero {
				background-image: url('<?php echo $small_hero; ?>'); /* FOR MOBILE */
				background-position: center bottom;
			}
			@media (min-width: 768px){
				.degree-detail .page-hero {
					background-image: url('<?php echo $large_hero; ?>'); /* FOR DESKTOP */
					background-position: center bottom;
				}
			}
	</style>
		
</head>
<body>
		
	<section class="page-hero tall">
		<div class="page-hero-heading-wrapper">
			<h1 class="page-hero-heading"><?php the_title(); ?></h1>
			<h2 class="page-hero-subheading"><?php echo program_format_string($post); ?></h2>
		</div>
		<div class="overlay-medium"></div>
	</section>
	
	<!-- breadcrumbs -->
	<?php get_template_part('parts/breadcrumbs'); ?>

	
	<!-- PAGE INTRO WITH VIDEO -->
	<?php $summary_css_class = (get_field('overview_video') !== '') ? 'col-sm-6' : 'col-sm-9'; ?>

	<section>
		<div class="container">
							
			<div class="<?php echo $summary_css_class; ?> program-summary">
				
				<?php the_field('summary'); ?>
				
			</div>
			
			<?php if(get_field('overview_video') !== '') { ?>
				<div class="col-sm-6">
					<div class="wrap-16x9">
						<iframe id="youTubePlayer" width="560" height="315" src="//www.youtube.com/embed/<?php the_field('overview_video'); ?>?modestbranding=1&amp;rel=0&amp;showinfo=0&amp;controls=1&amp;wmode=transparent&amp;enablejsapi=1&amp;origin=https://www.callutheran.edu" allowfullscreen=""></iframe>
					</div>
				</div>
			<?php } ?>
						
			<div class="col-sm-12 hide-on-desktop">
				<a href="/academics/majors" class="btn btn-arrow-left green btn-small">View Other Majors</a>
			</div>
		</div>
	</section>
		





	<!-- THE PAGE NAVBAR THING -->
	<?php get_template_part('parts/in-page-nav'); ?>





<div id="content-sections">		
		
	<!-- THE CURRICULUM -->
	
	<section id="the-curriculum">
		<div class="container">
			<div class="col-sm-12"><div class="section-title">The Curriculum</div></div>
			<div class="col-md-8 col-sm-9">
			
				<?php the_field('curriculum'); ?>
			
			</div>
			<div class="col-md-4 col-sm-3">
				
				<hr class="gold hide-on-desktop">
				
				<h6>Programs</h6>
				<p><?php echo program_format_sentence($post); ?></p>
				<br>

				
				<?php
					$concentrations = get_field('concentrations');

					if(!empty($concentrations)){ ?>
					
					<h6>Concentrations</h6>
					<ul>
						<?php foreach($concentrations as $key=>$c){
							echo '<li>'.$c->name.'</li>';
						} ?>
					</ul>

					<?php } ?>

				
				<?php
					$related_minors = get_field('related_minors');

					if(!empty($related_minors)){ ?>
					
					<h6>Popular Minor Pairings</h6>
					<ul class="special-list">

						<?php foreach($related_minors as $key=>$item){
							echo '<li><a href="/academics/minors/'.$item->post_name.'">'.$item->post_title.'</a></li>';
						} ?>

					</ul>
					<br>	

				<?php } ?>
							

				<div class="row">
					<div class="col-sm-12 col-md-9">
				
						<div class="btn-group">
							<?php if(get_field('catalog_url')){ ?>
								<a class="btn gold icon-check block btn-arrow-right" href="<?php the_field('catalog_url'); ?>" title="Course Requirements">Course Requirements</a>
								
								<a class="btn gold icon-course-requirements block btn-arrow-right" href="<?php the_field('catalog_url'); ?>#courseinventory" title="Course Descriptions">Course Descriptions</a>		
							<?php } ?>

							<?php if(get_field('department_url')){ ?>
								<a class="btn gold icon-web block btn-arrow-right" href="<?php the_field('department_url'); ?>" title="Department Website">Department Website</a>
							<?php } ?>			
						</div>
						<br>
						
						<?php get_template_part('parts/sidebar-cta'); ?>
						
					</div>
				</div>
				
			</div>
		</div>
	</section>
		
		
		
		
		
	<!-- THE EXPERIENCE -->
	<section id="the-experience" style="padding-bottom:0;">
		<div class="container">
			<div class="col-sm-12">
				<div class="section-title">The Experience</div>
			</div>
			<div class="col-sm-12">
					
				<div class="two-column-feature">
					<div class="flexrow">
						<?php

							$exp_quotes_field = get_field('related_exp_quotes');
							shuffle($exp_quotes_field);
						
							$displayed_quotes = array_slice($exp_quotes_field, 0, 2);
							
							$exp_posts = get_posts(array(
								'post_type' => 'quotes',
								'include' => $displayed_quotes
							));

							foreach($exp_posts as $key=>$post){
								setup_postdata($post);

								echo '<div class="col-sm-6">';
								get_template_part('parts/exp-quote-card');
								echo '</div>';
							}

							wp_reset_postdata();
							

						?>
					</div>
							
				</div>
			</div>
		</div>
	</section>
		
		
		
		
	
	<!-- YOUR FUTURE -->
	<section id="your-future">
		<div class="container">
			<div class="col-sm-12"><div class="section-title">Your Future</div></div>
				
				<div class="col-sm-9">

					<?php the_field('career_intro'); ?>

					<div class="row">
						<div class="col-sm-4">
							<h6>Our alumni study at:</h6>
							
							<?php the_field('employers'); ?>

						</div>
						<div class="col-sm-4">
							<h6>Our alumni work for:</h6>

							<?php the_field('job_titles'); ?>
							
						</div>
						<div class="col-sm-4">
							<h6>Career paths:</h6>

							<?php the_field('graduate_schools'); ?>

						</div>					
					</div>
					
				</div>
		
				<div class="col-sm-3 centered">

					<div class="factoid-pie" id="pie-chart-97">
						<div class="ct-chart ct-octave" data-pie="97"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-pie" style="width: 100%; height: 100%;"><g class="ct-series ct-series-b"><path d="M85.5,0A43,43,0,0,0,77.295,0.79L85.5,43Z" class="ct-slice-pie" ct:value="3"></path></g><g class="ct-series ct-series-a"><path d="M77.443,0.762A43,43,0,1,0,85.5,0L85.5,43Z" class="ct-slice-pie" ct:value="97"></path></g><text x="50%" y="50%" dy="0.5ex" class="ct-label">97%</text></svg></div>
						<p>of Cal Lutheran graduates find a job or enroll in graduate school within nine months</p>
					</div>
					
					<a href="/admission/undergraduate/discover/career-outcomes.html" class="btn btn-arrow-right block blue">More Career Outcomes</a>
				</div>
			</div>




			<?php

				$alumni_quotes_field = get_field('related_quotes');
				shuffle($alumni_quotes_field);
			
				$displayed_alumni_quotes = array_slice($alumni_quotes_field, 0, 1);
				
				$alumni_posts = get_posts(array(
					'post_type' => 'quotes',
					'include' => $displayed_alumni_quotes
				));

				if(!empty($alumni_posts)){
					foreach($alumni_posts as $key=>$post){
						setup_postdata($post);
						
						get_template_part('parts/alumni-quote-card');
					}
				}
				
				wp_reset_postdata();

			?>

			
			
		</section>
		
				
		
	<!-- YOUR PROFESSORS -->
	<section id="your-professors">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="section-title">Your Professors</div>
				</div>
			</div>
			<div class="flexrow">

				<?php get_template_part('parts/faculty-list'); ?>
							
			</div>
		</div>
	</section>

</div>
	





</body>
</html>
