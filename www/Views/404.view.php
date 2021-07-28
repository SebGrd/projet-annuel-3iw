<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center h-full w-100">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
			<h1 class="text-center text-danger">Erreur <?= $code ?? '404' ?></h1>
			<p class="text-center text-light"><?= $error ?></p>
		</div>

		<div class="col-sm-10 flex flex-col justify-center w-100 h-100">
			<section class="flex flex-col align-center">
				<div class="flex flex-col justify-center align-center text-center w-100">
					<h2 class="text-center text-danger">Oops !</h2>
					<div>Il semblerait qu'une erreur soit survenue.</div>

					<div class="flex align-center justify-around text-center btn-font w-100 mt-1 form__field">
						<a href="/" class="col btn btn-secondary">
							Retour à la page d'accueil
						</a>
					</div>
				</div>
			</section>
		</div>
	</div>
</main>