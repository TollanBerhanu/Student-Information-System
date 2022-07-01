<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Collage Cafe Admin',
        ],
        // manage the Ticker
        [
            'title' => 'Manage Tickers',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'list Tickers',
                    'page' => '#'
                ],
                [
                    'title' => 'Asign Tickers',
                    'page' => '#'
                ]
            ]
        ],
        // Manage Time Schedule
        [
            'title' => 'Manage Time Schedule',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Asign Time Schedule',
                    'page' => '#'
                ]
            ]
        ],
    ]

];
