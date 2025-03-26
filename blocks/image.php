<?php
 
/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$src     = null;
 
$class            = $block->class();
$toggle_align     = $block->toggle_align();
 
if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    if ($ratio == 'auto') {
        $thumbLarge  = $image->thumb(['width' => 1400, 'format' => 'webp']);
        $thumbMobile = $image->thumb(['width' => 610,  'format' => 'webp']);
        $widthLarge = $thumbLarge->width();
        $heightLarge = $thumbLarge->height();
    } else {
        [$wRatio, $hRatio] = explode('/', $ratio);
        $widthLarge  = 1400;
        $heightLarge = intval($widthLarge * ($hRatio / $wRatio));
        $thumbLarge  = $image->thumb(['width' => $widthLarge, 'height' => $heightLarge, 'crop' => true, 'format' => 'webp']);
        
        $widthMobile  = 610;
        $heightMobile = intval($widthMobile * ($hRatio / $wRatio));
        $thumbMobile  = $image->thumb(['width' => $widthMobile, 'height' => $heightMobile, 'crop' => true, 'format' => 'webp']);
    }
    $src = $thumbLarge->url();
}
 
?>
<?php if ($src): ?>
<figure role="group"
    class="<?= $class ?> <?php if($toggle_align == "center") { echo "uk-flex uk-flex-center@m";} else if ($toggle_align == "right") { echo "uk-flex uk-flex-right@m";} ?>">
    <?php if ($link->isNotEmpty()): ?>
    <a href=" <?= Str::esc($link->toUrl()) ?>">
        <picture>
            <source media="(max-width: 610px)" srcset="<?= $thumbMobile->url() ?>">
            <img src="<?= $src ?>" alt="<?= $alt ?>" <?php if (!empty($isfirstLayout)): ?>loading="eager"
                <?php else: ?>loading="lazy" <?php endif; ?>
                <?php if(isset($widthLarge) && isset($heightLarge)): ?>width="<?= $widthLarge ?>"
                height="<?= $heightLarge ?>" <?php endif; ?> <?= empty($alt) ? 'aria-hidden="true"' : '' ?>>
        </picture>
    </a>
    <?php else: ?>
    <picture>
        <source media="(max-width: 610px)" srcset="<?= $thumbMobile->url() ?>">
        <img src="<?= $src ?>" alt="<?= $alt ?>" <?php if (!empty($isfirstLayout)): ?>loading="eager"
            <?php else: ?>loading="lazy" <?php endif; ?>
            <?php if(isset($widthLarge) && isset($heightLarge)): ?>width="<?= $widthLarge ?>"
            height="<?= $heightLarge ?>" <?php endif; ?> <?= empty($alt) ? 'aria-hidden="true"' : '' ?>>
    </picture>
    <?php endif ?>

    <?php if ($caption->isNotEmpty()): ?>
    <figcaption>
        <?= $caption ?>
    </figcaption>
    <?php endif ?>
</figure>
<?php endif ?>