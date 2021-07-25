<!-- Show list of messages if `$msgs` and/or `$errs` isn't empty -->
<ul class="auth__section__form__list">
	<!-- For each message -->
	<?php foreach ($msgs as $msg): ?>
		<!-- If it exists -->
		<?php if ($_SS::exist($msg)): ?>
			<li class="<?= $_SS::load($msg)['class']; ?>">
				<!-- Show it then unset it right after so it disappears after a refresh -->
				<?= $_SS::flash($msg)['text']; ?>
			</li>
			
			<?php unset($msgs[$msg]); ?>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>

<ul class="auth__section__form__list" style="display: <?= empty($errs) ? 'none' : 'block' ?>">
	<!--  -->
	<?php if (isset($errs)): ?>
		<?php foreach ($errs as $err): ?>
			<li style="color: red;">
				<?= $err; ?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>