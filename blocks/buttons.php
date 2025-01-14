<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php
$buttons = $block->buttons()->toBlocks();

if ($buttons): ?>
<div class="uk-button-group">
    <?php foreach ($buttons as $button): ?>
    <a href="<?= $button->link()->toUrl() ?>" class="uk-button <?= $button->style() ?>"><?= $button->text() ?></a>
    <?php endforeach; ?>
</div>
<?php endif; ?>