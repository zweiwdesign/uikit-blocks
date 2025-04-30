<?php
$ausrichtung = $block->ausrichtung();
$ausrichtung_hori = $block->ausrichtung_hori();
$gap = $block->gap();

$width_text = $block->width_text()->or('expand');

$medium = $block->medium();

$icon = $block->icon();
$iconlink = $block->iconlink();
$iconcolor = $block->iconcolor();
$iconsize = $block->iconsize()->toFloat();

$button_padding = $block->buttonPadding()->toInt();
$button_url = $block->button()->toUrl();

$link = $block->link()->toUrl();

$bild = $block->bild()->toFile();

$toggle_textfirst = $block->toggle_textfirst();

$width_icon_m = $block->width_icon_m()->or('uk-width-1-1@m');
?>

<div class="icon-plus uk-margin">
    <div class="uk-grid <?= $ausrichtung ?> <?= $ausrichtung_hori ?> <?= $gap ?>" uk-grid>
        <div class="uk-width-auto@l <?= $width_icon_m ?> uk-width-auto@s">
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
            class="uk-width-<?= $width_text ?> uk-icon-flex-right <?php if($toggle_textfirst == "text-icon") { echo 'uk-flex-first@m';} ?>">
            <?= $block->blocks()->toBlocks(); ?>
        </span>
    </div>
</div>