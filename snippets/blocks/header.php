<?php
$toggle_sticky = $block->toggle_sticky()->toBool();
$toggle_schatten = $block->toggle_schatten()->toBool();
$toggle_transparent = $block->toggle_transparent()->toBool();
$transparent_art = $block->transparent_art()->or('transparent-immer');
$toggle_headerinverse = $block->toggle_headerinverse()->toBool();

$headerAlign = $block->header_vertical_align()->or('uk-flex-middle');

$headerClasses = '';
$navbarClasses = '';
$stickyAttributes = '';
$navbarAttributes = '';

if ($toggle_sticky) {
    $stickyAttributes = "uk-sticky='start: 80; animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky";
    
    if ($toggle_schatten && !($toggle_transparent && $transparent_art == 'transparent-immer')) {
        $stickyAttributes .= "; cls-active: uk-box-shadow-small";
    }
    
    if ($toggle_transparent && $transparent_art == 'transparent-anfang') {
        $headerClasses = 'uk-position-absolute uk-position-z-index uk-width-1-1';
        $stickyAttributes .= "; cls-inactive: uk-navbar-transparent";
    }
    
    $stickyAttributes .= "'";
}

if ($toggle_transparent) {
    if ($transparent_art == 'transparent-immer') {
        $headerClasses = 'uk-position-absolute uk-position-z-index uk-width-1-1';
        $navbarClasses = 'uk-navbar-transparent';
        if ($toggle_headerinverse) {
            $navbarAttributes = "uk-inverse='target: .uk-navbar-left, .uk-navbar-center, .uk-navbar-right'";
        }
    } elseif ($transparent_art == 'transparent-anfang' && !$toggle_sticky) {
        $navbarClasses = 'uk-navbar-transparent';
    }
}

?>


<?php foreach ($block->header()->toLayouts()->values() as $i => $layout): ?>
<header class="<?= $headerClasses ?> <?= $block->class() ?>" uk-header>
    <div <?= $stickyAttributes ?>>
        <div class="uk-navbar-container <?= $navbarClasses ?>" <?= $navbarAttributes ?? '' ?>>
            <div
                class="uk-container <?php if($block->sectionbreite() != 'remove'): ?><?= $block->sectionbreite() ?><?php endif; ?>">
                <nav class="uk-navbar uk-flex uk-flex-auto <?= $headerAlign ?>" uk-navbar style="width: 100%;">
                    <?php $columns = $layout->columns(); $count = count($columns); ?>
                    <?php for ($i = 0; $i < $count; $i++): ?>
                    <?php $navbarClass = '';
                        if ($i === 0) {$navbarClass = 'uk-navbar-left';}
                        if ($count === 2 && $i === 1) {$navbarClass = 'uk-navbar-right';}
                        if ($count === 3) {
                            if ($i === 1) {$navbarClass = 'uk-navbar-center';
                            } elseif ($i === 2) { $navbarClass = 'uk-navbar-right';}
                        }
                        $column = $columns->nth($i);?>

                    <div class="<?= $navbarClass ?>">
                        <?php if ($column !== null): ?>
                        <?php foreach ($column->blocks() as $block): ?>
                        <?php if($block->type() !== "sectionNavmenu" && $block->type() !== "logo") { ?>
                        <div class="uk-navbar-item">
                            <?php snippet('blocks/' . $block->type(), ['block' => $block]) ?>
                        </div>
                        <?php } else { ?>
                        <?php snippet('blocks/' . $block->type(), ['block' => $block]) ?>
                        <?php } ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php endfor ?>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php endforeach ?>