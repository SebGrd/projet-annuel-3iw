<section>
	<h2>Admin view</h2>
</section>

<?php if (isset($errors)): ?>
	<?php foreach ($errors as $error): ?>
		<li style="color: red;">
			<?=$error; ?>
		</li>
	<?php endforeach; ?>
<?php endif; ?>

<div class="main">
	<?php if (isset($session)): ?>
		<!-- TODO <?php $_FB::profile($user); ?> -->

		<?php $user->getId(); ?>

		<?php $user->getId(); ?>
	<?php endif; ?>
</div>