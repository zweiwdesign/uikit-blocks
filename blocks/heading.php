<?php /** @var \Kirby\Cms\Block $block */ ?>
<<?= $level = $block->level()->or('h2') ?> class="<?= $block->size() ?>"><?= $block->text() ?></<?= $level ?>>