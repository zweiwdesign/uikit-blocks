<?php snippet('header') ?>
<main uk-height-viewport="expand: true">
    <div class="uk-section uk-padding-remove-bottom">
        <div class="uk-container uk-container-small uk-text-center@m">
            <p class="uk-text-meta uk-margin-remove"><?= $page->tags() ?></p>
            <h1 class="uk-margin-small"><?= $page->title() ?></h1>
        </div>
    </div>
    <div class="uk-section">
        <div class="uk-container uk-container-large">
            <?php if($img = $page->cover()->toFile()) : ?>
            <picture>
                <source
                    srcset="<?= $img->thumb(['width' => 2*640,'height' => 640,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                    media="(max-width: 640px)">
                <source
                    srcset="<?= $img->thumb(['width' => 2*960,'height' => 960,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                    media="(max-width: 960px)">
                <img class="uk-border-rounded uk-background-muted"
                    src="<?= $img->thumb(['width' => 2500,'height' => 1250,'quality' => 60,'format' => 'webp', 'crop' => true])->url() ?>"
                    width="2500" height="1250" alt="<?= $img->alt() ?>" loading="eager">
            </picture>
            <?php endif; ?>
        </div>
    </div>
    <div class="uk-section uk-section-large uk-padding-remove-top">
        <div class="uk-container uk-container-small">
            <?php foreach ($page->text()->toBlocks() as $block): ?>
            <?= $block ?>
            <?php endforeach ?>
        </div>
    </div>
    <?php snippet('footer') ?>