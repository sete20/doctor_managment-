<?php

return [

    'nationalities' => [
        'form'  => [
            'description'       => 'الوصف',
            'restore'           => 'استرجاع من الحذف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            'title'             => 'عنوان الجنسية',
            'type'              => 'في تذيل الجنسية',
            'tabs'  => [
                'general'   => 'بيانات عامة',
                'seo'               => 'SEO',
            ],
        ],
        'routes'    => [
            'create'  => 'اضافة الجنسيات',
            'index'   => 'الجنسيات',
            'update'  => 'تعديل الجنسية',
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف الجنسية',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل عنوان الجنسية',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'work_times' => [
        'all_week_days' => 'كل أيام الإسبوع',
        'availabilities' => [
            'days' => [
                'sat' => 'السبت',
                'sun' => 'الأحد',
                'mon' => 'الإثنين',
                'tue' => 'الثلاثاء',
                'wed' => 'الأربعاء',
                'thu' => 'الخميس',
                'fri' => 'الجمعه',
            ],
        ],
        'days' => [
            'sat' => 'السبت',
            'sun' => 'الأحد',
            'mon' => 'الإثنين',
            'tue' => 'الثلاثاء',
            'wed' => 'الأربعاء',
            'thu' => 'الخميس',
            'fri' => 'الجمعة',
        ],
        'form' => [
            'time_from' => 'الوقت من',
            'time_to' => 'الوقت الى',
            'time' => 'الوقت',
            'day' => 'اليوم',
            'for_day' => 'ليوم',
            'time_status' => 'حالة الوقت',
            'full_time' => 'عمل 24 ساعة',
            'custom_time' => 'تحديد الوقت',
            'max_orders' => 'أقصي عدد للطلبات',
        ],
        'btn' => [
            'btn_add_more' => 'اضافة المزيد',
        ],
        'validations' => [
            'at_least_one_element' => 'مطلوب عنصر واحد على الأقل !!',
            'greater_than' => 'اكبر من',
            'contain_duplicated_values' => 'يحتوى على توقيتات مكررة',
            'days_status' => [
                'min' => 'يجب اختيار عنصر واحد على الاقل',
                'required' => 'يجب ادخال أوقات طلب المنتج',
                'array' => 'يجب اختيار اكثر من توقيت',
            ],
            'time' => [
                'required' => 'الوقت "من" يجب ان يكون اكبر من الوقت "الى"',
            ],
        ],
    ],
    'notifications' => [
        'form' => [
            'title' => 'العنوان',
            'body' => 'المحتوي',
            'image' => 'صورة',
            'clients' => 'المستخدمين',
        ],
        'routes' => [
            'send' => 'إرسال إشعارات',
        ],
        'validation' => [
            'title' => [
                'required' => 'برجاء إدخال قيمة'
            ],
            'clients' => [
                'required' => 'برجاء إختيار قيمة',
                'exists' => 'برجاء إختيار قيمة صحيحة',
            ],
        ],
    ],
];
