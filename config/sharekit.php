<?php

return [
    'theme' => env('SHAREKIT_THEME', 'default'),
    'stack_names' => [
        'styles' => 'after-styles',
        'scripts' => 'after-scripts',
    ],
    'popup' => [
        'width' => 620,
        'height' => 700,
    ],
    'use_native_when_available' => true,
    'button_tag' => 'button',
    'networks' => [
        'x',
        'facebook',
        'linkedin',
        'whatsapp',
        'telegram',
        'reddit',
        'email',
        'copy',
        'native',
    ],
    'labels' => [
        'share' => 'Share',
        'x' => 'X',
        'facebook' => 'Facebook',
        'linkedin' => 'LinkedIn',
        'whatsapp' => 'WhatsApp',
        'telegram' => 'Telegram',
        'reddit' => 'Reddit',
        'email' => 'Email',
        'copy' => 'Copy link',
        'native' => 'Share',
        'copied' => 'Copied',
    ],
    'themes' => [
        'default' => [
            'root' => 'sk-root',
            'list' => 'sk-list',
            'item' => 'sk-item',
            'button' => 'sk-button',
            'button_icon' => 'sk-button-icon',
            'button_label' => 'sk-button-label',
            'heading' => 'sk-heading',
        ],
        'tailwind' => [
            'root' => 'sk-root',
            'list' => 'sk-list',
            'item' => 'sk-item',
            'button' => 'sk-button',
            'button_icon' => 'sk-button-icon',
            'button_label' => 'sk-button-label',
            'heading' => 'sk-heading',
        ],
    ],
];
