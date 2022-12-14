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
                'page' => '/gate/admin/blocked_StudentList'
            ]
        ]
    ],
       // G`ate Assign
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

    [
        'title' => 'Employee List',
        'desc' => '',
        'icon' => 'media/svg/icons/Design/Bucket.svg',
        'bullet' => 'dot',
        'root' => true,
        'submenu' => [
            [
                'title' => 'Employee Attend List',
                'page' => '/gate/get_employee_history'
            ],
            [
                'title' =>'Gate List',
                'page' =>'/gate/gate_list'
            ]
        ]
    ],

        // PC
        [
            'title' => 'Students Pc',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Register Pc',
                    'page' => '/gate/admin/studentList'
                ],[
                    'title' => 'Check PC',
                    'page' => '/gate/pc'
                ],
                [
                    'title' => 'PC history',
                    'page' => '/gate/admin/blocked_StudentList'
                ]
            ]
        ],
    ]

];
