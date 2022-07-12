<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Admin Cost Share',
        ],
        // Employee
        [

            'title' => 'College Cost Share',
            'desc' => '',
            'icon' => 'media/svg/icons/Design/Bucket.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Cost Share Report',
                    'page' => 'cost/collegeCost/studentList'
                ]
            ]
        ],
    ]

];
