<div class="container" id="page-builder">
    <h2>New page</h2>
    <a href="/admin/pages" class="btn btn-dark">Return without saving</a>
    <?php echo($errors ?? '');?>
    <div class="row">
        <div class="col-18">
            <h3>Page builder</h3>
            <div class="page-builder">
                <div id="editor"></div>
            </div>
        </div>
        <div class="col-6">
            <?php App\Core\FormBuilder::render($pageForm); ?>
        </div>
    </div>
</div>