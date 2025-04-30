<?php 
$dividertype = $block->dividertype();
$dividerausrichtung = $block->dividerausrichtung();
?>
<?php if ($dividertype == 'uk-divider'): ?>
<hr>
<?php else: ?>
<hr class="<?= $dividertype ?> <?= $dividerausrichtung ?>">
<?php endif ?>