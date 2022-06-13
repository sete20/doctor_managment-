<?php

return [
    'logs' => [

        'routes'    => [
            'index'     => 'Logs',
        ],
        'datatable' => [
            'title' => 'Title',
            'action' => 'Action',
            'model' => 'Model',
            'user' => 'User',
            'created_at' => 'Created at',
            'options' => 'Options',
            'id' => 'ID',
            'name' => 'Name',
        ],
        'activities' => [
            'actions' => [
                'created' => ' create ',
                'updated' => ' update ',
                'deleted' => ' delete ',
            ],
            'helper_words' => [
                'unknown_user' => ' Unknown user ',
                'head_title' => ' ',
                'the' => ' the ',
                'with_id' => ' with ID  #',
            ]
        ],
    ],
];
