<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php
$color = $block->color();

if($color == "default") {$color = "";} 

?>
<<?= $level = $block->level()->or('h2') ?>
    class="<?= $block->class() ?> <?= $block->size() ?> <?= $color ?> <?= $block->align() ?> <?= $block->margin() ?> <?php if($block->margin() == "uk-margin-remove-bottom" || $block->margin() == ""): ?>uk-margin-top<?php endif; ?>">
    <?= $block->text() ?>
</<?= $level ?>>