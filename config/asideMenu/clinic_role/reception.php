<?php
// Aside menu
return [

    'items' => [
        // Custom
        [
            'section' => 'Reception',
        ],
        [
            'title' => 'Search',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/clinic/reception/search',
            'new-tab' => false,
        ],
    ]

];
