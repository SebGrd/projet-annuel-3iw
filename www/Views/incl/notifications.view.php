<?php if (empty($msgs) && empty($errs)): ?>
	<li class="flex">
		<span class="w-max text-secondary">
			Aucune notification
		</span>
	</li>
<?php else: ?>
	<!-- For each message -->
	<?php foreach ($msgs as $msg): ?>
		<!-- If it exists -->
		<?php if ($_SS::exist($msg)): ?>
			<!-- <li class="header__menu__popup-menu__item "> -->
			<li class="flex">
				<span class="col-4 text-secondary">
					<?= date('H:i') ?>
				</span>
				
				<!-- Show it then unset it right after so it disappears after a refresh -->
				<span class="col-18 <?= $_SS::load($msg)['class'] ?>">
					<?= $_SS::flash($msg)['text'] ?>
				</span>
			</li>
			
			<?php unset($msgs[$msg]); ?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
<!-- Show errors -->
<?php if (isset($errs)): ?>
	<?php foreach ($errs as $err): ?>
		<li style="color: red;">
			<?= $err; ?>
		</li>
	<?php endforeach; ?>
<?php endif; ?>