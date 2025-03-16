<p uk-margin class="<?= $block->align() ?>">
    <?php foreach ($block->blocks()->toBlocks() as $item): ?>
    <?= $item ?>
    <?php endforeach ?>
</p>