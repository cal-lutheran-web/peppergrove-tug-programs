<title><?php the_title(); ?> | Degrees at Cal Lutheran</title>

<?php
	$large_hero = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'large');
	$small_hero = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'medium');
?>

<?php conejo_css(); ?>

<link rel="stylesheet" type="text/css" href="https://www.callutheran.edu/academics/majors/_resources/css/degree-detail.css" />
<link rel="stylesheet" type="text/css" href="https://www.callutheran.edu/_resources/css/chartist.min.css" />
<link rel="stylesheet" type="text/css" href="https://www.callutheran.edu/_resources/css/custom-charts.css" />



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



<?php conejo_js(true); ?>

<script src="https://www.callutheran.edu/_resources/js/chartist.min.js"></script>
<script src="https://www.callutheran.edu/_resources/js/custom-charts.js"></script>
<script src="https://www.callutheran.edu/_resources/js/jquery.waypoints.min.js?v=1"></script>
<script src="https://www.callutheran.edu/academics/majors/_resources/js/program-detail.js?v=5-8-18-b"></script>