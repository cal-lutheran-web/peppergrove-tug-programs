<?php

	$aside = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'medium', false, array('class' => 'circle-wrap'));

	$cite = '<cite>'.get_the_title().'</cite><p>'.get_field('job_title').'<br />'.get_field('company').'</p>';
	$read_more = (get_field('url') !== '') ? '<a href="'.get_field('url').'" class="btn">Read More</a>' : '';

	$si_content = '<blockquote>'.get_field('quote').'</blockquote>'.$cite.$read_more;

?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">

			<?php short_item($aside,$si_content,'short-item-large'); ?>

		</div>
	</div>
</div>			