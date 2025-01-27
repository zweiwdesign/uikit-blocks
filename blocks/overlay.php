<?php
$image = $block->image()->toFile();
$title = $block->title()->html();
$text = $block->text()->kirbytext();
$link = $block->link()->toUrl();
$linkText = $block->link_text()->html();
$style = $block->style()->or('default');
$position = $block->position()->or('center');
$width = $block->width();
$padding = $block->padding();
$space = $block->space();
?>

<div class="uk-inline-clip">
    <?php if($image): ?>
    <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>" class="uk-width-1-1">
    <?php endif; ?>

    <div class="uk-overlay uk-position-<?= $position ?> <?= $style ?> <?= $width ?> <?= $padding ?> <?= $space ?>">
        <?= $block->blocks()->toBlocks(); ?>
    </div>
</div>