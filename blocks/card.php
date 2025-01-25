<?php
// Helper-Funktionen auslagern, mit Absicherung gegen Mehrfachdefinition
if (!function_exists('getCardTypeClass')) {
    function getCardTypeClass($block) {
        $validTypes = ['uk-card-muted', 'uk-card-primary', 'uk-card-secondary'];
        return in_array($block->cardtype(), $validTypes) ? $block->cardtype() : 'uk-card-default';
    }
}

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
$cardType = getCardTypeClass($block);
$linkClass = $block->link()->isNotEmpty() ? 'uk-card-hover' : '';

// Breiten-Klassen basierend auf den Panel-Einstellungen
$mediaWidth = $block->mediaWidth()->isNotEmpty() ? $block->mediaWidth() : '1-3'; // Standard: 1/3
$gridClasses = $block->medialayout() == 'left' || $block->medialayout() == 'right' ? 'uk-grid-collapse' : '';
$mediaPosition = $block->medialayout() == 'right' ? 'uk-flex-last@s' : '';
?>

<div <?= $parallaxSettings ? 'uk-parallax="' . $parallaxSettings . '"' : ''; ?>>
    <?php if ($block->cardlink()->isNotEmpty()): ?>
    <a href="<?= $block->cardlink()->toUrl(); ?>" class="uk-link-reset">
        <?php endif; ?>

        <div class="uk-card <?= $block->cardsize(); ?> <?= $cardType; ?> <?= $linkClass; ?> <?= $gridClasses; ?>"
            <?= $block->medialayout() == 'left' || $block->medialayout() == 'right' ? 'uk-grid' : ''; ?>>

            <?php if ($img = $block->image()->toFile()): ?>
            <div
                class="<?= $block->medialayout() == 'top' ? '' : 'uk-width-' . $mediaWidth . '@s uk-cover-container ' . $mediaPosition; ?>">
                <img src="<?= $img->url(); ?>" width="<?= $img->width(); ?>" height="<?= $img->height(); ?>" alt=""
                    <?= $block->medialayout() == 'left' || $block->medialayout() == 'right' ? 'uk-cover' : ''; ?>>
                <?php if ($block->medialayout() == 'left' || $block->medialayout() == 'right'): ?>
                <canvas width="600" height="400"></canvas>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="uk-width-expand">
                <div class="uk-card-body">
                    <?= $block->blocks()->toBlocks(); ?>
                </div>
            </div>
        </div>

        <?php if ($block->cardlink()->isNotEmpty()): ?>
    </a>
    <?php endif; ?>
</div>