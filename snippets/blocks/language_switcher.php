<?php

use Kirby\Toolkit\Str;

$languages = kirby()->languages();
$currentLanguage = kirby()->language();
$availableLanguages = array_map('trim', Str::split($block->languages(), ','));

// Optionen aus Block-Feldern
$displayMode = $block->displayMode()->or('list')->value();
$direction = $block->direction()->or('horizontal')->value();
$useUppercaseCodes = $block->showCodes()->toBool();
$dropdown_art = $block->dropdown_art()->or('uk-button-link')->value();

$toggle_divider = $block->toggle_divider()->toBool();
$divider_size = $block->divider_size()->or('none');
?>

<?php if ($displayMode === 'dropdown'): ?>
<div class="language-switcher-dropdown uk-inline">
    <!-- Button, der das Dropdown öffnet -->
    <button class="uk-button <?= $dropdown_art ?>" type="button">
        <?php echo $useUppercaseCodes ? strtoupper($currentLanguage->code()) : $currentLanguage->name(); ?>
        <span uk-icon="icon: chevron-down"></span>
    </button>

    <!-- Dropdown-Inhalt, der die verfügbaren Sprachen anzeigt -->
    <div uk-dropdown="mode: click">
        <ul class="uk-nav uk-nav-default">
            <?php foreach ($languages as $language): ?>
            <?php 
                // Überspringe die aktuelle Sprache, die im Dropdown nicht angezeigt werden soll
                if ($language == $currentLanguage || !in_array($language->code(), $availableLanguages)) {
                    continue;
                }
                ?>
            <li>
                <a href="<?= $page->url($language->code()) ?>">
                    <?= $useUppercaseCodes ? strtoupper($language->code()) : $language->name() ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>



<?php else: ?>
<ul
    class="language-switcher <?= esc($direction) ?> uk-margin-remove-bottom <?php if($toggle_divider && $direction == "horizontal") { echo "uk-subnav-divider";} elseif($toggle_divider && $direction == "vertikal") { echo "uk-list uk-list-divider"; if($divider_size == "collapse") {echo " uk-list-collapse";} elseif($divider_size == "large") {echo " uk-list-large";} } ?>">
    <?php foreach ($languages as $language): ?>
    <?php if (in_array($language->code(), $availableLanguages)): ?>
    <li class="<?= $language == $currentLanguage ? 'active' : '' ?>">
        <?php if ($language == $currentLanguage): ?>
        <span><?= $useUppercaseCodes ? strtoupper($language->code()) : $language->name() ?></span>
        <?php else: ?>
        <a href="<?= $page->url($language->code()) ?>">
            <?= $useUppercaseCodes ? strtoupper($language->code()) : $language->name() ?>
        </a>
        <?php endif; ?>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<style>
.language-switcher.horizontal {
    display: flex;
    gap: 1rem;
    list-style: none;
    padding: 0;
}

.language-switcher.vertical {
    display: block;
    list-style: none;
    padding: 0;
}

.language-switcher-dropdown .uk-nav-default {
    max-height: 200px;
    overflow-y: auto;
}

.language-switcher-dropdown .uk-nav-default .uk-active a {
    font-weight: bold;
    text-decoration: underline;
}
</style>