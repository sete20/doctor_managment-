<?php

return [
    'permission'    => [
        'validation'    => [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف الصلاحية',
            ],
            'display_name'  => [
                'required'  => 'من فضلك ادخل اسم الصلاحية',
            ],
            'name'          => [
                'required'  => 'من فضلك ادخل رمز الصلاحية',
                'unique'    => 'هذا الرمز تم ادخالة من قبل',
            ],
        ],
    ],
    'permissions'   => [
        'create'    => [
            'form'  => [
                'description'   => 'الوصف',
                'general'       => 'بيانات عامة',
                'info'          => 'البيانات',
                'key'           => 'الرمز',
                'name'          => 'الاسم',
            ],
            'title' => 'انشاء صلاحيات',
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'description'   => 'الوصف',
            'name'          => 'الرمز',
            'options'       => 'الخيارات',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'add'           => 'اضافة',
            'create'        => 'اضافة',
            'delete'        => 'حذف',
            'description'   => 'الوصف',
            'edit'          => 'تعديل',
            'key'           => 'الرمز',
            'name'          => 'الاسم',
            'show'          => 'عرض',
            'tabs'          => [
                'general'   => 'بيانات عامة',
            ],
        ],
        'index'     => [
            'title' => 'الصلاحيات',
        ],
        'routes'    => [
            'create'    => 'انشاء صلاحيات',
            'index'     => 'الصلاحيات',
            'update'    => 'تعديل الصلاحية',
        ],
        'update'    => [
            'form'  => [
                'description'   => 'الوصف',
                'general'       => 'بيانات عامة',
                'key'           => 'الرمز',
                'name'          => 'اسم الصلاحية',
            ],
            'title' => 'تعديل الصلاحية',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف الصلاحية',
            ],
            'display_name'  => [
                'required'  => 'من فضلك ادخل اسم الصلاحية',
            ],
            'name'          => [
                'required'  => 'من فضلك ادخل رمز الصلاحية',
                'unique'    => 'هذا الرمز تم ادخالة من قبل',
            ],
        ],
    ],
    'roles'         => [
        'create'    => [
            'form'  => [
                'description'   => 'الوصف',
                'general'       => 'بيانات عامة',
                'info'          => 'البيانات',
                'key'           => 'الرمز',
                'name'          => 'الاسم',
                'permissions'   => 'الصلاحيات',
            ],
            'title' => 'اضافة الادوار',
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'description'   => 'الوصف',
            'name'          => 'الرمز',
            'options'       => 'الخيارات',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'description'   => 'الوصف',
            'key'           => 'الرمز',
            'name'          => 'الاسم',
            'permissions'   => 'الصلاحيات',
            'tabs'          => [
                'general'   => 'بيانات عامة',
            ],
        ],
        'index'     => [
            'title' => 'الادوار',
        ],
        'routes'    => [
            'create'    => 'انشاء الادوار',
            'index'     => 'الالادوار',
            'update'    => 'تعديل الدور',
        ],
        'update'    => [
            'form'  => [
                'description'   => 'الوصف',
                'general'       => 'بيانات عامة',
                'key'           => 'الرمز',
                'name'          => 'اسم الصلاحية',
                'permissions'   => 'صلاحيات',
            ],
            'title' => 'تعديل الادوار',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف الدور',
            ],
            'display_name'  => [
                'required'  => 'من فضلك ادخل اسم الدور',
            ],
            'name'          => [
                'required'  => 'من فضلك ادخل رمز الدور',
                'unique'    => 'هذا الرمز تم ادخالة من قبل',
            ],
        ],
    ],
];
