<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Temporary ID',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'id/temporary',
            'new-tab' => false,
        ],
        [
            'title' => 'Permanent ID',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => 'id/permanent',
            'new-tab' => false,
        ],
    ]

];
