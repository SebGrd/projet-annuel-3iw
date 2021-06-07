<section>
	<h2>Register view</h2>
</section>

<?php if (isset($errors)): ?>
	<?php foreach ($errors as $error): ?>
		<li style="color: red;">
			<?=$error; ?>
		</li>
	<?php endforeach; ?>
<?php endif; ?>

<div class="main">
	<?php $formBuilder::render($form); ?>
</div>