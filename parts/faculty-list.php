<?

$faculty_list = get_field('faculty_list');

foreach($faculty_list as $key=>$f){
	parse_str($f, $faculty_item); ?>


<a class="profile" href="/faculty/profile.html?id=<? echo $faculty_item['username']; ?>" title="<? echo $faculty_item['name']; ?>">
	<div class="square-profile ll-bg" style="background-image: url('https://earth.callutheran.edu/images/profile_photos/150/<? echo $faculty_item['id']; ?>.jpg');"></div>
	<header><? echo $faculty_item['name']; ?></header>
	<p><? echo $faculty_item['title']; ?></p>
</a>
	

	
<? } ?>