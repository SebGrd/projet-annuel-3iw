<section>
	<h2>Admin view</h2>
</section>

<!-- Show messages -->
<?= $_::render('incl.message', ['msgs' => ['login_success'], 'errs' => $errors ?? []]); ?>

<div class="main">
	<?php if (isset($session)): ?>
		<?= $_FB::render($form); ?>
		<?= $user->getId(); ?>
	<?php endif; ?>
</div>