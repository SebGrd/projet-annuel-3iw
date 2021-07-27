<!DOCTYPE html>
<html lang='en'>
<head>
	<?= $_::render('incl.style'); ?>
    <title>Front template</title>
</head>
<body>
	<?= $_::render('incl.header'); ?>

	<main>
		<?php include $this->view; ?>
	</main>
    <?= $_::render('incl.footer'); ?>
	<?= $_::render('incl.scripts'); ?>
</body>
</html>