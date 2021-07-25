<div class="container">
  <title>Setup</title>
  
  <section>
    <h1>Configuration</h1>
  </section>
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
  
  <?php App\Core\FormBuilder::render($form); ?>
</div>
