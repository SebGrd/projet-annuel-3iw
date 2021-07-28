<h2 class="ml-1">Vue d'ensemble</h2>

<div class="main flex flex-col justify-between">
	<?php if (isset($session)): ?>
		<?= $_FB::render($form); ?>
		<?= $user->getId(); ?>
	<?php endif; ?>

	<div class="flex flex-wrap justify-center text-center w-100">
        <a href="/admin/pages" class="col flex flex-col justify-center btn btn-primary text-light min-w-20 m-1">
            <h3>Pages</h3>
        </a>
        
        <a href="/admin/products" class="col flex flex-col justify-center btn btn-secondary text-dark min-w-20 m-1">
            <h3>Produits</h3>
        </a>
        
        <a href="/admin/menus" class="col flex flex-col justify-center btn btn-primary text-dark min-w-20 m-1">
            <h3>Menus</h3>
        </a>

        <a href="/admin/orders" class="col flex flex-col justify-center btn btn-secondary text-light min-w-20 m-1">
            <h3>Commandes</h3>
        </a>

        <a href="/admin/stats" class="col flex flex-col justify-center btn btn-primary text-dark min-w-20 m-1">
            <h3>Statistiques</h3>
        </a>
        
        <a href="/admin/users" class="col flex flex-col justify-center btn btn-secondary text-light min-w-20 m-1">
            <h3>Utilisateurs</h3>
        </a>
    </div>
</div>