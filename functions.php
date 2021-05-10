<?php



function program_url($post){

	$post_type = $post->post_type;

	if($post_type == 'major'){
		$type_slug = 'majors';
	} else if ($post_type == 'minor'){
		$type_slug = 'minors';
	} else if ($post_type == 'advising'){
		$type_slug = 'advising';
	}

	$slug = $post->post_name;

	return 'https://www.callutheran.edu/academics/'.$type_slug.'/'.$slug.'/';

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
	
	if(get_field('faculty_list') && $post->post_type !== 'advising'){
		$active['faculty'] = 'Your Professors';
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




?>