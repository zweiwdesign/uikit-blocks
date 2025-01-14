
<?php
// Überprüfen, ob ein Bild ausgewählt wurde
if ($image = $block->image()->toFile()):

    // Angegebene Breite verwenden oder Standardwert
    $width = $block->width()->isNotEmpty() ? $block->width()->toInt() : 800;

    // Alternativen Text
    $alt = $block->alt()->isNotEmpty() ? $block->alt()->html() : $image->alt()->html();

    // Thumbnail erstellen
    $thumb = $image->thumb([
        'width'  => $width*2,
        'format' => 'webp', // Optional, wenn du WebP verwenden möchtest
    ]);

    // Bild-Tag erstellen
    echo '<img width="' . $width . '" src="' . $thumb->url() . '" alt="' . $alt . '" loading="lazy">';
endif;
?>