<?php

$majors = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'major',
	'orderby' => 'title',
	'order' => 'asc'
));

$minors = get_posts(array(
	'numberposts' => -1,
	'post_type' => 'minor',
	'orderby' => 'title',
	'order' => 'asc'
));


?>


<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Majors and Minors Listing Page</title>
</head>
<body>




<div class="row">
	<div class="col-sm-12">
		<div class="tabs all-categories" id="program-list">
			<ul role="tablist" class="tab-list">
				<li role="none"><button class="tab-title-button" id="majors" role="tab" aria-controls="majors-content">Majors</button></li>
				<li role="none"><button class="tab-title-button" id="minors" role="tab" aria-controls="minors-content">Minors</button></li>
			</ul>
			<div class="tab-content" role="tabpanel" tabindex="0" id="majors-content" aria-labelledby="majors">
				<div class="row majors-list-header" id="majors-list-header">
					<div class="col-sm-8">
						<div class="section-title hide-on-mobile">Majors</div>
						<h4 id="category-name" class="hide-on-desktop hide"></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">

						<ul class="col-list-2 degree-list" id="majors-list">

							<?php foreach($majors as $key=>$m){ ?>
							<li class="<?php ?>"><a href="<?php echo $m->post_name; ?>/" title="<?php echo $m->post_title; ?>" class="degree-item-link"><span class="degree-title"><?php echo $m->post_title; ?></span></a></li>
							<?php } ?>

						</ul>

					</div>
					<div class="col-sm-4">
					
						<div class="bg-box bg-white">
							<h5>Advising Programs</h5>
							<?php the_field('advising_programs'); ?>
							
							<ul><li><a href="pre-engineering/" title="Pre-Engineering">Pre-Engineering</a></li><li><a href="pre-law/" title="Pre-Law">Pre-Law</a></li><li><a href="pre-med/" title="Pre-Med">Pre-Med</a></li></ul>
						</div>
							
						<div class="bg-box bg-white">
							<h5>4+1 Programs</h5>
							<?php the_field('4_plus_1_programs'); ?>
						</div>
					
					
					</div>
				</div>
			</div>

			<div class="tab-content" role="tabpanel" tabindex="0" id="minors-content" aria-labelledby="minors">
				<div class="row">
					<div class="col-sm-12">
						<div class="section-title hide-on-mobile">Minors</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="col-list degree-list" id="minors-list">
							<?php foreach($minors as $key=>$m){ ?>
								<li class="<?php ?>"><a href="<?php echo $m->post_name; ?>/" title="<?php echo $m->post_title; ?>" class="degree-item-link"><span class="degree-title"><?php echo $m->post_title; ?></span></a></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




</body>
</html>