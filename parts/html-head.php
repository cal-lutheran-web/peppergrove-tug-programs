<title><?php the_title(); ?> | Degrees at Cal Lutheran</title>

<?php conejo_css(); ?>

<link rel="stylesheet" type="text/css" href="https://www.callutheran.edu/academics/majors/_resources/css/degree-detail.css" />

<?php if(!empty(page_hero_images($post)['large'])){ ?>

<style type="text/css">
		.degree-detail .page-hero {
			background-image: url('<?php echo page_hero_images($post)['small']; ?>'); /* FOR MOBILE */
			background-position: center bottom;
		}
		@media (min-width: 768px){
			.degree-detail .page-hero {
				background-image: url('<?php echo page_hero_images($post)['large']; ?>'); /* FOR DESKTOP */
				background-position: center bottom;
			}
		}
</style>

<?php } ?>



<?php conejo_js(true); ?>

<script src="https://www.callutheran.edu/_resources/js/jquery.waypoints.min.js?v=1"></script>
<script src="https://www.callutheran.edu/academics/majors/_resources/js/program-detail.js?v=5-8-18-b"></script>