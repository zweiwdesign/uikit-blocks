<?php
$showoffcanvas = $site->toggle_offcanvas()->toBool();
$offcanvasContent = $site->offcanvas_builder()->toLayouts()->values();
$offcanvas_align = $site->offcanvas_align();

$burger_visibility = $site->burger_menu_visibility()->or('l');
$ausrichtung = $block->ausrichtung()->or('uk-flex-left');
$navigations = $block->navigations()->or('live');

$toggle_akkordion = $block->toggle_akkordion()->toBool();
$blanklink = $block->blanklink()->toBool();

if ($burger_visibility === 'immer') {
    $burgerToggleClass = '';
    $burgerVisibleClass = '';
} else {
    $burgerToggleClass = 'uk-visible@' . $burger_visibility;
    $burgerVisibleClass = 'uk-hidden@' . $burger_visibility;
}

if($navigations == 'live') {
    $navigations = $site->children()->listed();
    $navigations_check = 'live';
} else {
   $menus = $site->menubuilder()->toStructure();
   $menu = $menus->findBy('id', $navigations);
   $navigations_check = $menu ? 'custom' : 'live';
   $navigations = $menu ? $menu->menuentrys()->toStructure() : [];
}

$headerBuilder = $site->header_builder();
$headerSection = $headerBuilder->toBlocks()->filterBy('type', 'sectionHeader')->first();

if ($headerSection) {
    $headerSectionBreite = $headerSection->sectionbreite();
} else {
    $headerSectionBreite = "";
}

$burgerNavBlock = $block->burgernav()->toBool();
?>

