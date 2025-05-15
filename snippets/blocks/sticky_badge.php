<!-- <div class="buchen-btn uk-background-primary uk-box-shadow-small uk-light"
    style="writing-mode: tb-rl; transform: rotate(-180deg);">
</div> -->

<?php

$text = $block->text()->html();
$class = $block->class()->html();
$style = $block->style()->or('uk-background-default');
$size = $block->size();

$link = $block->link()->toUrl();
$target_blank = $block->target()->toBool();

$icon_toggle = $block->icon_toggle();
$icon = $block->icon()->html();
$icon_align = $block->icon_align();
$icon_show = $block->icon_show()->toBool();

?>
<div class="<?= $class ?> uk-box-shadow-small <?php if($style == "uk-background-default" || $style == "uk-background-muted") { echo "uk-dark";} else { echo "uk-light";} ?> <?= $style ?>"
    style="position: fixed;">
    <a class="<?= $size ?>" href="<?= $link ?>" <?= $target_blank === true ? 'target="_blank"' : '' ?> uk-scroll
        aria-label="<?= $text ?>">
        <?php if($icon_show === true) { ?>
        <?php if($icon_toggle == "only-icon") { ?>
        <span uk-icon="icon: <?= $icon ?>"></span>
        <?php } else { ?>
        <?php if($icon_align == "left") { ?>
        <span uk-icon="icon: <?= $icon ?>" class="uk-margin-small-right"></span>
        <?php } ?>
        <?= $text ?>
        <?php if($icon_align == "right") { ?>
        <span uk-icon="icon: <?= $icon ?>" class="uk-margin-small-left"></span>
        <?php } ?>
        <?php } ?>
        <?php } else { ?>
        <?= $text ?>
        <?php } ?>
    </a>
</div>