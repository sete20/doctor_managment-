<?php
return [
    'doctors' => [
        'routes' => [
            'update' => 'Update',
            'create' => 'Create',
            'index' => 'Doctors',
        ],
        'tabs' => [
            'general' => 'General Information'
        ],
        'form' => [
            'tabs' => [
                'general' => 'General Information'
            ],
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'image' => 'Image',
        ],
        'datatable' => [
            'name' => 'Name',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created at',
            'options' => 'Options',
        ],
        'validation' => [
            'name'         => [
                'required'  => 'Please enter the name',
                'unique'  => 'name already exists',
            ],
        ],
    ],
];