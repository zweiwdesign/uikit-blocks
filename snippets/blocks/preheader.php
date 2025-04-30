<?php
$visible = $block->visible();
?>

<div class="<?= $visible ?>" role="region" aria-label="Aktueller Hinweis">
    <div class="preheader">
        <?php foreach ($block->preheader()->toBlocks() as $block): ?>
        <?= $block ?>
        <?php endforeach ?>
    </div>
</div>