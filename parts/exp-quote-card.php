<?php

	$img_data = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	$quote = get_field('quote');

?>


<div class="wrap-16x9"><img src="<?php echo $img_data; ?>"></div>
<? echo $quote; ?>
