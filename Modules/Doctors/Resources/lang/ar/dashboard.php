<?php
return [
    'doctors' => [
        'routes' => [
            'update' => 'تعديل بطوله',
            'create' => 'إضافة بطوله',
            'index' => 'الدكاتره الجامعيين',
        ],
        'tabs' => [
            'general' => 'البيانات العامه'
        ],
        'form' => [
            'tabs' => [
                'general' => 'البيانات العامه'
            ],
            'name' => 'الإسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المورو',
            'status' => 'الحالة',
            'image' => 'الصورة',
        ],
        'datatable' => [
            'name' => 'الإسم',
            'image' => 'الصوه',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإضافة',
            'options' => 'الخيارات',
        ],
        'validation'=> [
            'name'         => [
                'required'  => 'من فضلك ادخل الإسم',
                'unique'    => 'هذا الإسم تم ادخالة من قبل',
            ],
        ],
    ],
];