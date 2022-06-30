<?php
// Aside menu
return [

    'items' => [
        [
            'section' => 'Gate Admin',
        ],
         // Employee
         [
            'title' => 'Student List',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/gate/student/'
                ]
            ]
        ],
       // Gate Assign
       [
        'title' => 'Control Gate',
        'desc' => '',
        'icon' => 'media/svg/icons/Design/Bucket.svg',
        'bullet' => 'dot',
        'root' => true,
        'submenu' => [
            [
                'title' => 'Control Student Gate',
                'page' => '/gate/student/student_pass',
            ]
            
        ]
    ],
    // Privilege
    [
        'title' => 'Employee',
        'desc' => '',
        'icon' => 'media/svg/icons/Design/Bucket.svg',
        'bullet' => 'dot',
        'root' => true,
        'submenu' => [
            [
                'title' => 'Gates Employee',
                'page' => '/gate/attendance'
            ]
        ]
    ],
    ]

];
