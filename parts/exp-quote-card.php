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
	
		$cite = explode('<cite>', $blockquote_array[0]);
		$quote_text = '';

		if(sizeof($cite) > 1){
			// cite tag is inline in quote
			$quote_text = explode('<p><cite>',$blockquote_array[0])[0];
			$quote_cite = '<p><cite>'.$cite[1];
		} else {
			// cite tag separate from quote
			$quote_text = $blockquote_array[0];
			$quote_cite = $blockquote_array[1];
		}

	} else {
	
		$quote_text = get_field('quote');

		$quote_cite_array = array();

		// add name
		$quote_name = (get_field('class_year') !== '') ? get_the_title().' '.get_class_year(get_field('class_year')) : get_the_title();
		$quote_cite_array[] = $quote_name;

		// major
		if(get_field('major') !== ''){
			$quote_cite_array[] = (get_field('major') !== '') ? get_field('major').' Major' : '';
		}

		// job title and company
		$quote_job_array = array();
		$quote_job_array[] = get_field('job_title');
		$quote_job_array[] = get_field('company');

		$quote_job = implode(', ', array_filter($quote_job_array));

		$quote_cite_array[] = $quote_job;

		// location
		$quote_cite_array[] = get_field('location');

		$quote_cite = '<p><cite>'.implode('<br />', array_filter($quote_cite_array)).'</cite></p>';

	}
	
	$quote_html = '<blockquote>'.$quote_text.'</blockquote>'.$quote_cite;



	

?>


<div class="wrap-16x9"><?php echo $media; ?></div>
<?php echo $quote_html; ?>
