<?php

use Kirby\Cms\App as Kirby;

Kirby::plugin('tilmannruppert/uikit-blocks', [
    'blueprints' => [
        'fields/uikit' => __DIR__ . '/fields/base.yml',
        'fields/subblocks' => __DIR__ . '/fields/subblocks.yml',
        'fields/sections' => function ($kirby) {
            return include __DIR__ . '/fields/sections.php';
        },
        'blocks/buttons' => __DIR__ . '/blocks/buttons.yml',
        'blocks/overlay' => __DIR__ . '/blocks/overlay.yml',
        'blocks/heading' => __DIR__ . '/blocks/heading.yml',
        'blocks/image' => __DIR__ . '/blocks/image.yml',
    ],
    'snippets' => [
        'blocks/overlay' => __DIR__ . '/blocks/overlay.php',
        'blocks/image' => __DIR__ . '/blocks/image.php',
        'blocks/heading' => __DIR__ . '/blocks/heading.php',
    ],
]);