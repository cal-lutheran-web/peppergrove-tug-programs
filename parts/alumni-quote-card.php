<?php

	$featured_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'medium', false, array('class' => 'circle-wrap'));

	$aside = ($featured_img !== '') ? $featured_img : '';

	$cite = get_cite_html($post->ID);

	$quote_text = '<p>'.nl2br(get_field('quote', false, false)).'</p>';
	
	$si_content = '<blockquote>'.$quote_text.'</blockquote>'.$cite;

?>


	<div class="row">
		<div class="col-sm-12">
			<?php short_item($aside,$si_content,'short-item-large short-item-no-border'); ?>
		</div>
	</div>
	