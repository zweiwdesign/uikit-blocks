<?php foreach ($page->baselayout()->toLayouts()->values() as $i => $layout): ?>
<?php $isFirstLayout = $layout->isFirst(); ?>
<?php
// Prüfen, ob ein Hintergrundbild verwendet werden soll
$useBackgroundImage = $layout->usebackgroundimage()->toBool();
$backgroundImage    = $useBackgroundImage ? $layout->backgroundimage()->toFile() : null;

// Ganze Section als JSON
$sectionJson = json_encode($layout->toArray());

$classes = [
    'uk-section',
    'uk-position-relative',
    'uk-visible-toggle',
    'uk-flex',
    $layout->sectionflex(),
    $layout->backgroundimageat(),
    $layout->sectionvisibility(),
    $layout->sectionsize(),
    $layout->sectionremove(),
    $layout->sectioncolor(),
    $layout->class(),
];

if ($backgroundImage) {
    $classes[] = 'uk-background-' . $layout->backgroundsize();
    $classes[] = $layout->backgroundposition();
    $classes[] = $layout->backgroundblendmode();
    if ($layout->backgroundfixed()->toBool()) {
        $classes[] = 'uk-background-fixed';
    }
}

// Entfernt auch Strings, die nur aus Leerzeichen bestehen
$classes = array_filter($classes, 'trim');

$classString = implode(' ', $classes);
?>

<!-- Section-Container mit UIkit-Klassen zur Hover-Einblendung -->
<div id="<?= $layout->sectionId() ?>" class="<?= $classString ?>" <?php if ($backgroundImage): ?> uk-img
    sources="srcset: <?= $backgroundImage->thumb(['width' => 960, 'quality' => 60, 'format' => 'webp'])->url() ?>; media: (max-width: 960px)"
    data-src="<?= $backgroundImage->thumb(['width' => 2500, 'quality' => 80, 'format' => 'webp'])->url() ?>"
    <?php endif; ?> <?php if($layout->sectionsize() == "vh"): ?> uk-height-viewport="<?php if($layout->sectionvhoffset() == "true"): ?>offset-top: true;<?php endif ?>
                            offset-bottom: <?= 100 - $layout->sectionvh()->value() ?>" <?php endif ?>>

    <!-- Kopier-Button nur für Admins, bei Hover sichtbar -->
    <?php if ($kirby->user() && $kirby->user()->role()->name() === 'admin'): ?>
    <div class="uk-hidden-hover uk-position-small uk-position-top-right uk-position-z-index">
        <!-- esc() statt e() für sicheres Escapen -->
        <button class="uk-button uk-button-small uk-button-danger" data-json="<?= esc($sectionJson, 'attr') ?>"
            onclick="copyToClipboard(this.dataset.json)">
            Layout kopieren
        </button>
    </div>
    <?php endif; ?>

    <div class="uk-width-1-1">
        <div
            class="<?php if($layout->sectionbreite() != 'remove'): ?>uk-container <?= $layout->sectionbreite() ?><?php endif; ?> <?= $layout->sectionexpand() ?>">
            <div class="uk-grid uk-flex <?= $layout->sectionausrichtung() ?> <?= $layout->gutter() ?>  <?php if($layout->toggle_griddivider()->toBool() === true) { echo "uk-grid-divider";} ?>"
                uk-grid<?= $layout->sameHeight()->isTrue() ? ' uk-height-match="target: .panel"' : '' ?>>
                <?php foreach ($layout->columns() as $column): ?>
                <div
                    class="uk-width-<?= str_replace('/', '-', $column->width()) ?>@l <?php if ($layout->flexfirst() == 'true'): ?><?php if ($column->isLast()): ?> uk-flex-first uk-flex-last@m<?php endif; ?><?php endif; ?>">
                    <?php if($layout->sectionexpand() == 'uk-container-expand-left' && $column->isFirst()): ?>
                    <div class="uk-container-item-padding-remove-left">
                        <?php elseif($layout->sectionexpand() == 'uk-container-expand-right' && $column->isLast()): ?>
                        <div class="uk-container-item-padding-remove-right">
                            <?php endif; ?>
                            <?php foreach($column->blocks() as $block): ?>
                            <?php snippet('blocks/' . $block->type(), ['block' => $block, 'isfirstLayout' => $isFirstLayout]) ?>
                            <?php endforeach ?>
                        </div>
                        <?php if($layout->sectionexpand() == 'uk-container-expand-left' && $column->isFirst() || $layout->sectionexpand() == 'uk-container-expand-right' && $column->isLast()): ?>
                    </div><?php endif; ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

    </div><!-- Ende Section -->

    <?php endforeach; ?>

    </main>

    <!-- Script nur einmal für alle Kopier-Buttons -->
    <?php if ($kirby->user() && $kirby->user()->role()->name() === 'admin'): ?>
    <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(() => {
                UIkit.notification({
                    message: 'Layout in Zwischenablage kopiert!',
                    status: 'success', // Grün
                    pos: 'bottom-right',
                    timeout: 3000 // 3 Sekunden
                });
            })
            .catch((err) => {
                UIkit.notification({
                    message: 'Fehler beim Kopieren: ' + err,
                    status: 'danger', // Rot
                    pos: 'bottom-right',
                    timeout: 3000
                });
            });
    }
    </script>
    <?php endif; ?>