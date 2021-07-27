<h2 class="ml-1">Vue d'ensemble</h2>

<div class="main flex flex-col justify-between">
	<?php if (isset($session)): ?>
		<?= $_FB::render($form); ?>
		<?= $user->getId(); ?>
	<?php endif; ?>

	<div class="flex mr-4 text-center">
        <a href="/admin/pages" class="col-12 m-1 btn btn-primary text-light flex flex-col justify-center">
            <h1>Pages</h1>
        </a>
        
        <a href="/admin/products" class="col-12 m-1 btn btn-secondary text-dark flex flex-col justify-center">
            <h1>Produits</h1>
        </a>
    </div>

	<div class="flex mr-4 text-center">
        <a href="/admin/menus" class="col-12 m-1 btn btn-secondary text-dark flex flex-col justify-center">
            <h1>Menus</h1>
        </a>
        
        <a href="/admin/orders" class="col-12 m-1 btn btn-primary text-light flex flex-col justify-center">
            <h1>Commandes</h1>
        </a>
    </div>

	<div class="flex mr-4 text-center">
        <a href="/admin/stats" class="col-12 m-1 btn btn-primary text-dark flex flex-col justify-center">
            <h1>Statistiques</h1>
        </a>
        
        <a href="/admin/users" class="col-12 m-1 btn btn-secondary text-light flex flex-col justify-center">
            <h1>Utilisateurs</h1>
        </a>
    </div>
</div>