<!-- Normales Menü nur, wenn kein offcanvas aktiv -->
<?php if($burger_visibility != "immer"): ?>
<ul class="uk-navbar-nav <?= $ausrichtung ?> <?= $burgerToggleClass ?>"
    uk-scrollspy-nav="closest: li; scroll: true; offset: 80">
    <?php foreach ($navigations as $item_navigation): ?>

    <?php 
    $hasMegaMenu = false;

        if($navigations_check == 'live') {
            $isCustom = false;
            $hasSubpages = false;
            $link = $item_navigation->url();
            $link_vegleich = $item_navigation->url();
        } else {
            $toggle_linktype = $item_navigation->toggle_linktype()->toText();
            $isCustom = $item_navigation->toggle_custom()->toBool();

            $toggleSubpages = $item_navigation->toggle_subpages()->toBool();
            $subpages = $item_navigation->subpages()->isNotEmpty();

            if ($toggleSubpages && $subpages) {
                $hasSubpages = true;
            } else {
                $hasSubpages = false;
            }
            
            
            if (!$isCustom && $item_navigation->pages()->toPage()) {
                $selectedPage = $item_navigation->pages()->toPage(); // Seite
                $link = $selectedPage->url(); // Seiten-URL

                $toggleMega = $selectedPage->toggle_megamenu()->toBool();

                if ($toggleMega) {
                    $hasMegaMenu = true;
                    $megamenuContent = $selectedPage->megamenu_content()->toLayouts();
                }

                $link_vegleich = $link;
            } elseif ($isCustom && $toggle_linktype == 'extern' && $item_navigation->externlink()->isNotEmpty()) {
                $link = $item_navigation->externlink()->toUrl();
                $link_vegleich = $link;
            } elseif($isCustom && $toggle_linktype == 'intern' && $item_navigation->entrylink()->isNotEmpty()) {
                $link = $item_navigation->entrylink()->toUrl();

                if ($item_navigation->entrylinkanchor()->isNotEmpty()) {
                    $link .= "#" . $item_navigation->entrylinkanchor();
                }

                $link_vegleich = $item_navigation->entrylink()->toUrl();
            } else {
                $link = '';
                $link_vegleich = '';
            } 
            
            if($hasSubpages && $blanklink || $hasMegaMenu && $blanklink) {
                $link = "#";
            }
        }
        
        $title = $item_navigation->title()->isNotEmpty() ? $item_navigation->title()->html() : ($isCustom ? '' : $item_navigation->pages()->toPage()?->title());

        $isActive = $link === $page->url() ? 'uk-active' : '';
        $openNewTab = $item_navigation->openNewTab()->toBool() ? "target='_blank' rel='noopener'" : '';
        ?>

    <li class="<?= ($link_vegleich === $page->url()) ? 'uk-active' : '' ?>">
        <a href="<?= $link ?>" uk-scroll <?= $openNewTab ?>><?= $title ?>
            <?php if ($hasSubpages && $toggle_akkordion|| $hasMegaMenu && $toggle_akkordion): ?>
            <span uk-nav-parent-icon></span>
            <?php endif; ?>
        </a>

        <?php if ($hasMegaMenu): ?>
        <!-- Mega Menü Dropdown -->
        <?php 
                $selectedPage = $item_navigation->pages()->toPage(); // Seite
                $mega_width = $selectedPage->mega_width();
                $megaMenuContent = $selectedPage->megamenu_content()->toLayouts();
                 ?>
        <div class="mega-menu uk-dropdown <?php if($mega_width != "uk-width-1-1") { echo $mega_width;} ?>"
            <?php if($mega_width != "uk-width-1-1") { echo 'uk-dropdown="boundary: !.uk-navbar; flip: false"';} else { echo 'uk-dropdown="boundary: !.uk-navbar; stretch: x; flip: false"';} ?>>

            <?php foreach ($megaMenuContent as $i => $layout): ?>
            <div
                class="uk-section <?= $layout->class() ?> <?= $layout->sectionsize() ?> <?= $layout->sectionremove() ?>">
                <div class="uk-width-1-1">
                    <div
                        class="<?php if($layout->sectionbreite() != 'remove'): ?>uk-padding uk-container <?= $layout->sectionbreite() ?><?php endif; ?>">
                        <div class="uk-grid uk-flex <?= $layout->sectionausrichtung() ?> <?= $layout->sectionausrichtung_hori() ?><?= $layout->gutter() ?>  <?php if($layout->toggle_griddivider()->toBool() === true) { echo "uk-grid-divider";} ?>"
                            uk-grid>
                            <?php foreach ($layout->columns() as $column): ?>
                            <div class="uk-width-<?= str_replace('/', '-', $column->width()) ?>@l">
                                <div>
                                    <?php foreach($column->blocks() as $block): ?>
                                    <?php
                                    $dropdownnavClass = '';
                                    if ($block->type() === 'menu_vertikal' || $block->type() === 'menu_horizontal') {
                                        $dropdownnavClass = 'uk-navbar-dropdown-nav';
                                    }
                                    ?>
                                    <?php snippet('blocks/' . $block->type(), [
                                        'block' => $block,
                                        'extraClass' => $dropdownnavClass
                                    ]) ?>

                                    <?php endforeach ?>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach ?>
        </div>
        <?php elseif ($hasSubpages): ?>
        <!-- Subpages Dropdown -->
        <div class="uk-dropdown" uk-dropdown>
            <ul class="uk-nav uk-navbar-dropdown-nav">
                <?php foreach ($item_navigation->subpages()->toBlocks() as $subpage_item): ?>
                <?= $subpage_item ?>
                <?php endforeach ?>
            </ul>
        </div>
        <?php endif; ?>
    </li>


    <?php endforeach ?>
</ul>
<?php endif; ?>

<?php if($burgerNavBlock): ?>
<!-- Burger Menü -->
<a class="uk-navbar-toggle uk-navbar-toggle-animate <?= $burgerVisibleClass ?>" href="#burger-menu-<?= $block->id() ?>"
    uk-navbar-toggle-icon="ratio: 1.3" uk-toggle></a>

