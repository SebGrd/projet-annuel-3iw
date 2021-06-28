<section>
	<h2>Forgot Password</h2>
</section>

<?php if (isset($success)): ?>
	<li style="color: green;">
		<?=$success; ?>
	</li>
<?php endif; ?>

<?php if (isset($errors)): ?>

<?php foreach ($errors as $error): ?>
<li style="color: red;">
	<?=$error; ?>
</li>
<?php endforeach; ?>

<?php endif; ?>

<?php App\Core\FormBuilder::render($formResetPassword??$formNewPassword); ?>