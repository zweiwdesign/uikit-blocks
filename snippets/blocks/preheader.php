<?php foreach ($site->preheader_builder()->toLayouts()->values() as $i => $layout):

$visible = $layout->visible();
$toggle_griddivider = $layout->toggle_griddivider()->toBool();
$gutter = $layout->gutter();
$sectionausrichtung_hori = $layout->sectionausrichtung_hori();
$sectionausrichtung = $layout->sectionausrichtung();
$sectionbreite = $layout->sectionbreite();
$sectionremove = $layout->sectionremove();
?>

<div class="preheader <?= $layout->class() ?> <?= $visible ?> uk-section uk-section-xsmall <?= $sectionremove ?>"
    role="region" aria-label="Aktueller Hinweis">
    <div class="uk-container <?= $sectionbreite ?>">
        <div class="uk-grid uk-flex <?= $sectionausrichtung ?> <?= $sectionausrichtung_hori ?> <?= $gutter ?>  <?php if($toggle_griddivider) { echo "uk-grid-divider";} ?>"
            uk-grid>
            <?php foreach ($layout->columns() as $column): ?>
            <div class="uk-width-<?= str_replace('/', '-', $column->width()) ?>@l">
                <?php foreach($column->blocks() as $block): ?>
                <?php snippet('blocks/' . $block->type(), ['block' => $block]) ?>
                <?php endforeach ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php endforeach; ?>