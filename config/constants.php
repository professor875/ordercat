<?php

return [
    'rating' => [
        'excellent' => 'Excellent',
        'very good' => 'Very Good',
        'good' => 'Good',
        'acceptable' => 'Acceptable',
        'bad' => 'Bad',
    ],
    'days' => [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday'
    ],

    'itemTypes' => [
        'breakfast' => 'Breakfast',
        'dinner' => 'Dinner',
        'lunch' => 'Lunch'
    ],

    'stageStatuses' => [
        'cooked' => 'Cooked',
        'packaging' => 'Packaging',
        'delivery' => 'Delivery',
        'handed' => 'Handed',
        'rating' => 'Rating'
    ],

    'permissions' => [
        [
            'name' => 'dashboard.chart',
            'display_name' => 'View Chart',
        ],
        [
            'name' => 'dashboard.count',
            'display_name' => 'View Count',
        ],
        [
            'name' => 'role.index',
            'display_name' => 'List role',
        ],
        [
            'name' => 'role.create',
            'display_name' => 'Create role',
        ],
        [
            'name' => 'role.edit',
            'display_name' => 'Edit role',
        ],
        [
            'name' => 'role.delete',
            'display_name' => 'Delete role',
        ],
        [
            'name' => 'kitchen.index',
            'display_name' => 'List kitchen',
        ],
        [
            'name' => 'kitchen.create',
            'display_name' => 'Create kitchen',
        ],
        [
            'name' => 'kitchen.edit',
            'display_name' => 'Edit kitchen',
        ],
        [
            'name' => 'kitchen.delete',
            'display_name' => 'Delete kitchen',
        ],
        [
            'name' => 'building.index',
            'display_name' => 'List building',
        ],
        [
            'name' => 'building.create',
            'display_name' => 'Create building',
        ],
        [
            'name' => 'building.edit',
            'display_name' => 'Edit building',
        ],
        [
            'name' => 'building.delete',
            'display_name' => 'Delete building',
        ],
        [
            'name' => 'item.index',
            'display_name' => 'List item',
        ],
        [
            'name' => 'item.create',
            'display_name' => 'Create item',
        ],
        [
            'name' => 'item.edit',
            'display_name' => 'Edit item',
        ],
        [
            'name' => 'item.delete',
            'display_name' => 'Delete item',
        ],
        [
            'name' => 'contact.index',
            'display_name' => 'List contact',
        ],
        [
            'name' => 'contact.create',
            'display_name' => 'Create contact',
        ],
        [
            'name' => 'contact.edit',
            'display_name' => 'Edit contact',
        ],
        [
            'name' => 'contact.delete',
            'display_name' => 'Delete contact',
        ],
        [
            'name' => 'user.index',
            'display_name' => 'List user',
        ],
        [
            'name' => 'user.create',
            'display_name' => 'Create user',
        ],
        [
            'name' => 'user.edit',
            'display_name' => 'Edit user',
        ],
        [
            'name' => 'user.delete',
            'display_name' => 'Delete user',
        ],
        [
            'name' => 'stage.index',
            'display_name' => 'List stage',
        ],
        [
            'name' => 'stage.create',
            'display_name' => 'Create stage',
        ],
        [
            'name' => 'stage.edit',
            'display_name' => 'Edit stage',
        ],
        [
            'name' => 'stage.delete',
            'display_name' => 'Delete stage',
        ],
        [
            'name' => 'stage.cooked',
            'display_name' => 'Cooked stage',
        ],
        [
            'name' => 'stage.packaging',
            'display_name' => 'Packaging stage',
        ],
        [
            'name' => 'stage.delivery',
            'display_name' => 'Delivery stage',
        ],
        [
            'name' => 'stage.handed',
            'display_name' => 'Handed stage',
        ],
        [
            'name' => 'stage.rating',
            'display_name' => 'Rating stage',
        ],
    ],

    'deliveredByAble' => \App\Models\Contact::class,
    'handedToAble' => \App\Models\Contact::class,
];
