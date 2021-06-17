<?php

	$featured_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'medium', false, array('class' => 'circle-wrap'));

	$aside = ($featured_img !== '') ? $featured_img : '';

	$cite = get_cite_html($post->ID);

	//$read_more = (get_field('url') !== '') ? '<a href="'.get_field('url').'" class="btn">Read More</a>' : '';

	$si_content = '<blockquote><p>'.get_field('quote').'</p></blockquote>'.$cite;

?>


	<div class="row">
		<div class="col-sm-12">

			<?php short_item($aside,$si_content,'short-item-large short-item-no-border'); ?>

		</div>
	</div>
	