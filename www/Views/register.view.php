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

<?php App\Core\FormBuilder::render($form); ?>

<h2>Login</h2>

<?php App\Core\FormBuilder::render($formLogin); ?>