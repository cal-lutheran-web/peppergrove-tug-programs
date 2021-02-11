<?php

$archives = wp_get_archives(
	array(
	  'type' => 'yearly',
	  'post_type' => get_post_type(),
	  'echo' => false,
	  'format' => 'custom',
	  'before' => '',
	  'after' => ''
	)
);

$archive_list = explode('</a>', $archives);
$return_array = array();

foreach($archive_list as $a){
	$return_array[] = trim(strip_tags($a));
	
}


header('Content-Type: application/json');
print_r(json_encode(array_filter($return_array)));




?>