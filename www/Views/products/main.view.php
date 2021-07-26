<div class="">
	<div class="flex justify-between align-center">
		<h2>Produits</h2>
		<a href="/admin/product/new" class="btn btn-primary">Ajouter un produit</a>
	</div>
	
	<?php $_TB::render(\App\Models\Product::class, [], ['createdAt'=>'DESC']) ?>
</div>