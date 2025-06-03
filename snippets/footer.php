<?php foreach ($site->footer_builder()->toLayouts()->values() as $i => $layout): ?>
<?php
// Prüfen, ob ein Hintergrundbild verwendet werden soll
$useBackgroundImage = $layout->usebackgroundimage()->toBool();
$backgroundImage    = $useBackgroundImage ? $layout->backgroundimage()->toFile() : null;

$class = $layout->class();
$sectioncolor = $layout->sectioncolor()->or('uk-section-default');
$sectionsize = $layout->sectionsize();
$sectionremove = $layout->sectionremove();
$sectionbreite = $layout->sectionbreite();
$sectionexpand = $layout->sectionexpand();

$sectionausrichtung = $layout->sectionausrichtung();
$sectionausrichtung_hori = $layout->sectionausrichtung_hori();
$gutter = $layout->gutter();
$toggle_griddivider = $layout->toggle_griddivider()->toBool();

$usebackgroundimage = $layout->usebackgroundimage()->toBool();
$backgroundImage = $layout->backgroundimage()->toFile();
$backgroundimageat = $layout->backgroundimageat();

$backgroundsize = $layout->backgroundsize();
$backgroundposition = $layout->backgroundposition();
$backgroundblendmode = $layout->backgroundblendmode();
$backgroundfixed = $layout->backgroundfixed()->toBool();
?>

<div class="footer uk-section <?= $class ?> <?= $sectioncolor ?> <?= $sectionsize ?> <?= $sectionremove ?> <?= $backgroundimageat ?> <?php if($backgroundImage): ?>
                uk-background-<?= $backgroundsize ?> <?= $backgroundposition ?> <?= $backgroundblendmode ?><?php if($backgroundfixed): ?> uk-background-fixed<?php endif; ?><?php endif; ?>"
    <?php if ($usebackgroundimage && $backgroundImage): ?> uk-img
    sources="srcset: <?= $backgroundImage->thumb(['width' => 960, 'quality' => 60, 'format' => 'webp'])->url() ?>; media: (max-width: 960px)"
    data-src="<?= $backgroundImage->thumb(['width' => 2500, 'quality' => 80, 'format' => 'webp'])->url() ?>"
    <?php endif; ?>>
    <div class="uk-width-1-1">
        <div
            class="<?php if($sectionbreite != 'remove'): ?>uk-container <?= $sectionbreite ?><?php endif; ?> <?= $sectionexpand ?>">
            <div class="uk-grid uk-flex <?= $sectionausrichtung ?> <?= $sectionausrichtung_hori ?> <?= $gutter ?>  <?php if($toggle_griddivider) { echo "uk-grid-divider";} ?>"
                uk-grid<?= $layout->sameHeight()->isTrue() ? ' uk-height-match="target: .panel"' : '' ?>>
                <?php foreach ($layout->columns() as $column): ?>
                <div class="uk-width-<?= str_replace('/', '-', $column->width()) ?>@l">
                    <div <?php if($sectionexpand == 'uk-container-expand-left' && $column->isFirst()): ?>
                        class="uk-container-item-padding-remove-left"
                        <?php elseif($sectionexpand == 'uk-container-expand-right' && $column->isLast()): ?>
                        class="uk-container-item-padding-remove-right" <?php endif; ?>>

                        <?php foreach($column->blocks() as $block): ?>
                        <?php snippet('blocks/' . $block->type(), ['block' => $block]) ?>
                        <?php endforeach ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php snippet('seo/schemas'); ?>
</body>

</html>