<!-- breadcrumbs -->
<?php
	
	echo breadcrumbs(array(
		array(
			'link' => "/academics/",
			"name" => "Academics"
		),
		array(
			"link" => "/academics/majors/",
			"name" => "Undergraduate Majors & Minors"
		),
		array(
			"name" => get_the_title()
		)
	));

?>