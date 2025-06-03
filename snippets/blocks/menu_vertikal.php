<?php
$navigations = $block->navigations()->or('live');
$useAccordion = $block->subpages_accordion();
$style = $block->style();
$toggle_center = $block->toggle_center()->toBool();
$toggle_divider = $block->toggle_divider()->toBool();
$size_primary = $block->size_primary();

if($useAccordion == "akkordion") {
    $navAttr = "uk-nav='multiple: true'";
} else {
    $navAttr = "";
}

if ($navigations == 'live') {
    $navigations = $site->children()->listed();
    $navigations_check = 'live';
} else {
    $menus = $site->menubuilder()->toStructure();
    $menu = $menus->findBy('id', $navigations);
    $navigations_check = $menu ? 'custom' : 'live';
    $navigations = $menu ? $menu->menuentrys()->toStructure() : [];
}
?>


<ul class="uk-nav <?= $extraClass ?? '' ?> <?= $style ?> <?php if($style == "uk-nav-primary"){ echo $size_primary; } ?> <?php if($toggle_center) { echo "uk-nav-center";} ?> <?php if($toggle_divider) { echo "uk-nav-divider";} ?>"
    <?= $navAttr ?>>
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

        $itemClass = trim($item_navigation->class() . ' ' . $isActive);
    ?>

    <?php if ($hasSubpages): ?>
    <li class="uk-parent <?= $itemClass ?>">
        <a href="<?= $link ?>" uk-scroll <?= $openNewTab ?>>
            <?= $title ?>
            <?php if($useAccordion == "akkordion"): ?><span uk-nav-parent-icon></span><?php endif; ?>
        </a>
        <ul class="uk-nav-sub">
            <?php foreach ($item_navigation->subpages()->toBlocks() as $subpage_item): ?>
            <?= $subpage_item ?>
            <?php endforeach ?>
        </ul>
    </li>
    <?php else: ?>
    <li class="<?= $itemClass ?>">
        <a href="<?= $link ?>" uk-scroll <?= $openNewTab ?>><?= $title ?></a>
    </li>
    <?php endif; ?>
    <?php endforeach ?>
</ul>