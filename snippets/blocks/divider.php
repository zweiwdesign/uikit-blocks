<?php 
$dividertype = $block->dividertype();
$dividerausrichtung = $block->dividerausrichtung();
?>
<?php if ($dividertype == 'uk-divider'): ?>
<hr <?php if($block->class()->isNotEmpty()): ?>class="<?= $block->class() ?>" <?php endif; ?>>
<?php else: ?>
<hr class="<?= $block->class() ?><?= $dividertype ?> <?= $dividerausrichtung ?>">
<?php endif ?>