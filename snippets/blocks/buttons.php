<div uk-grid class="uk-margin <?= $block->class() ?> <?= $block->align() ?> uk-grid-small uk-flex uk-child-width-auto">
    <?php foreach ($block->blocks()->toBlocks() as $item): ?>
    <?= $item ?>
    <?php endforeach ?>
</div>