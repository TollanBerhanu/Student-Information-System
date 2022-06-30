<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Administrator',
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
                ],
                [
                    'title' => 'Register',
                    'page' => '/admin/employee/register'
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
                ],
                [
                    'title' => 'Create',
                    'page' => '/admin/role/register'
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
                ],
                [
                    'title' => 'Create',
                    'page' => '/admin/privilege/register'
                ]
            ]
        ],
//         Role - Privilege
//        [
//            'title' => 'Role-Privilege',
//            'root' => true,
//            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
//            'page' => '/admin/role_privilege',
//            'new-tab' => false,
//        ],
    ]

];
