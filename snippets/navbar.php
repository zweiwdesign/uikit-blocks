<?php
// main menu items
$items = $site->menubuilder()->toStructure();
// rechtliches menu items
?>

<?php foreach ($site->header_builder()->toBlocks() as $block): ?>
<?= $block ?>
<?php endforeach ?>