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







function bidirectional_acf_update_value( $value, $post_id, $field  ) {
	
	// vars
	$field_name = $field['name'];
	$field_key = $field['key'];
	$global_name = 'is_updating_' . $field_name;
	
	
	// bail early if this filter was triggered from the update_field() function called within the loop below
	// - this prevents an inifinte loop
	if( !empty($GLOBALS[ $global_name ]) ) return $value;
	
	
	// set global variable to avoid inifite loop
	// - could also remove_filter() then add_filter() again, but this is simpler
	$GLOBALS[ $global_name ] = 1;
	
	
	// loop over selected posts and add this $post_id
	if( is_array($value) ) {
	
		foreach( $value as $post_id2 ) {
			
			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);
			
			
			// allow for selected posts to not contain a value
			if( empty($value2) ) {
				
				$value2 = array();
				
			}
			
			
			// bail early if the current $post_id is already found in selected post's $value2
			if( in_array($post_id, $value2) ) continue;
			
			
			// append the current $post_id to the selected post's 'related_posts' value
			$value2[] = $post_id;
			
			
			// update the selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);
			
		}
	
	}
	
	
	// find posts which have been removed
	$old_value = get_field($field_name, $post_id, false);
	
	if( is_array($old_value) ) {
		
		foreach( $old_value as $post_id2 ) {
			
			// bail early if this value has not been removed
			if( is_array($value) && in_array($post_id2, $value) ) continue;
			
			
			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);
			
			
			// bail early if no value
			if( empty($value2) ) continue;
			
			
			// find the position of $post_id within $value2 so we can remove it
			$pos = array_search($post_id, $value2);
			
			
			// remove
			unset( $value2[ $pos] );
			
			
			// update the un-selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);
			
		}
		
	}
	
	
	// reset global varibale to allow this filter to function as per normal
	$GLOBALS[ $global_name ] = 0;
	
	
	// return
    return $value;
    
}

add_filter('acf/update_value/name=related_quotes', 'bidirectional_acf_update_value', 10, 3);


?>