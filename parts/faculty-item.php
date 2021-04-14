<?php
	// check for profile photo
	$img = (isset($faculty_item['has_image']) && $faculty_item['has_image'] == 'true' ) ? 'https://earth.callutheran.edu/images/profile_photos/150/'.$faculty_item['id'].'.jpg' : 'https://www.callutheran.edu/academics/majors/_resources/placeholder.png';
?>


<a class="profile" href="/faculty/profile.html?id=<?php echo $faculty_item['username']; ?>" title="<?php echo $faculty_item['name']; ?>">
	<div class="square-profile ll-bg" style="background-image: url('<?php echo $img; ?>');"></div>
	<header><?php echo $faculty_item['name']; ?></header>
	<p><?php echo $faculty_item['title']; ?></p>
</a>
	
