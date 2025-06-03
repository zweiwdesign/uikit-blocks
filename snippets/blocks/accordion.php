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

<ul <?= $accordionAttribute ?> <?php if($block->class()->isNotEmpty()) : ?>class="<?= $block->class() ?>"
    <?php endif; ?>>
    <?= $block->blocks()->toBlocks(); ?>
</ul>