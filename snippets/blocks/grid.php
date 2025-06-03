<?php
$slider = $block->slider()->toBool();
$layout = $block->layout();
$class = $block->class();

$sameHeight = $block->sameHeight()->toBool();
$toggle_griddivider = $block->toggle_griddivider()->toBool();
$toggle_masonry = $block->toggle_masonry()->toBool();
$gutter = $block->gutter();
$align = $block->align();
$align_vertikal = $block->align_vertikal();

$navigation_visibility = $block->navigation_visibility()->or('uk-hidden-hover');
$dotnav_visibility = $block->dotnav_visibility()->or('immer');
$navigation_mode = $block->navigation_mode()->or('uk-dark');
$navigation_position = $block->navigation_position()->or('aussen');

$infinite = $block->infinite_scrolling()->toBool() ? 'false' : 'true';
$autoplay = $block->autoplay()->toBool();

$blocks = $block->content()->content()->toBlocks();

$gap = $block->gap()->toBool();
$center = $block->center()->toBool();
$sets = $block->sets()->toBool();

$child_width = $block->layout()->value();
$child_width_s = $block->child_width_s()->value();
$child_width_m = $block->child_width_m()->value();
$child_width_l = $block->child_width_l()->value();


if($gap) {
    $gapAttribute = "uk-grid uk-grid-match";
} else {
    $gapAttribute = "";
}

$slideshowOptions = [];
if ($autoplay) {
    $slideshowOptions[] = 'autoplay: true';
}
if (!$infinite) {
    $slideshowOptions[] = 'finite: true';
}
if ($center) {
    $slideshowOptions[] = 'center: true';
}
if ($sets) {
    $slideshowOptions[] = 'sets: true';
}
    
// String für uk-slideshow bauen
$sliderAttribute = '';
if (!empty($slideshowOptions)) {
    $sliderAttribute = '="' . implode('; ', $slideshowOptions) . '"';
}
?>

<?php if($slider === false): ?>
<div uk-grid<?php if($toggle_masonry) {echo "='masonry: pack'";} ?>
    class="<?= $class ?> uk-grid <?= $align ?> <?= $child_width ?> <?= e($child_width_s !== "default", $child_width_s) ?> <?= e($child_width_m !== "default", $child_width_m) ?> <?= e($child_width_l !== "default", $child_width_l) ?> <?= $gutter ?> <?php if($toggle_griddivider) {echo "uk-grid-divider";} ?>"
    <?= $sameHeight ? 'uk-height-match=" .panel"': '' ?>>
    <?php foreach($blocks as $content_block): ?>
    <div class="">
        <?php snippet('blocks/' . $content_block->type(), ['block' => $content_block]) ?>
    </div>
    <?php endforeach ?>
</div>

<?php else: ?>
<div uk-slider<?= $sliderAttribute ?>>
    <div class="uk-position-relative <?php if($navigation_position == "aussen") { echo "uk-visible-toggle"; } ?>">
        <div class="uk-slider-container <?= $navigation_mode ?>">
            <div class="uk-slider-items <?= $child_width ?> <?= e($child_width_s !== "default", $child_width_s) ?> <?= e($child_width_m !== "default", $child_width_m) ?> <?= e($child_width_l !== "default", $child_width_l) ?> <?= $gapAttribute ?> <?= $gutter ?> <?= $align_vertikal ?>"
                <?= $sameHeight ? 'uk-height-match=" .panel"': '' ?>>
                <?php foreach($blocks as $content_block): ?>
                <div class="">
                    <?php snippet('blocks/' . $content_block->type(), ['block' => $content_block]) ?>
                </div>
                <?php endforeach ?>
            </div>
        </div>

        <?php if($navigation_position == "aussen") :?>
        <div class="uk-hidden@m"> <?php endif; ?>
            <a class="uk-position-center-left <?= $navigation_mode ?> uk-position-small <?= $navigation_visibility ?>"
                href uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right <?= $navigation_mode ?> uk-position-small <?= $navigation_visibility ?>"
                href uk-slidenav-next uk-slider-item="next"></a>
            <?php if($navigation_position == "aussen") :?>
        </div>

        <div class="uk-visible@m <?= $navigation_mode ?>">
            <a class="uk-position-center-left-out uk-position-small" href uk-slidenav-previous
                uk-slider-item="previous"></a>
            <a class="uk-position-center-right-out uk-position-small" href uk-slidenav-next uk-slider-item="next"></a>
        </div> <?php endif; ?>
    </div>
    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin <?= $dotnav_visibility ?>"></ul>
</div>
<?php endif; ?>