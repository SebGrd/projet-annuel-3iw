<title>Home</title>

<section>
	<h1>Home view</h1>
</section>

<!-- Show messages -->
<?= $_::render('incl.message', ['msgs' => ['login_success'], 'errs' => $errors ?? []]); ?>
