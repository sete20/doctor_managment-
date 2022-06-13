<?php

return [
    'logs' => [
        'routes'    => [
            'index'     => 'سجل العمليات',
        ],
        'datatable' => [
            'title' => 'العنوان',
            'action' => 'الإجراء',
            'model' => 'نوع الإجراء',
            'user' => 'متخذ الإجراء',
            'created_at' => 'تاريخ إتخاذ الإجراء',
            'options' => 'الخيارات',
            'id' => 'الرقم',
            'name' => 'الإسم',
        ],
        'activities' => [
            'actions' => [
                'created' => ' إضافة ',
                'updated' => ' تعديل ',
                'deleted' => ' حذف ',
            ],
            'helper_words' => [
                'unknown_user' => ' غير معروف ',
                'head_title' => ' قام ',
                'the' => ' ',
                'with_id' => ' برقم #',
            ]
        ],
    ],
];
