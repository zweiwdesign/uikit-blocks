<div class="<?= $block->align() ?>">
    <a class="uk-button <?= $block->class() ?>" href="<?= $block->link()->toUrl() ?>"
        <?= $block->target()->toBool() === true ? 'target="_blank"' : '' ?>>
        <?= $block->text()->html() ?>
    </a>
</div>