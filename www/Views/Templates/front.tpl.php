<!DOCTYPE html>
<html lang='en'>
<head>
	<?= $_::render('style'); ?>
    <title>Front template</title>
</head>
<body>
	<?= $_::render('header'); ?>

	<h1>Front template</h1>	

	<main>
		<?php include $this->view; ?>
	</main>

	<?= $_::render('scripts'); ?>
</body>
</html>