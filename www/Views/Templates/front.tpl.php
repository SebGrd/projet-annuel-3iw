<!DOCTYPE html>
<html lang="fr">

<head>
	<title><?= $_SESSION['title'] ?></title>
	<?= $_::render('incl.style-front'); ?>
</head>
<body>
    <?= $_::render('incl.header'); ?>
    <main>
        <?php include $this->view; ?>
    </main>
    <?= $_::render('incl.scripts'); ?>
</body>
</html>