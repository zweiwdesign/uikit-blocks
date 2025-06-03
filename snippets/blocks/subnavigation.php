<?php
            $toggle_linktype = $block->toggle_linktype()->toText();
            $isCustom = $block->toggle_custom()->toBool();
            
            if (!$isCustom && $block->pages()->toPage()) {
                $link = $block->pages()->toPage()->url();
                $link_vegleich = $link;
            } elseif ($isCustom && $toggle_linktype == 'extern' && $block->externlink()->isNotEmpty()) {
                $link = $block->externlink()->toUrl();
                $link_vegleich = $link;
            } elseif($isCustom && $toggle_linktype == 'intern' && $block->entrylink()->isNotEmpty()) {
                $link = $block->entrylink()->toUrl();
                if ($block->entrylinkanchor()->isNotEmpty()) {
                    $link .= "#" . $block->entrylinkanchor();
                }
                $link_vegleich = $block->entrylink()->toUrl();

            } else {
                $link = '';
                $link_vegleich = '';
            } 
        
        $title = $block->title()->isNotEmpty() ? $block->title()->html() : ($isCustom ? '' : $block->pages()->toPage()?->title());

        $isActive = $link === $page->url() ? 'uk-active' : '';
        $openNewTab = $block->openNewTab()->toBool() ? "target='_blank' rel='noopener'" : '';
        ?>

<li class="<?= ($link_vegleich === $page->url()) ? 'uk-active' : '' ?>">
    <a href="<?= $link ?>" uk-scroll <?= $openNewTab ?>><?= $title ?>
    </a>
</li>