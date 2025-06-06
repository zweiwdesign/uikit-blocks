<?php
$navigations = $block->navigations()->or('live');
$toggle_divider = $block->toggle_divider()->toBool();
$toggle_pill = $block->toggle_pill()->toBool();
$ausrichtung = $block->ausrichtung();


if ($navigations == 'live') {
    $navigations = $site->children()->listed();
    $navigations_check = 'live';
} else {
    $menus = $site->menubuilder()->toStructure();
    $menu = $menus->findBy('id', $navigations);
    $navigations_check = $menu ? 'custom' : 'live';
    $navigations = $menu ? $menu->menuentrys()->toStructure() : [];
}

$ausrichtung = $block->ausrichtung()->or('uk-flex-left');

$navAttr = '';
?>

<ul class="uk-subnav <?= $block->class() ?> <?= $extraClass ?? '' ?> <?= $ausrichtung ?> <?php if($toggle_divider) { echo "uk-subnav-divider";} ?> <?php if($toggle_pill) { echo "uk-subnav-pill";} ?>"
    uk-margin <?= $navAttr ?>>
    <?php foreach ($navigations as $item_navigation): ?>

    <?php 
        if($navigations_check == 'live') {
            $isCustom = false;
            $hasSubpages = false;
            $link = $item_navigation->url();
            $link_vegleich = $item_navigation->url();
        } else {
            $toggle_linktype = $item_navigation->toggle_linktype()->toText();
            $isCustom = $item_navigation->toggle_custom()->toBool();
            $hasSubpages = $item_navigation->subpages()->isNotEmpty();

            if (!$isCustom && $item_navigation->pages()->toPage()) {
                $link = $item_navigation->pages()->toPage()->url();
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
        }
        
        $title = $item_navigation->title()->isNotEmpty() ? $item_navigation->title()->html() : ($isCustom ? '' : $item_navigation->pages()->toPage()?->title());

        $isActive = $link === $page->url() ? 'uk-active' : '';
        $openNewTab = $item_navigation->openNewTab()->toBool() ? "target='_blank'" : '';
    ?>

    <li class="<?= ($link_vegleich === $page->url()) ? 'uk-active' : '' ?>">
        <a href="<?php if ($hasSubpages): ?>#<?php else: ?><?= $link ?><?php endif; ?>" uk-scroll
            <?= $openNewTab ?>><?= $title ?>
            <?php if ($hasSubpages): ?>
            <span uk-icon="icon: triangle-down"></span>
            <?php endif; ?>
        </a>

        <?php if ($hasSubpages): ?>
        <div uk-dropdown="mode: click" class="uk-dark">
            <ul class="uk-nav uk-dropdown-nav">
                <?php foreach ($item_navigation->subpages()->toBlocks() as $subpage_item): ?>
                <?= $subpage_item ?>
                <?php endforeach ?>
            </ul>
        </div>
        <?php endif; ?>
    </li>
    <?php endforeach ?>
</ul>