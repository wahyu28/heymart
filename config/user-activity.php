<?php

return [
    'activated'        => true, // active/inactive all logging
    'middleware'       => ['web', 'auth', 'validasiloguser'],
    'route_path'       => '/log-activity',
    'admin_panel_path' => 'home',
    'delete_limit'     => 30, // default 7 days

    'model' => [
        'user' => "App\Models\User",
        // 'supplier' => "App\Models\Supplier"
    ],

    'log_events' => [
        'on_create'     => false,
        'on_edit'       => true,
        'on_delete'     => true,
        'on_login'      => true,
        'on_lockout'    => true
    ]
];
