<?php

return [

    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],

    'table_names' => [
        'roles' => 'roles',
        'model_has_roles' => 'model_has_roles',
    ],

    'column_names' => [
        'role_pivot_key' => null, // Puede permanecer como null
        'permission_pivot_key' => null, // Puede permanecer como null
        'model_morph_key' => 'model_id', // Clave del modelo
        'team_foreign_key' => '', // Mantén esto como '' o quítalo
    ],

    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'teams' => false, // Desactiva equipos
    'use_passport_client_credentials' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,

    'cache' => [
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),
        'key' => 'spatie.permission.cache',
        'store' => 'default',
    ],
];
