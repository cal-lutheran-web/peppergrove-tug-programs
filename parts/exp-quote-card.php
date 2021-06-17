<?php

	$quote = get_field('quote');

	// setup media type
	$img_data = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	$video_id = get_field('youtube_id');

	if($video_id !== ''){
		$media = '<iframe width="560" height="315" src="//www.youtube.com/embed/'.$video_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	} else if($img_data !== false){
		$media = '<img src="'.$img_data.'">';
	}

	// clean up quote cite

	$blockquote_array = explode('</blockquote>',explode('<blockquote>', $quote)[1]);

	if(sizeof($blockquote_array) > 1){
		// if quote contains wrapping tags for blockquote and cite
		$cite = explode('<cite>', $blockquote_array[0]);
		$quote_text = '';

		if(sizeof($cite) > 1){
			// cite tag is inline in quote
			$quote_text = '<blockquote>'.explode('<p><cite>',$blockquote_array[0])[0].'</blockquote>';
			$quote_cite = '';
		} else {
			// cite tag separate from quote
			$quote_text = '<blockquote>'.$blockquote_array[0].'</blockquote>';
			$quote_cite = (trim($blockquote_array[1]) == '') ? get_cite_html($post->ID) : trim($blockquote_array[1]);
		}

	} else { 
		// if quote starts with H3 and not to be formatted as a quote
		$quote_text = get_field('quote');
		$quote_cite = '';
	} 
	
	$quote_html = $quote_text.$quote_cite;

?>


<div class="wrap-16x9"><?php echo $media; ?></div>
<?php echo $quote_html; ?>
