<?php


// sets up majors contributor role for non-marketing users to edit majors
//remove_role( 'majors_contributor' );

$majors_contributor_role = add_role('majors_contributor', 'Majors Contributor', get_role('editor')->capabilities);


function html_prepend($post){

	if(isset($_GET['preview'])){
		
		//$redirect_url = program_url($post,'dev');
		$redirect_params = '?post_type='.$_GET['post_type'].'&p='.$_GET['p'].'&preview=true';
		//$redirect_url = (is_local() == true) ? 'http://cluwp.local/tug-programs/' : 'http://dev.callutheran.edu/academics/majors/detail.html';
		
		//header("Location: http://dev.callutheran.edu/academics/majors/detail.html".$redirect_params);
	}
}



function program_url($post,$server='www'){

	if($server == '' || $server == 'www'){
		$server = 'https://www';
	} elseif($server == 'dev'){
		$server = 'http://dev';
	}

	$post_type = $post->post_type;

	if($post_type == 'major'){
		$type_slug = 'majors';
	} else if ($post_type == 'minor'){
		$type_slug = 'minors';
	} else if ($post_type == 'advising'){
		$type_slug = 'advising';
	}

	$slug = $post->post_name;

	return $server.'.callutheran.edu/academics/'.$type_slug.'/'.$slug;

}






function page_hero_images($post){

	$large_hero = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'large');
	$small_hero = wp_get_attachment_url(get_post_thumbnail_id($post->ID), 'medium');

	return array(
		'large' => $large_hero,
		'small' => $small_hero
	);
}


function active_sections($post){

	$active = array();

	if(get_field('curriculum')){
		$active['curriculum'] = 'The Curriculum';
	}

	if(get_field('related_exp_quotes')){
		$active['experience'] = 'The Experience';
	}

	if(get_field('career_intro')){
		$active['future'] =  'Your Future';
	}

	$faculty_list = array_filter(get_field('faculty_list'));
	
	if(!empty($faculty_list) && $post->post_type !== 'advising'){
		$active['your-professors'] = 'Your Professors';
	}

	return $active;

}



function program_format_string($post,$type='full'){

	// short returns BA, BS
	// full returns Bachelor of Arts<br />Bachelor of Science

	$format = get_field('program_format', $post->ID);
	$formats = array();

	if(!empty($format)){
	
		foreach($format as $item){

			if($item == 'ba'){
				if($type == 'short'){
					$formats[] = 'BA';
				} else {
					$formats[] = 'Bachelor of Arts';
				}
			}
		
			if($item == 'bs'){
				if($type == 'short'){
					$formats[] = 'BS';
				} else {
					$formats[] = 'Bachelor of Science';
				}
			}

		}

		$separator = ($type == 'short') ? ', ' : '<br />';

		return implode($separator,$formats);

	} else {

		return false;

	}

		
}



function program_format_sentence($post){

	$format = get_field('program_format');

	if(!empty($format)){
		$degree_string = '';
		
		if(in_array('major', $format)){ $degree_string .= 'a major '; }
		if(in_array('ba', $format) && !in_array('bs', $format)){ $degree_string .= '(BA)'; }
		if(in_array('bs', $format) && !in_array('ba', $format)){ $degree_string .= '(BS)'; }	
		if(in_array('ba', $format) && in_array('bs', $format)){ $degree_string .= '(BA or BS)'; }
		if(in_array('major', $format) && in_array('minor', $format)){ $degree_string .= ' and a <a href="/academics/minors/'.$post->post_name.'">minor</a>'; }	
		if(in_array('minor', $format) && !in_array('major', $format)){ $degree_string .= 'a minor'; }

		return 'Offered as '.$degree_string.'.';
	} else {
		return false;
	}

}





function program_format_search_result($post){

	if($post->post_type == 'major'){

		$format = get_field('program_format', $post->ID);
		
		if(!empty($format) && in_array('advising',get_field('program_format', $post->ID))){
			$type = 'Advising Program';
		} else {
			$type = 'Major';
		}

	} else {
		$type = 'Minor';
	}

	return $type;

}





function get_cite_html($post_id){

	$quote_text = get_field('quote', $post_id);

	$quote_cite_array = array();

	// add name
	$quote_name = (get_field('class_year', $post_id) !== '') ? get_the_title($post_id).' '.get_class_year(get_field('class_year', $post_id)) : get_the_title($post_id);
	$quote_cite_array[] = $quote_name;

	// major
	if(get_field('major') !== ''){
		$quote_cite_array[] = (get_field('major', $post_id) !== '') ? get_field('major', $post_id).' Major' : '';
	}

	// job title and company
	$quote_job_array = array();
	$quote_job_array[] = get_field('job_title', $post_id);
	$quote_job_array[] = get_field('company', $post_id);

	$quote_job = implode(', ', array_filter($quote_job_array));

	$quote_cite_array[] = $quote_job;

	// location
	$quote_cite_array[] = get_field('location', $post_id);

	return '<p><cite>'.implode('<br />', array_filter($quote_cite_array)).'</cite></p>';

	
}


?>