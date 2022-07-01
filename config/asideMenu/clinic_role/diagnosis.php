<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Diagnosis',
        ],
        [
            'title' => 'New Request',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/clinic/diagnosis/list/new',
            'new-tab' => false,
        ],
    ]

];
