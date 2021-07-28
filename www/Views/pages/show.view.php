
<div class="container">
	<section>
		<h2 class="flex flex-row justify-center"><?= $page->getTitle(); ?></h2>
	</section>

	<?php if ($page->getImage() !== null): ?>
		<div class="flex flex-row justify-center">
			<img src="../<?= $_::getImageUrl($page->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
		</div>
	<?php endif; ?>

	<div class="main">
			<?= html_entity_decode($page->getHTML()); ?>
	</div>
</div>