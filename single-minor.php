<!DOCTYPE HTML>
<html>
<head>

	<?php get_template_part('parts/html-head'); ?>
		
</head>
<body class="degree-detail">
	
	<!-- Page Hero -->
	<?php get_template_part('parts/page-hero', 'minor'); ?>
	
	<!-- breadcrumbs -->
	<?php get_template_part('parts/breadcrumbs'); ?>

	<section>
		<div class="container">
			<div class="row">		
				<div class="col-sm-9">
					
					<p class="page-intro"><?php the_field('intro'); ?></p>

					<?php the_field('description'); ?>

					<p><a href="/academics/majors/?tab=minors" class="hide-on-mobile"><i class="icon-left-dir"></i>Show All Minors</a></p>
					
				</div>
				<div class="col-sm-3">

					<?php
						$related_majors = get_field('related_majors');

						if(!empty($related_majors)){ ?>
					
						<h5>Popular Major Pairings</h5>
						<ul>
							<?php foreach($related_majors as $key => $item){
								echo '<li><a href="'.$item->post_name.'">'.$item->post_title.'</a></li>';
							} ?>
						</ul>
					<?php } ?>

					<?php if(!empty(get_field('catalog_url'))){ ?>
						<div class="btn-group">	
							<a class="btn block offwhite icon-course-requirements" href="<?php the_field('catalog_url'); ?>" title="Course Requirements">Course Requirements</a>
						</div>
						<br>
					<?php } ?>

					<?php get_template_part('parts/sidebar-cta'); ?>
									
				</div>
			</div>
		</div>
	</section>
		
</body>
</html>