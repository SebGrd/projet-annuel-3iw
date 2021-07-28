<!-- Show list of messages if `$msgs` and/or `$errs` isn't empty -->
<ul class="flex justify-center list-none text-center w-100 auth__section__form__list">
	<!-- For each message -->
	<?php foreach ($msgs as $msg): ?>
		<!-- If it exists -->
		<?php if ($_SS::exist($msg)): ?>
			<li class="col-24 <?= $_SS::load($msg)['class']; ?>">
				<!-- Show it then unset it right after so it disappears after a refresh -->
				<?= $_SS::flash($msg)['text']; ?>
			</li>
			
			<?php unset($msgs[$msg]); ?>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>

<ul class="flex justify-center list-none text-center w-100 auth__section__form__list" style="display: <?= empty($errs) ? 'none' : 'block' ?>">
	<?php if (isset($errs)): ?>
		<?php foreach ($errs as $err): ?>
			<li class="col text-danger">
				<?= $err; ?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>