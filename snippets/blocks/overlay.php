<?php
$ratio = $block->ratio();
$image = $block->image()->toFile();
$image_2 = $block->image_2()->toFile();
$hover_image = $block->hover_image()->toBool();
$transition_image = $block->transition_image()->or('fade');

if ($image) {
    $aspectRatio = 'auto';

    if ($ratio !== 'auto' && strpos($ratio, '/') !== false) {
        list($num, $den) = explode('/', $ratio); // Verhältnis in Zähler und Nenner
        $aspectRatio = "$num / $den";  // Berechnung des Verhältnis-Strings

        // Berechne die Höhe basierend auf dem Verhältnis und der Breite des Bildes
        $newHeight = ($image->width() * $den) / $num;
        
        // Zuschneiden auf das berechnete Verhältnis, runde auf ganze Zahlen
        $newHeight = (int)round($newHeight); // Höhe auf Integer runden
        if ($newHeight > $image->height()) {
            $newWidth = (int)round(($image->height() * $num) / $den); // Breite auf Integer runden
            $image = $image->crop($newWidth, $image->height());
        } else {
            $image = $image->crop($image->width(), $newHeight);
        }
    }
}

$color = $block->color();
$title = $block->title()->html();
$text = $block->text()->kirbytext();
$link = $block->link()->toUrl();
$linkText = $block->link_text()->html();
$style = $block->style()->or('default');
$position = $block->position()->or('center');
$flex_vertical = $block->flex_vertical()->value();
$flex_horizontal = $block->flex_horizontal()->value();
$hover = $block->hover()->toBool();
$transition = $block->transition()->or('fade');
$width = $block->width();
$padding = $block->padding();
$space = $block->space();
?>

<div class="uk-inline-clip <?php if($hover === true) { echo "uk-transition-toggle";} ?> <?= $color ?>">
    <?php if($hover_image === true) { ?>
    <?php if($image_2): ?>
    <img src="<?= $image_2->url() ?>" alt="<?= $image_2->alt() ?>" loading="lazy" class="uk-width-1-1"
        style="width: 100%;; aspect-ratio: <?= $aspectRatio ?>">
    <?php endif; ?>
    <?php } ?>
    <?php if($image): ?>
    <img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>" loading="lazy"
        class="uk-width-1-1 <?= "uk-transition-" . $transition_image ?> <?php if($hover_image === true) { echo "uk-position-cover";} else { echo "uk-transition-opaque";} ?>"
        style="width: 100%; aspect-ratio: <?= $aspectRatio ?>">
    <?php endif; ?>

    <div
        class="uk-overlay <?php if($hover === true) { echo "uk-transition-" . $transition; } ?> uk-position-<?= $position ?> <?= $style ?> <?= $width ?> <?= $padding ?> <?= $space ?> uk-flex <?= $flex_vertical ?> <?= $flex_horizontal ?>">
        <div><?= $block->blocks()->toBlocks(); ?></div>
    </div>
</div>