<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Admin System',
        ],
        // Employee
        [
            'title' => 'Employee',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/admin/employee/'
                ]
            ]
        ],
        // Role
        [
            'title' => 'Role',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/admin/role/'
                ]
            ]
        ],
        // Privilege
        [
            'title' => 'Privilege',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/admin/privilege/'
                ]
            ]
        ],
    ]

];
