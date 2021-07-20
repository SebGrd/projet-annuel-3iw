<header>
	<nav class="navigation">
		<ul class="menu-main">
			<li class="menu-main-item">
				<a href="/" class="menu-main-item-link">Accueil</a>
			</li>

			<!-- Show login and register links for guests -->
			<?php if (!$_S::isConnected()): ?>
				<li class="menu-main-item">
					<a href="/login" class="menu-main-item-link">Connexion</a>
				</li>

				<li class="menu-main-item">
					<a href="/register" class="menu-main-item-link">Inscription</a>
				</li>
			<?php endif; ?>

			<!-- Show admin link for admins -->
			<?php if ($_S::isAdmin()): ?>
				<li class="menu-main-item">	
					<a href="/admin" class="menu-main-item-link">Dashboard</a>
				</li>
			<?php endif; ?>

			<!-- Show profile and logout links for any user -->
			<?php if ($_S::isConnected()): ?>
				<li class="menu-main-item">
					<a href="<?= $_S::isAdmin() ? '/admin' : '' ?>/profile" class="menu-main-item-link">Profil</a>
				</li>

				<li class="menu-main-item">
					<a href="/logout" class="menu-main-item-link">Déconnexion</a>
				</li>
			<?php endif; ?>
		</ul>
	</nav>
</header>