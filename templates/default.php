<?php snippet('header') ?>
<main uk-height-viewport="expand: true">
    <?php foreach ($page->baselayout()->toLayouts() as $layout): ?>
    <?php
    // Prüfen, ob ein Hintergrundbild verwendet werden soll
    $useBackgroundImage = $layout->usebackgroundimage()->toBool();
    $backgroundImage = $useBackgroundImage ? $layout->backgroundimage()->toFile() : null;
    ?>
    <div class="uk-section uk-flex <?= $layout->sectionflex() ?> <?= $layout->backgroundimageat() ?> <?= $layout->sectionsize() ?> <?= $layout->sectionremove() ?> <?= $layout->sectioncolor() ?> <?= $layout->class() ?>
        <?php if($backgroundImage): ?>
            uk-background-<?= $layout->backgroundsize() ?> <?= $layout->backgroundposition() ?> <?= $layout->backgroundblendmode() ?>
            <?php if($layout->backgroundfixed()->toBool()): ?> uk-background-fixed<?php endif; ?>
        <?php endif; ?>" <?php if($backgroundImage): ?> uk-img
        sources="srcset: <?= $backgroundImage->thumb(['width' => 960, 'quality' => 60, 'format' => 'webp'])->url() ?>; media: (max-width: 960px)"
        data-src="<?= $backgroundImage->thumb(['width' => 2500, 'quality' => 80, 'format' => 'webp'])->url() ?>"
        <?php endif; ?>
        <?php if($layout->sectionsize() == "vh"): ?>uk-height-viewport="<?php if($layout->sectionvhoffset() == "true"): ?>offset-top: true;<?php endif ?> offset-bottom: <?= 100 - $layout->sectionvh()->value() ?>"
        <?php endif ?>>
        <div class="uk-width-1-1">
            <div
                class="<?php if($layout->sectionbreite() != 'remove'): ?>uk-container <?= $layout->sectionbreite() ?><?php endif; ?> <?= $layout->sectionexpand() ?>">
                <div class="uk-grid uk-flex <?= $layout->sectionausrichtung() ?> <?= $layout->gutter() ?>" uk-grid>
                    <?php foreach ($layout->columns() as $column): ?>
                    <div class="uk-width-<?= str_replace('/', '-', $column->width()) ?>@m">
                        <div <?php if($layout->sectionexpand() == 'uk-container-expand-left' && $column->isFirst()): ?>class="uk-container-item-padding-remove-left"
                            <?php endif; ?>
                            <?php if($layout->sectionexpand() == 'uk-container-expand-right' && $column->isLast()): ?>class="uk-container-item-padding-remove-right"
                            <?php endif; ?>>
                            <?= $column->blocks() ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</main>
<?php snippet('footer') ?>