<button class="<?= $block->class() ?> uk-button uk-button-small <?= $block->style() ?>" type="button"
    data-cc="show-preferencesModal"><?= $block->text()->html()->or("Datenschutz Einstellungen") ?>
</button>

<?php snippet('cookieconsentJs') ?>