<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php
$class = $block->class();
$color = $block->color();
$align = $block->align();
$size = $block->size();

$margin_set = $block->margin_set();
$margin_values = "";
foreach ($margin_set->split() as $margin_value) {
    $margin_values .= " " .$margin_value;
}
$margin_remove = $block->margin();

if($color == "default") {$color = "";} 

?>
<<?= $level = $block->level()->or('h2') ?>
    class="<?= $class ?> <?= $size ?> <?= $color ?> <?= $align ?> <?= $margin_values ?> <?= $margin_remove ?>">
    <?= $block->text() ?>
</<?= $level ?>>