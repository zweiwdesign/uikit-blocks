<?php

if (!function_exists('getParallaxSettings')) {
    function getParallaxSettings($block) {
        $parallax = '';

        // Vertikale Bewegung
        if ($block->paraY()->isNotEmpty()) {
            $yEnd = $block->paraYend()->isNotEmpty() ? $block->paraYend() : $block->paraY();
            $parallax .= 'y: ' . $block->paraY() . ', ' . $yEnd;
        }

        // Horizontale Bewegung
        if ($block->paraX()->isNotEmpty()) {
            $xEnd = $block->paraXend()->isNotEmpty() ? $block->paraXend() : $block->paraX();
            $parallax .= ($parallax ? '; ' : '') . 'x: ' . $block->paraX() . ', ' . $xEnd;
        }

        // Opacity, Scale, Rotate und Blur Effekte
        $effects = ['opacity', 'scale', 'rotate', 'blur'];
        foreach ($effects as $effect) {
            $start = "para" . ucfirst($effect) . "Start";
            $end = "para" . ucfirst($effect) . "End";
            if ($block->$start()->isNotEmpty()) {
                $effectEnd = $block->$end()->isNotEmpty() ? $block->$end() : $block->$start();
                $parallax .= ($parallax ? '; ' : '') . $effect . ': ' . $block->$start() . ', ' . $effectEnd;
            }
        }

        // Dynamischer Breakpoint
        $breakpoint = $block->parallaxBreakpoint()->isNotEmpty() ? $block->parallaxBreakpoint() : null;
        return $parallax ? $parallax . ($breakpoint ? '; media: ' . $breakpoint : '') : '';
    }
}

$parallaxSettings = getParallaxSettings($block);

/** @var \Kirby\Cms\Block $block */
$alt     = $block->alt();
$caption = $block->caption();
$link    = $block->link();

$width   = $block->width()->toInt();
$ratio   = $block->ratio()->or('auto');
$src     = null;
 
$class            = $block->class();
$toggle_align     = $block->toggle_align();
 
if ($block->location() == 'web') {
    $src = $block->src()->esc();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt->or($image->alt());
    if ($ratio == 'auto') {
        if ($width === 0) {
            $widthLarge  = 1400;
            $widthMobile = 610;
        } else {
            $widthLarge  = $width;
            $widthMobile = $width;
        }

        // Höhe dynamisch basierend auf dem Seitenverhältnis des Originalbildes setzen
        $heightLarge = intval($image->height() * ($widthLarge / $image->width()));
        $heightMobile = intval($image->height() * ($widthMobile / $image->width()));

        $thumbLarge  = $image->thumb(['width' => $widthLarge, 'height' => $heightLarge, 'format' => 'webp']);
        $thumbMobile = $image->thumb(['width' => $widthMobile, 'height' => $heightMobile, 'format' => 'webp']);
        
    } else {
        [$wRatio, $hRatio] = explode('/', $ratio);

        if($width === 0) {
            $widthLarge  = 1400;
            $widthMobile  = 610;
        } else {
            $widthLarge  = $width;
            $widthMobile  = $width;
        }
        
        $heightLarge = intval($widthLarge * ($hRatio / $wRatio));
        $thumbLarge  = $image->thumb(['width' => $widthLarge, 'height' => $heightLarge, 'crop' => true, 'format' => 'webp']);
        
        
        $heightMobile = intval($widthMobile * ($hRatio / $wRatio));
        $thumbMobile  = $image->thumb(['width' => $widthMobile, 'height' => $heightMobile, 'crop' => true, 'format' => 'webp']);
    }
    $src = $thumbLarge->url();
}

?>
<?php if ($src): ?>
<figure role="group"
    class="uk-margin-remove <?= $parallaxSettings ? 'uk-position-z-index uk-position-relative ' : '' ?><?= $class ?> <?php if($toggle_align == "center") { echo "uk-flex uk-flex-center@m";} else if ($toggle_align == "right") { echo "uk-flex uk-flex-right@m";} ?>"
    <?= $parallaxSettings ? 'uk-parallax="' . $parallaxSettings . '"' : ''; ?>>
    <?php if ($link->isNotEmpty()): ?>
    <a href=" <?= Str::esc($link->toUrl()) ?>" uk-scroll>
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