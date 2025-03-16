<?php
$class = $block->class();
$size = $block->size();
$color = $block->color();
$align = $block->align();

$textstyle = $block->textstyle();
$text = $block->text();

$textcolumns = $block->textcolumns();
$textcolumnsresponsiv = $block->textcolumnsresponsiv()->or('m');

if ($textcolumns->isNotEmpty()) {
    $textcolumnsfinal = $textcolumns . "@" . $textcolumnsresponsiv;
} else {
    $textcolumnsfinal = "";
}

?>

<div class="<?= $class ?> <?= $textcolumnsfinal ?> <?= $size ?> <?= $color ?> <?= $align ?> <?= $textstyle ?>">
    <?= $text ?>
</div>