<!DOCTYPE html>
<html lang='en'>
<head>
    <!-- <?= $_::render('incl.style'); ?> -->
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='cms restaurant'>
    <link rel="stylesheet" href="/public/style/boostrip.css">
    <link rel="stylesheet" href="/public/style/style.css">

    <title><?= $_SESSION['title'] ?></title>
</head>
<body>
<?php include $this->view ;?>
</body>
</html>