<?php
$margin_values = "";
$margin_set = $block->margin_set();
foreach ($margin_set->split() as $margin_value) {
    $margin_values .= " " .$margin_value;
}

$textcolumns = $block->textcolumns();
$textcolumnsresponsiv = $block->textcolumnsresponsiv()->or('m');

if ($textcolumns->isNotEmpty()) {
    $textcolumnsfinal = $textcolumns . "@" . $textcolumnsresponsiv;
} else {
    $textcolumnsfinal = "";
}

$classes = [
    $block->class() ?? '',
    $textcolumnsfinal ?? '',
    $block->size() ?? '',
    $block->color() ?? '',
    $block->align() ?? '',
    $block->textstyle() ?? '',
    $margin_values ?? '',
    $block->margin() ?? '',
];

// Entferne leere oder nur aus Leerzeichen bestehende Einträge
$classes = array_filter($classes, 'trim');

$classString = implode(' ', $classes);

?>

<div class="<?= $classString ?>">
    <?= $block->text() ?>
</div>