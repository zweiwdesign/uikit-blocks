<?php
$accounts = $site->socialmediaaccounts()->yaml();
$showLabel = $block->showlabel()->toBool();
$layout = $block->layout()->value();
$labelPosition = $block->labelposition()->value();
$asButton = $block->button()->toBool();
$align = $block->align()->value();

$class = $block->class();

if($layout == "vertikal") {
    if($align == "uk-flex-right") {
        $align = "uk-flex-column uk-flex-bottom";
    } else if($align == "uk-flex-center") {
        $align = "uk-flex-column uk-flex-middle";
    } else {
        $align = "uk-flex-column uk-flex-top";
    }
}

$validIcons = [
    '500px', 'android', 'android-robot', 'apple', 'behance', 'bluesky', 'discord',
    'dribbble', 'etsy', 'facebook', 'flickr', 'foursquare', 'github', 'github-alt',
    'gitter', 'google', 'instagram', 'joomla', 'linkedin', 'mastodon', 'microsoft',
    'pinterest', 'reddit', 'signal', 'soundcloud', 'telegram', 'threads', 'tiktok',
    'tripadvisor', 'tumblr', 'twitch', 'uikit', 'vimeo', 'whatsapp', 'wordpress',
    'x', 'xing', 'yelp', 'yootheme', 'youtube'
];

?>
<div class="uk-flex uk-grid-small <?= $class ?> <?= $align ?>" uk-grid>
    <?php
foreach ($accounts as $platform => $url):
    $platform = strtolower(trim($platform));
    $url = trim($url);
    if (empty($url) || !in_array($platform, $validIcons)) continue;

    $label = $showLabel ? ucfirst($platform) : '';

    // Wrapper-Klasse für Layout – unabhängig von Button oder nicht
    $wrapperClass = $layout === 'vertikal'
        ? 'uk-display-block'
        : 'uk-display-inline-block';

    // Link-Klasse nur, wenn kein Button – sonst leer
    $linkClass = $asButton ? 'uk-icon-button' : '';

    // Icon-Attribut bleibt gleich
    $iconAttr = 'uk-icon="icon: ' . esc($platform) . '"';
?>
    <span class="<?= $wrapperClass ?>">
        <?php if ($labelPosition == 'left'): ?>
        <?= $label ?>
        <?php endif; ?>
        <a href="<?= esc($url) ?>" class="<?= $linkClass ?>" <?= $iconAttr ?>></a>
        <?php if ($labelPosition == 'right'): ?>
        <?= $label ?>
        <?php endif; ?>
    </span>
    <?php endforeach; ?>
</div>