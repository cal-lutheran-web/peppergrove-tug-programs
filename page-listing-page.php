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
	<title>Majors and Minors Listing Page</title>


	<link rel="canonical" href="https://www.callutheran.edu/academics/majors/" />
	

	<?php conejo_css(); ?>

	<!-- Majors Listing CSS -->
	<link rel="stylesheet" type="text/css" href="https://www.callutheran.edu/academics/majors/_resources/css/majors-listing.css" />
	

	<?php conejo_js(); ?>


	<!-- Majors Listing JS -->
	<script type="text/javascript" src="https://www.callutheran.edu/academics/majors/_resources/js/majors-listing-2021.js"></script>


	

</head>
<body>


<section class="header-row bg-overlay" id="section-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>Undergraduate Majors &amp; Minors</h1>
				<form id="search-form" action="." method="get">
					
					<div class="search-wrapper">
						<label for="search-box" class="icon-search"><span class="sr-only">Search by Keyword</span></label>
						<input type="text" class="keyword-search" name="search-box" id="search-box" placeholder="Search by Keyword">
					</div>
					
					<div id="search-results">
						<ul style="display: none;"></ul>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>






<section class="bg-white" id="section-2">
	<div class="container">
	<div class="row">
	<div class="col-sm-12">

<?php

	$all_categories = get_terms(array(
		'taxonomy' => 'category',
		'hide_empty' => true,
		'exclude' => 1
	));
	
	if(!empty($all_categories)){
?>


	<div class="row" id="filters-row">
		<div class="col-sm-12">
			<h4 class="centered">Browse by Category</h4>
			<ul id="the-categories">
				<li><label><input value="all-categories" name="categories" type="radio" checked="checked"><span>All Categories</span></label></li>

				<?php foreach($all_categories as $key=>$cat) {
					echo '<li><label><input value="'.$cat->slug.'" name="categories" type="radio"><span>'.$cat->name.'</span></label></li>';
				} ?>
			</ul>
		</div>
	</div>


<?php } ?>









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
								<li class="<?php ?>">
									<a href="<?php echo $m->post_name; ?>/" title="<?php echo $m->post_title; ?>" class="degree-item-link">
										<span class="degree-title"><?php echo $m->post_title; ?></span>
										<small><?php echo program_format_string($m,'short'); ?></small>
									</a>

										<?php
											$concentrations = get_field('concentrations', $m->ID);

											if(!empty($concentrations)){ ?>
												<ul class="sublist">
													<?php foreach($concentrations as $key=>$c){
														echo '<li>'.$c->name.'</li>';
													} ?>
												</ul>

										<?php } ?>

										
								
								</li>
							<?php } ?>

						</ul>

					</div>
					<div class="col-sm-4">
					
						<div class="bg-box bg-white">
							<h5>Advising Programs</h5>
							<?php the_field('advising_programs'); ?>
							
							<ul>
							<?php $advising_programs = get_posts(array( 'post_type' => 'advising' ));

							foreach($advising_programs as $key=>$a){
								echo '<li><a href="'.$a->post_name.'">'.$a->post_title.'</a></li>';
							}
							?>
							</ul>
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


</div>
</div>
</section>




</body>
</html>