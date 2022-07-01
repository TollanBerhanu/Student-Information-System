<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Cafe Super Admin',
        ],
        // Register
        [
            'title' => 'Register and Update',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Cafe',
                    'page' => '/cafe/Opration/cafe_register_update_page'
                ],
                [
                    'title' => 'Food Menu',
                    'page' => '#'
                ]
            ]
        ],
        // Assign
        [
            'title' => 'Assign',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Cafe To Collage',
                    'page' => '#'
                ],
                [
                    'title' => 'Cafe To Department',
                    'page' => '#'
                ],
                [
                    'title' => 'Cafe To Program',
                    'page' => '#'
                ]
                ,
                [
                    'title' => 'Collage Cafe Admin',
                    'page' => '#'
                ]
            ]
        ],
        // Privilege
        [
            'title' => 'Time And Schedule',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Create Time Schedule',
                    'page' => '#'
                ]
                ,
                [
                    'title' => 'Update Time Schedule',
                    'page' => '#'
                ]
            ]
        ],
    ]

];
