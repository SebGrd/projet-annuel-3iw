<?php if (isset($username)) { ?>
	<section>
		<h2>Home view</h2>
		<h3>Welcome <?= $username;?></h3>
		<small>Age: <?= $age;?><br>Email: <?= $email ?></small>
	</section>
<?php } else { ?>
	No data:
<?php } ?>