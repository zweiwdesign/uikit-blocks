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

<?php
$class = $block->class();
$cardlink = $block->cardlink();
$cardsize = $block->cardsize();
$medialayout = $block->medialayout();

if($cardsize == "normal") {
    $cardsize = "";
}
?>

<div class="<?= $parallaxSettings ? 'uk-position-z-index uk-position-relative ' : '' ?>"
    <?= $parallaxSettings ? 'uk-parallax="' . $parallaxSettings . '"' : ''; ?>>
    <?php if ($cardlink->isNotEmpty()): ?>
    <a href="<?= $cardlink->toUrl(); ?>" class="uk-link-reset">
        <?php endif; ?>

        <div class="<?= $class; ?> uk-card <?= $cardsize; ?> <?= $cardType; ?> <?= $linkClass; ?> <?= $gridClasses; ?>"
            <?= $medialayout == 'left' || $medialayout == 'right' ? 'uk-grid' : ''; ?>>

            <?php if ($img = $block->image()->toFile()): ?>
            <?php
            $thumbLarge = $img->thumb(['width' => 1400, 'format' => 'webp']);
            $thumbMobile = $img->thumb(['width' => 610, 'format' => 'webp']);
            ?>
            <div
                class="<?= $medialayout == 'top' ? '' : 'uk-width-' . $mediaWidth . '@s uk-cover-container ' . $mediaPosition; ?>">
                <picture>
                    <source srcset="<?= $thumbMobile->url(); ?>" media="(max-width: 640px)">
                    <img src="<?= $thumbLarge->url(); ?>" width="<?= $thumbLarge->width(); ?>"
                        height="<?= $thumbLarge->height(); ?>" alt=""
                        <?= $medialayout == 'left' || $medialayout == 'right' ? 'uk-cover' : ''; ?>>
                </picture>
                <?php if ($medialayout == 'left' || $medialayout == 'right'): ?>
                <canvas width="600" height="400"></canvas>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="uk-width-expand">
                <div class="uk-card-body panel">
                    <?= $block->blocks()->toBlocks(); ?>
                </div>
            </div>
        </div>

        <?php if ($cardlink->isNotEmpty()): ?>
    </a>
    <?php endif; ?>
</div>