<div id="burger-menu-<?= $block->id() ?>" class="uk-dropbar uk-text-center uk-dropbar-top <?= $burgerVisibleClass ?>"
    <?php if ($showoffcanvas): ?>uk-drop="stretch: true; mode: click" <?php else: ?>uk-drop="stretch: x; mode: click"
    <?php endif; ?>>

    <?php if ($showoffcanvas): ?>
    <div
        class="offcanvas <?php if($showoffcanvas) { echo "uk-flex uk-flex-column ". $offcanvas_align;} ?> uk-height-1-1">
        <?php foreach ($offcanvasContent as $i => $layout): ?>
        <div class="uk-section <?= $layout->class() ?> <?= $layout->sectionsize() ?> <?= $layout->sectionremove() ?>">
            <div class="uk-width-1-1">
                <div
                    class="<?php if($layout->sectionbreite() != 'remove'): ?>uk-padding uk-container <?= $layout->sectionbreite() ?><?php endif; ?>">
                    <div class="uk-grid uk-flex <?= $layout->sectionausrichtung() ?> <?= $layout->sectionausrichtung_hori() ?><?= $layout->gutter() ?>  <?php if($layout->toggle_griddivider()->toBool() === true) { echo "uk-grid-divider";} ?>"
                        uk-grid>
                        <?php foreach ($layout->columns() as $column): ?>
                        <div class="uk-width-<?= str_replace('/', '-', $column->width()) ?>@l">
                            <div>
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
    </div>
    <?php else: ?>
    <div class="uk-container <?= $headerSectionBreite ?>">
        <ul class="uk-nav uk-nav-default <?= $ausrichtung ?>">
            <?php foreach ($navigations as $item_navigation): ?>
            <?php 
            
            if($navigations_check == 'live') {
                $isCustom = false;
                $hasSubpages = false;
                $link = $item_navigation->url();
                $link_vegleich = $item_navigation->url();
            } else {
                $isCustom = $item_navigation->toggle_custom()->toBool();
                $hasSubpages = $item_navigation->subpages()->isNotEmpty();
    
                if($item_navigation->entrylink()->isNotEmpty()) {
                    $link = $item_navigation->entrylink()->toUrl();
    
                    if ($item_navigation->entrylinkanchor()->isNotEmpty()) {
                        $link .= "#" . $item_navigation->entrylinkanchor();
                    }
    
                    $link_vegleich = $item_navigation->entrylink()->toUrl();
                } elseif ($item_navigation->externlink()->isNotEmpty()) {
                    $link = $item_navigation->externlink()->toUrl();
                    $link_vegleich = $link;
                } elseif ($item_navigation->pages()->toPage()) {
                    $link = $item_navigation->pages()->toPage()->url();
                    $link_vegleich = $link;
                } else {
                    $link = '';
                    $link_vegleich = '';
                }
                
            }

            $title = $item_navigation->title()->isNotEmpty() ? $item_navigation->title()->html() : ($isCustom ? '' : $item_navigation->pages()->toPage()?->title());

            $isActive = $link === $page->url() ? 'uk-active' : '';
            $openNewTab = $item_navigation->openNewTab()->toBool() ? "target='_blank' rel='noopener'" : '';
            ?>

            <li class="<?= ($link_vegleich === $page->url()) ? 'uk-active' : '' ?>">
                <a href="<?= $link ?>" <?= $openNewTab ?>><?= $title ?></a>
                <?php if ($hasSubpages): ?>
                <ul class="uk-nav-sub">
                    <?php foreach ($item_navigation->subpages()->toBlocks() as $subpage_item): ?>
                    <?= $subpage_item ?>
                    <?php endforeach ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
    <?php endif; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const allBurgerMenus = document.querySelectorAll('[id^="burger-menu-"].uk-dropbar');

    allBurgerMenus.forEach(burgerMenu => {
        const dropbar = burgerMenu;
        const offcanvas = burgerMenu.querySelector('.offcanvas');

        if (!dropbar || !offcanvas) return;

        const observer = new MutationObserver(() => {
            const isDropbarOpen = dropbar.classList.contains('uk-open');
            const isOffcanvasVisible = getComputedStyle(offcanvas).display !== 'none' &&
                offcanvas.offsetHeight > 0;

            if (isDropbarOpen && isOffcanvasVisible) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        observer.observe(dropbar, {
            attributes: true,
            attributeFilter: ['class']
        });
    });
});
</script>
<?php endif; ?>