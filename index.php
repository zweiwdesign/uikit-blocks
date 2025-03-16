<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('tilmannruppert/uikit-blocks', [
    'blueprints' => [
        'pages/default' => __DIR__ . '/blueprints/pages/default.yml',
        'fields/uikit' => __DIR__ . '/blueprints/fields/base.yml',
        'fields/subblocks' => __DIR__ . '/blueprints/fields/subblocks.yml',
        'fields/sections' => function ($kirby) {
            return include __DIR__ . '/blueprints/fields/sections.php';
        },
        'blocks/buttons' => __DIR__ . '/blueprints/blocks/buttons.yml',
        'blocks/button' => __DIR__ . '/blueprints/blocks/button.yml',
        'blocks/overlay' => __DIR__ . '/blueprints/blocks/overlay.yml',
        'blocks/heading' => __DIR__ . '/blueprints/blocks/heading.yml',
        'blocks/list' => __DIR__ . '/blueprints/blocks/list.yml',
        //'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
        'blocks/text' => __DIR__ . '/blueprints/blocks/text.yml',
        'blocks/card' => __DIR__ . '/blueprints/blocks/card.yml',
        'blocks/divider' => __DIR__ . '/blueprints/blocks/divider.yml',
        'blocks/iconflex' => __DIR__ . '/blueprints/blocks/iconflex.yml',
        'blocks/countup' => __DIR__ . '/blueprints/blocks/countup.yml',
        'blocks/table' => __DIR__ . '/blueprints/blocks/table.yml',
        'blocks/accordion' => __DIR__ . '/blueprints/blocks/accordion.yml',
        'blocks/inner_accordion' => __DIR__ . '/blueprints/blocks/inner_accordion.yml',
        'blocks/tab' => __DIR__ . '/blueprints/blocks/tab.yml',

    ],
    'snippets' => [
        'blocks/overlay' => __DIR__ . '/blocks/overlay.php',
        'blocks/image' => __DIR__ . '/blocks/image.php',
        'blocks/heading' => __DIR__ . '/blocks/heading.php',
        'blocks/buttons' => __DIR__ . '/blocks/buttons.php',
        'blocks/button' => __DIR__ . '/blocks/button.php',
        'blocks/list' => __DIR__ . '/blocks/list.php',
        'blocks/text' => __DIR__ . '/blocks/text.php',
        'blocks/card' => __DIR__ . '/blocks/card.php',
        'blocks/divider' => __DIR__ . '/blocks/divider.php',
        'blocks/iconflex' => __DIR__ . '/blocks/iconflex.php',
        'blocks/countup' => __DIR__ . '/blocks/countup.php',
        'blocks/table' => __DIR__ . '/blocks/table.php',
        'blocks/accordion' => __DIR__ . '/blocks/accordion.php',
        'blocks/inner_accordion' => __DIR__ . '/blocks/inner_accordion.php',
        'blocks/tab' => __DIR__ . '/blocks/tab.php',
        'layout' => __DIR__ . '/snippets/layout.php',
    ],
    'templates' => [
        'default' => __DIR__ . '/templates/default.php',
    ],
]);