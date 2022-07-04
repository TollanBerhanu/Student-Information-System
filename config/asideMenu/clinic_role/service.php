<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Service',
        ],
        [
            'title' => 'New request',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/clinic/service/list/new',
            'new-tab' => false,
        ],[
            'title' => 'Pending request',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/clinic/service/list/pending',
            'new-tab' => false,
        ],
    ]

];
