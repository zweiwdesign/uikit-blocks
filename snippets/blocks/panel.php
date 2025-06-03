<?php
$class              = $block->class();
$image              = $block->image()->toFile();
$minheight          = $block->minheight()->or('0');
$blocks             = $block->blocks()->toBlocks();

$background         = $block->background();
$flex_vertical      = $block->flex_vertical()->value();
$padding            = $block->padding();
?>

<div class="uk-width-1-1 uk-height-1-1 <?= $class ?> <?= $background ?> uk-flex <?= $flex_vertical ?> <?php if($image): ?>uk-background-cover<?php endif; ?>"
    style="min-height: <?= $minheight ?>px; <?php if($image): ?>background-image: url(<?= $image->url() ?>); <?php endif; ?>">
    <div class="<?= $padding ?>">
        <div><?= $blocks ?></div>
    </div>

</div>