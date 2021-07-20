<div class="admin_view">
  <section>
	<h2>Edition du produit : <?= $product->getName() ?></h2>
  </section>

  <div class="">
	<?php if (isset($success)): ?>
	  <li style="color: green;">
		<?= $success; ?>
	  </li>
	<?php endif; ?>
	<?php if (isset($errors)): ?>
	  <ul class="auth__section__form__list">
		<?php foreach ($errors as $error): ?>
		  <li style="color: red;">
			<?= $error; ?>
		  </li>
		<?php endforeach; ?>
	  </ul>
	<?php endif; ?>

	<?php if($product->getImage() !== null): ?>
	  <img src="../<?= $_::getImageUrl($product->getImage()) ?>" style="max-width: 100%; max-height: 150px;">
	<?php endif; ?>
	<?php $_FB::render($form); ?>
	<a type="button" href='/admin/products'>Retour</a>
  </div>
</div>