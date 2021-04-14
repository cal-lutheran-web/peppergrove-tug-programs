
<nav id="page-navbar">
	<div class="container">
		<ul>

			<?php foreach(active_sections($post) as $key=>$item){ ?>
				<li><a href="#<?php echo $key; ?>" title="<?php echo $item; ?>"><?php echo $item; ?></a></li>
			<?php } ?>
		</ul>
	</div>
</nav>
