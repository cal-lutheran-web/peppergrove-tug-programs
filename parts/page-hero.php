<section class="page-hero tall">
	<div class="page-hero-heading-wrapper">
		<h1 class="page-hero-heading"><?php the_title(); ?></h1>
		<h2 class="page-hero-subheading"><?php echo program_format_string($post); ?></h2>
	</div>
	<?php if(!empty(page_hero_images($post)['large'])){ ?>
	<div class="overlay-medium"></div>
	<?php } ?>
</section>