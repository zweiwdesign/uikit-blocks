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
        'blocks/button' => __DIR__ . '/blueprints/blocks/button.yml',
        'blocks/overlay' => __DIR__ . '/blueprints/blocks/overlay.yml',
        'blocks/heading' => __DIR__ . '/blueprints/blocks/heading.yml',
        'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
    ],
    'snippets' => [
        'blocks/overlay' => __DIR__ . '/blocks/overlay.php',
        'blocks/image' => __DIR__ . '/blocks/image.php',
        'blocks/heading' => __DIR__ . '/blocks/heading.php',
        'blocks/button' => __DIR__ . '/blocks/button.php',
    ],
    'templates' => [
        'default' => __DIR__ . '/templates/default.php',
    ],
]);