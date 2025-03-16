<?php
$ausrichtung = $block->ausrichtung();
$gap = $block->gap();

$medium = $block->medium();

$icon = $block->icon();
$iconlink = $block->iconlink();
$iconcolor = $block->iconcolor();
$iconsize = $block->iconsize()->toFloat();

$button_padding = $block->buttonPadding()->toInt();
$button_url = $block->button()->toUrl();

$link = $block->link()->toUrl();

$bild = $block->bild()->toFile();

$toggle_textfirst = $block->toggle_textfirst()->toBool();
?>

<div class="icon-plus uk-margin">
    <div class="uk-grid <?= $ausrichtung ?> <?= $gap ?>" uk-grid>
        <div class="uk-width-auto@l uk-width-1-1@m uk-width-auto@s">
            <?php if($medium == "icon"): ?>
            <a class="<?= $iconlink?>" <?php if($iconlink == "uk-icon-button") { ?> style="color: <?= $iconcolor ?> !important; 
                    width: <?=(20 * $iconsize) + $button_padding; ?>px; 
                    height: <?=(20 * $iconsize) + $button_padding; ?>px"
                <?php } else if ($iconlink == "uk-link-reset"){ ?> style="cursor: default !important; 
                    color: <?= $iconcolor ?> !important;" <?php } else { ?>
                style="color: <?= $iconcolor ?> !important;" <?php } ?>
                href="<?php if($iconlink == "uk-icon-link") { echo $link; } else if($iconlink == "uk-icon-button") { echo $button_url; } ?>"
                uk-icon="icon: <?= $icon ?>; ratio: <?= $iconsize ?>"></a>
            <?php else: ?>
            <?php if($iconlink != "uk-link-reset"): ?><a class="<?= $iconlink ?>"
                <?php if($iconlink == "uk-icon-button"){ ?> style="width: <?=(20 * $iconsize) + $button_padding;
                ?>px; height: <?=(20 * $iconsize) + $button_padding;
                ?>px; padding: <?= $button_padding;
                ?>px" <?php } ?>
                href="<?php if($iconlink == "uk-icon-link") { echo $link; } else if($iconlink == "uk-icon-button") { echo $button_url; } ?>"><?php endif; ?><img
                    class="uk-icon" src="<?= $bild->url() ?>" width="<?= 20 * $iconsize; ?>"
                    height="<?= 20 * $iconsize; ?>"
                    alt="<?= $bild->alt() ?>"><?php if($iconlink != "none"): ?></a><?php endif; ?>
            <?php endif; ?>
        </div>
        <span
            class="uk-width-expand uk-icon-flex-right <?php if($toggle_textfirst === true) { echo 'uk-flex-first@m';} ?>">
            <?= $block->blocks()->toBlocks(); ?>
        </span>
    </div>
</div>