<?php 
// fetch the basic set of articles
$articles = $page->children()->listed()->paginate(10);

// add the tag filter
if($tag = param('tag')) {
  $articles = $articles->filterBy('tags', $tag, ',')->paginate(6);
}
?>
<?php snippet('header') ?>
<main uk-height-viewport="expand: true">
    <div class="uk-section">
        <div class="uk-container uk-container-large">
            <?php

// Alle Tags abrufen
$tags = $page->children()->listed()->pluck('tags', ',', true);

// Den 'tag' Parameter aus der URL holen
$tagParam = param('tag');

?>
            <div class="uk-width-1-1">
                <ul class="uk-subnav uk-subnav-divider">
                    <li<?= e(!$tagParam, ' class="uk-active"') ?>>
                        <a href="<?= $page->url() ?>">
                            Alle
                        </a>
                        </li>
                        <?php foreach($tags as $tag): ?>
                        <li<?= e($tagParam == $tag, ' class="uk-active"') ?>>
                            <a href="<?= url($page->id(), ['params' => ['tag' => $tag]]) ?>">
                                <?= html($tag) ?>
                            </a>
                            </li>
                            <?php endforeach ?>
                </ul>
            </div>
            <div class="uk-grid" uk-grid uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 30">

                <?php foreach ($list = $articles as $item): ?>
                <?php if($item->isFirst() and param('tag') == ""):?>
                <div class="uk-width-1-1 uk-transition-toggle uk-animation-fast" tabindex="0">
                    <article class="uk-flex-middle" uk-grid>
                        <div class="uk-width-1-2@m uk-width-2-3@l">
                            <a href="<?= $item->url() ?>">
                                <?php if($img = $item->cover()->toFile()) : ?>
                                <picture>
                                    <source
                                        srcset="<?= $img->thumb(['width' => 2*640,'height' => 640,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                                        media="(max-width: 640px)">
                                    <source
                                        srcset="<?= $img->thumb(['width' => 2*960,'height' => 960,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                                        media="(max-width: 960px)">
                                    <img class="uk-border-rounded uk-transition-scale-up uk-transition-opaque"
                                        src="<?= $img->thumb(['width' => 2000,'height' => 1000,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                                        alt="<?= $img->alt() ?>" width="2000" height="1000" loading="eager">
                                </picture>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="uk-width-1-2@m uk-width-1-3@l">
                            <div class="uk-text-meta uk-margin-remove"><?= $item->tags() ?>
                            </div>
                            <h2 class=" uk-link-reset uk-margin-remove">
                                <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
                            </h2>
                            <div class="uk-panel uk-margin-small-top">
                                <?= $item->metaDescription() ?>

                            </div>
                            <a class="uk-button uk-button-text uk-margin-top uk-visible@l"
                                href="<?= $item->url() ?>">mehr
                                lesen</a>
                        </div>
                    </article>
                </div>
                <?php else: ?>
                <div class="uk-width-1-2@m uk-width-1-3@l uk-animation-fast">
                    <article class="uk-panel uk-transition-toggle" style="" tabindex="0">
                        <a href="<?= $item->url() ?>">
                            <?php if($img = $item->cover()->toFile()) : ?>
                            <picture>
                                <source
                                    srcset="<?= $img->thumb(['width' => 2*640,'height' => 640,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                                    media="(max-width: 640px)">
                                <source
                                    srcset="<?= $img->thumb(['width' => 2*960,'height' => 960,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                                    media="(max-width: 960px)">
                                <img class="uk-border-rounded uk-transition-scale-up uk-transition-opaque"
                                    src="<?= $img->thumb(['width' => 1200,'height' => 600,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                                    alt="<?= $img->alt() ?>" width="1200" height="600" loading="lazy">
                            </picture>
                            <?php endif; ?>
                        </a>
                        <div class="uk-text-meta uk-margin-top"><?= $item->tags() ?>
                        </div>
                        <h2 class="uk-h4 uk-link-reset uk-margin-remove">
                            <a href="<?= $item->url() ?>"><?= $item->title() ?></a>
                        </h2>
                        <div class="uk-panel uk-margin-small-top">
                            <?= $item->metaDescription() ?>
                        </div>
                    </article>
                </div>
                <?php endif ?>
                <?php endforeach ?>
            </div>
            <?php $pagination = $list->pagination() ?>
            <div class="uk-margin-large">
                <?php $pagination = $list->pagination() ?>
                <nav aria-label="Pagination">
                    <ul class="uk-pagination uk-flex-center" uk-margin>
                        <?php if ($pagination->hasPrevPage()): ?>
                        <li><a href="<?= $pagination->prevPageURL() ?>"><span uk-pagination-previous></span></a></li>
                        <?php endif ?>
                        <?php foreach ($pagination->range(10) as $r): ?>
                        <li>
                            <a<?= $pagination->page() === $r ? ' aria-current="page"' : '' ?>
                                href="<?= $pagination->pageURL($r) ?>">
                                <?= $r ?>
                                </a>
                        </li>
                        <?php endforeach ?>
                        <?php if ($pagination->hasNextPage()): ?>
                        <li><a href="#"><span uk-pagination-next></span></a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>
<?php snippet('footer') ?>