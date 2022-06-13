<?php

return [
    'permission'    => [
        'validation'    => [
            'description'   => [
                'required'  => 'Please enter description permission',
            ],
            'display_name'  => [
                'required'  => 'Please enter display name permission',
            ],
            'name'          => [
                'required'  => 'Please enter name permission',
                'unique'    => 'This key name is taken before',
            ],
        ],
    ],
    'permissions'   => [
        'create'    => [
            'form'  => [
                'description'   => 'Description',
                'general'       => 'General Info.',
                'info'          => 'Info.',
                'key'           => 'Key',
                'name'          => 'Name',
            ],
            'title' => 'Create Permissions',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'description'   => 'Description',
            'name'          => 'Name',
            'options'       => 'Options',
            'title'         => 'Title',
        ],
        'form'      => [
            'add'           => 'Add',
            'create'        => 'Create',
            'delete'        => 'Delete',
            'description'   => 'Description',
            'edit'          => 'Edit',
            'key'           => 'Key',
            'name'          => 'Name',
            'show'          => 'Show',
            'tabs'          => [
                'general'   => 'General Info.',
            ],
        ],
        'index'     => [
            'title' => 'Permissions',
        ],
        'routes'    => [
            'create'    => 'Create Permissions',
            'index'     => 'Permissions',
            'update'    => 'Update Permission',
        ],
        'update'    => [
            'form'  => [
                'description'   => 'Description',
                'general'       => 'General info.',
                'key'           => 'Key',
                'name'          => 'Name',
            ],
            'title' => 'Update Permission',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'Please enter description permission',
            ],
            'display_name'  => [
                'required'  => 'Please enter display name permission',
            ],
            'name'          => [
                'required'  => 'Please enter name permission',
                'unique'    => 'This key name is taken before',
            ],
        ],
    ],
    'roles'         => [
        'create'    => [
            'form'  => [
                'description'   => 'Description',
                'general'       => 'General Info.',
                'info'          => 'Info.',
                'key'           => 'Key',
                'name'          => 'Name',
                'permissions'   => 'Permissions',
            ],
            'title' => 'Create Roles',
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'description'   => 'Description',
            'name'          => 'Name',
            'options'       => 'Options',
            'title'         => 'Title',
        ],
        'form'      => [
            'description'   => 'Description',
            'key'           => 'Key',
            'name'          => 'Name',
            'permissions'   => 'Permissions',
            'tabs'          => [
                'general'   => 'General Info.',
            ],
        ],
        'index'     => [
            'title' => 'Roles',
        ],
        'routes'    => [
            'create'    => 'Create Roles',
            'index'     => 'Roles',
            'update'    => 'Update Role',
        ],
        'update'    => [
            'form'  => [
                'description'   => 'Description',
                'general'       => 'General info.',
                'key'           => 'Key',
                'name'          => 'Name',
                'permissions'   => 'Permissions',
            ],
            'title' => 'Update Role',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'Please enter description role',
            ],
            'display_name'  => [
                'required'  => 'Please enter display name role',
            ],
            'name'          => [
                'required'  => 'Please enter key name role',
                'unique'    => 'This key name is taken before',
            ],
        ],
    ],
];
