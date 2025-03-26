<?php

$text = $block->text()->html();
$style = $block->style();
$size = $block->size();
$breite = $block->breite()->toBool();

$link = $block->link()->toUrl();
$target_blank = $block->target()->toBool();

$icon_toggle = $block->icon_toggle();
$icon = $block->icon()->html();
$icon_align = $block->icon_align()->toBool();
$icon_show = $block->icon_show()->toBool();
?>

<a class="uk-button <?php if($style->isNotEmpty()) { echo $style; } else { echo "uk-button-default"; } ?> <?= $size ?> <?php if($breite === true) { echo 'uk-width-1-1'; } ?>"
    href="<?= $link ?>" <?= $target_blank === true ? 'target="_blank"' : '' ?> uk-scroll aria-label="<?= $text ?>">
    <?php if($icon_show === true) { ?>
    <?php if($icon_toggle == "only-icon") { ?>
    <span uk-icon="icon: <?= $icon ?>"></span>
    <?php } else { ?>
    <?php if($icon_align === false) { ?>
    <span uk-icon="icon: <?= $icon ?>" class="uk-margin-small-right"></span>
    <?php } ?>
    <?= $text ?>
    <?php if($icon_align === true) { ?>
    <span uk-icon="icon: <?= $icon ?>" class="uk-margin-small-left"></span>
    <?php } ?>
    <?php } ?>
    <?php } else { ?>
    <?= $text ?>
    <?php } ?>
</a>