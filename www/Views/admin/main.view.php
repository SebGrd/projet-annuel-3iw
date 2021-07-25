<section>
	<h2>Dashboard</h2>
</section>

<div class="main flex flex-col justify-between">
	<?php if (isset($session)): ?>
		<?= $_FB::render($form); ?>
		<?= $user->getId(); ?>
	<?php endif; ?>

	<div class="row text-center p-2">
        <div class="col-12 bg-primary text-light flex flex-col justify-center m-1">
            <h1 class="">A</h1>
        </div>
        
        <div class="col-12 bg-secondary text-dark flex flex-col justify-center m-1">
            <h1 class="">B</h1>
        </div>
    </div>

	<div class="row text-center p-2">
        <div class="col-12 bg-secondary text-dark flex flex-col justify-center m-1">
            <h1 class="">C</h1>
        </div>
        
        <div class="col-12 bg-primary text-light flex flex-col justify-center m-1">
            <h1 class="">D</h1>
        </div>
    </div>
</div>