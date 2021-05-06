<title><?php the_title(); ?> | Degrees at Cal Lutheran</title>



<?php if(get_field('meta_description')){ ?>
	<meta name="description" content="<?php the_field('meta_description'); ?>" />
<?php } ?>



<?php

	$share_title = get_field('share_title') ? get_field('share_title') : get_the_title().' at Cal Lutheran';
	$share_description = get_field('share_description') ? get_field('share_description') : strip_tags(get_field('summary'));
	$share_img = get_field('share_image') ? get_field('share_image') : '';
	
?>


<!-- Social Media Tags -->
<meta property="og:title" content="<?php echo $share_title; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo program_url($post); ?>" />
<meta property="og:image" content="<?php echo $share_img; ?>" />
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:description" content="<?php echo $share_description; ?>" />
<meta property="og:site_name" content="Majors &amp; Minors at Cal Lutheran" />			





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