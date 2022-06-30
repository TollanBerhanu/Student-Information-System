<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Cafe Ticker',
        ],
        // Employee ticker
        [
            'title' => 'Cafe Ticker Page',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Open',
                    'page' => '/'
                ]
            ]
        ],
    ]

];
