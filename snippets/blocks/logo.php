<?php
$image          = $block->image()->toFile();
$width          = $block->width()->toInt();

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

?>
<a href="<?= url('home') ?>" uk-scroll aria-label="Back to Home Link"
    class="uk-navbar-item uk-logo <?= $block->class() ?>">
    <img src="<?= $image->url() ?>" alt="Logo <?= $site->title() ?>" loading="eager"
        <?php if(isset($widthLarge) && isset($heightLarge)): ?>width="<?= $widthLarge ?>" height="<?= $heightLarge ?>"
        <?php endif; ?>>
</a>