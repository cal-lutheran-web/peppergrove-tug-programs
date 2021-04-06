<?

	$aside = '<img class="circle-wrap" src="" alt="'.get_the_title().'">';

	$read_more = (get_field('url') !== '') ? '<a href="'.get_field('url').'" class="btn">Read More</a>' : '';

	$si_content = get_field('quote').$read_more;

?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">

			<? short_item($aside,$si_content,'short-item-large'); ?>

		</div>
	</div>
</div>			