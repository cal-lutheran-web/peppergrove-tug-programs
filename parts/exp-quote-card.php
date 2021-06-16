<?php

	$quote = get_field('quote');

	$img_data = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	$video_id = get_field('youtube_id');

	if($video_id !== ''){
		$media = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$video_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	} else if($img_data !== false){
		$media = '<img src="'.$img_data.'">';
	}
	

?>


<div class="wrap-16x9"><?php echo $media; ?></div>
<?php echo $quote; ?>
