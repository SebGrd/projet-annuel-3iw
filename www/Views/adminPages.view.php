<div class="container">
    <h2>Pages</h2>
    <?php echo($debug ?? '');?>
    <?php echo($errors ?? '');?>
    <div class="row">
        <div class="col-18">
            <h3>Page builder</h3>
            <div class="page-builder">
                <div class="page-builder__tools">
                    <ul class="page-builder__tools__list">
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-reset" class="page-builder__tools__list__item__tool">Reset</button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-bold" class="page-builder__tools__list__item__tool"><b>Bold</b></button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-italic" class="page-builder__tools__list__item__tool"><i>Italic</i></button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-link" class="page-builder__tools__list__item__tool"><u>Link</u></button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-image" class="page-builder__tools__list__item__tool">Image</button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-h1" class="page-builder__tools__list__item__tool">h1</button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-h2" class="page-builder__tools__list__item__tool">h2</button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-h3" class="page-builder__tools__list__item__tool">h3</button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-h4" class="page-builder__tools__list__item__tool">h4</button>
                        </li>
                        <li class="page-builder__tools__list__item">
                            <button id="editor-action-h5" class="page-builder__tools__list__item__tool">h5</button>
                        </li>
                    </ul>
                    <button class="page-builder__tools__list__item__tool">html</button>
                </div>
                <div class="page-builder__editor">
                    <div class="page-builder__editor__wysiwyg" contenteditable></div>
                    <textarea class="page-builder__editor__html d-none" name="html-editor" id="html-editor" rows="20"></textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            <?php App\Core\FormBuilder::render($pageForm); ?>
        </div>
    </div>
</div>