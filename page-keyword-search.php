<?php

$search_index = array();

// All majors and minors
$title_search = new WP_Query(array(
	'post_type' => array(
		'major',
		'minor'
	),
	'orderby' => 'title',
	'order' => 'ASC',
	's' => $_GET['search'],
	'posts_per_page' => -1
));


if($title_search->have_posts()){
	while($title_search->have_posts()){
		$title_search->the_post();

		$key = $post->post_name.'-'.$post->post_type;

		$detail = array(
			'title' => get_the_title(),
			'subtitle' => program_format_search_result($post),
			'slug' => $post->post_name,
		);

		$search_index[$key] = $detail;
	}
}

wp_reset_postdata();



// concentration and keyword search

$tax_search = new WP_Term_Query(array(
	'orderby' => 'title',
	'order' => 'ASC',
	'taxonomy' => array( 'concentrations', 'keywords' ),
	'name__like' => $_GET['search'],
	'posts_per_page' => -1
));

if(!empty($tax_search) && ! is_wp_error($tax_search)) {

	foreach($tax_search->get_terms() as $term){
		


		$tax_posts = get_posts(array(
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => array(
				'major',
				'minor'
			),
			'tax_query' => array(
				'relation' => 'OR',
			    array(
			        'taxonomy' => 'concentrations',
			        'field'    => 'slug',
			        'terms'    => $term->slug,
			    ),
				array(
			        'taxonomy' => 'keywords',
			        'field'    => 'slug',
			        'terms'    => $term->slug,
			    )
			),
			'posts_per_page' => -1
		));

		if(!empty($tax_posts)){
			foreach($tax_posts as $t){

				$key = ($term->taxonomy == 'concentrations') ? $t->post_name.'-concentration' : $t->post_name.'-'.$t->post_type;
				
				$subtitle = ($term->taxonomy == 'concentrations') ? 'Concentration in ' : '';

				if($term->taxonomy == 'concentrations'){

					$detail = array(
						'title' => $term->name,
						'subtitle' => 'Concentration in '.$t->post_title,
						'slug' => $t->post_name
					);

					$search_index[$key] = $detail;

				} else {

					$detail = array(
						'title' => $t->post_title,
						'subtitle' => program_format_search_result($t),
						'slug' => $t->post_name
					);

					$search_index[$key] = $detail;
				}
			
				
			}
			

		}

	}

}

// Restore original Post Data
wp_reset_postdata();

if(empty($search_index)){

	$search_index = array(
		array(
			'title' => 'No Results Found.',
			'subtitle' => '',
			'slug' => ''
		)
	);

}



// return as JSON
header('Content-Type: application/json');
print_r(json_encode($search_index));







?>