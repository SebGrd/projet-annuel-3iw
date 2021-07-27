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

	<div class="page-wrapper">
		<main class="menu y-scroll-auto">
			<?php include $this->view; ?>
		</main>
	</div>
</body>

</html>