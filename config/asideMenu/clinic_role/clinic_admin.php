<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Clinic Admin',
        ],
        // Clinic
        [
            'title' => 'Clinic',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/clinic/clinic/'
                ],
                [
                    'title' => 'Register',
                    'page' => '/clinic/clinic/register'
                ],
            ]
        ],
        // Room
        [
            'title' => 'Room',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/clinic/room/'
                ],
                [
                    'title' => 'Register',
                    'page' => '/clinic/room/register'
                ]
            ]
        ],
        // Service
        [
            'title' => 'Service',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/clinic/room/service'
                ],
                [
                    'title' => 'Register',
                    'page' => '/clinic/room/service/register'
                ]
            ]
        ],
        // Disease
        [
            'title' => 'Disease',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/clinic/disease/'
                ],
                [
                    'title' => 'Register',
                    'page' => '/clinic/disease/register'
                ]
            ]
        ],
        // Symptom
        [
            'title' => 'Symptom',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/clinic/symptom/'
                ],
                [
                    'title' => 'Register',
                    'page' => '/clinic/symptom/register'
                ]
            ]
        ],
    ]

];
