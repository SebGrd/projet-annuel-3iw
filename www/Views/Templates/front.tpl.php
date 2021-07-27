<!DOCTYPE html>
<html lang="fr">
<head>
	<?= $_::render('incl.style'); ?>
	<?= $_::render('incl.scripts'); ?>
    <title><?= $_SESSION['title'] ?></title>
</head>

<body>
	<?= $_::render('incl.header'); ?>

	<h1>Front template</h1>	

	<main>
		<?php include $this->view; ?>
	</main>

	<?= $_::render('incl.scripts'); ?>
</body>
</html>