<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Super Admin',
        ],
        // Employee
        [
            'title' => 'Emp',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
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
                    'title' => 'Create',
                    'page' => '/admin/privilege/register'
                ]
            ]
        ],
    ]

];
