<main class="auth y-scroll-auto">
    <div class="flex flex-xs-col flex-sm-row align-center w-100 h-full">
        <div class="col-sm-14 flex flex-col justify-center bg-primary text-light w-100 h-100">
            <h1 class="text-center text-light">Installation</h1>
            <p class="text-center text-light">
				Bienvenue ! Configurez votre site en complétant les détails suivants.
            </p>
        </div>
        
        <div class="col-sm-10 flex flex-col justify-center w-100 h-100">
            <section class="flex flex-col align-center">
                <div class="flex flex-col justify-center align-center w-100">
                    <h2>Configuration</h2>

                    <!-- Show messages -->
                    <?= $_::render('incl.message', ['msgs' => ['SETUP_STEP1_SUCCESS', 'SETUP_STEP1_ERROR', 'SETUP_STEP2_SUCCESS', 'SETUP_STEP2_ERROR', 'SETUP_STEP3_SUCCESS', 'SETUP_STEP3_ERROR'], 'errs' => $errors ?? []]); ?>

                    <?= $_FB::render($form) ?>
                </div>
            </section>
        </div>
    </div>
</main>*
