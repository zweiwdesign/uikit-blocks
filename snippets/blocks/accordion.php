<?php
$accordionAttribute = 'uk-accordion="';
$settings = [];

if ($block->toggle_nocollapsing()->toBool() === true) {
    $settings[] = 'collapsible: false';
}
if ($block->toggle_multipleopen()->toBool() === true) {
    $settings[] = 'multiple: true';
}

$accordionAttribute .= implode('; ', $settings);
$accordionAttribute .= '"';
?>

<ul <?= $accordionAttribute ?>>
    <?= $block->blocks()->toBlocks(); ?>
</ul>