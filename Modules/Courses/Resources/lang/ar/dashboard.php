<?php
return [
    'courses' => [
        'routes' => [
            'update' => 'تعديل كورس',
            'create' => 'إضافة كورس',
            'index' => 'الكورسات',
        ],
        'tabs' => [
            'general' => 'البيانات العامه'
        ],
        'form' => [
            'tabs' => [
                'general' => 'البيانات العامه'
            ],
            'title' => 'العنوان',
            'description' => 'الوصف',
            'note' => 'الملاحظات',
            'price' => 'السعر',
            'offer_price' => 'السعر بعد الخصم',
            'category' => 'القسم',
            'doctor' => 'الدكتور',
            'image' => 'الصورة',
            'is_offered' => 'حالة الخصم',
            'status' => 'الحالة',
            'restore' => 'إستعادة',
        ],
        'datatable' => [
            'image' => 'الصورة',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإضافة',
            'options' => 'الخيارات',
            'category' => 'القسم',
            'doctor' => 'الدكتور',
            'price' => 'السعر',
            'is_offered' => 'حالة الخصم',
        ],
    ],
    'clientcourses' => [
        'routes' => [
            'update' => 'تعديل كورس',
            'create' => 'إضافة كورس',
            'index' => 'طلبات الطلاب',
        ],
        'tabs' => [
            'general' => 'البيانات العامه'
        ],
        'form' => [
            'tabs' => [
                'general' => 'البيانات العامه'
            ],
            'price' => 'السعر',
            'offer_price' => 'السعر بعد الخصم',
            'category' => 'القسم',
            'client' => 'إسم الطالب',
            'is_offered' => 'حالة الخصم',
            'status' => 'الحالة',
            'restore' => 'إستعادة',
        ],
        'datatable' => [
            'course' => 'الكورس',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإضافة',
            'options' => 'الخيارات',
            'price' => 'السعر',
            'client' => 'إسم الطالب',
            'is_offered' => 'حالة الخصم',
            'offer_price' => 'السعر بعد الخصم',
        ],
    ],
    'chapters' => [
        'routes' => [
            'update' => 'تعديل فصل',
            'create' => 'إضافة فصل',
            'index' => 'الدروس',
        ],
        'tabs' => [
            'general' => 'البيانات العامه'
        ],
        'form' => [
            'tabs' => [
                'general' => 'البيانات العامه'
            ],
            'title' => 'العنوان',
            'order' => 'ترتيب الظهور',
            'course' => 'الكورس',
            'image' => 'الصورة',
            'status' => 'الحالة',
            'restore' => 'إستعادة',
        ],
        'datatable' => [
            'image' => 'الصورة',
            'title' => 'العنوان',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإضافة',
            'options' => 'الخيارات',
            'course' => 'الكورس',
        ],
    ],
    'contents' => [
        'routes' => [
            'update' => 'تعديل درس',
            'create' => 'إضافة درس',
            'index' => 'الدروس',
        ],
        'tabs' => [
            'general' => 'البيانات العامه'
        ],
        'btn' => [
            'add_card' => 'إضافة بطاقة',
            'add_quiz' => 'إضافة إختبار',
            'add_video' => 'إضافة فيديو',
        ],
        'form' => [
            'tabs' => [
                'general' => 'البيانات العامه'
            ],
            'title' => 'العنوان',
            'description' => 'التفاصيل',
            'chapter' => 'الفصل',
            'voice' => 'التسجيل',
            'order' => 'ترتيب الظهور',
            'course' => 'الكورس',
            'image' => 'الصورة',
            'status' => 'الحالة',
            'restore' => 'إستعادة',
            'type' => 'نوع الدرس',
        ],
        'datatable' => [
            'image' => 'الصورة',
            'title' => 'العنوان',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الإضافة',
            'options' => 'الخيارات',
            'course' => 'الكورس',
            'chapter_id' => 'الفصل',
            'type' => 'نوع الدرس',
        ],
        'cards' => [
            'routes' => [
                'update' => 'تعديل بطاقة',
                'create' => 'إضافة بطاقة',
                'index' => 'البطاقات',
            ],
            'tabs' => [
                'general' => 'البيانات العامه'
            ],
            'form' => [
                'tabs' => [
                    'general' => 'البيانات العامه'
                ],
                'title' => 'العنوان',
                'description' => 'التفاصيل',
                'chapter' => 'الدرس',
                'voice' => 'التسجيل',
                'order' => 'ترتيب الظهور',
                'course' => 'الكورس',
                'image' => 'الصورة',
                'status' => 'الحالة',
                'restore' => 'إستعادة',
            ],
            'datatable' => [
                'image' => 'الصورة',
                'title' => 'العنوان',
                'status' => 'الحالة',
                'created_at' => 'تاريخ الإضافة',
                'options' => 'الخيارات',
                'course' => 'الكورس',
            ],
            'validation' => [
                'description' => [
                    'required' => 'من فضلك ادخل الوصف ',
                ],
                'title' => [
                    'required' => 'من فضلك ادخل العنوان ',
                    'unique' => 'هذا العنوان تم ادخالة من قبل',
                ],
                'chapter_id' => [
                    'required' => 'من فضلك إختر الدرس',
                ],
            ],
        ],
        'quiz' => [
            'routes' => [
                'update' => 'تعديل إختبار',
                'create' => 'إضافة إختبار',
                'index' => 'الإختبارات',
            ],
            'tabs' => [
                'general' => 'البيانات العامه',
                'questions' => 'الأسئلة',
            ],
            'form' => [
                'tabs' => [
                    'general' => 'البيانات العامه',
                'questions' => 'الأسئلة',
                ],
                'title' => 'العنوان',
                'description' => 'التفاصيل',
                'chapter' => 'الدرس',
                'voice' => 'التسجيل',
                'order' => 'ترتيب الظهور',
                'course' => 'الكورس',
                'image' => 'الصورة',
                'status' => 'الحالة',
                'restore' => 'إستعادة',
                'add_other_question' => 'إضافة سؤال',
                'answer' => 'الإجابة',
                'is_true_answer' => 'إجابة صحيحة',
                'btn_add_more' => 'إضافة إجابة',
                'question' => 'السؤال',
            ],
            'datatable' => [
                'image' => 'الصورة',
                'title' => 'العنوان',
                'status' => 'الحالة',
                'created_at' => 'تاريخ الإضافة',
                'options' => 'الخيارات',
                'course' => 'الكورس',
            ],
            'validation' => [
                'description' => [
                    'required' => 'من فضلك ادخل الوصف ',
                ],
                'title' => [
                    'required' => 'من فضلك ادخل العنوان ',
                    'unique' => 'هذا العنوان تم ادخالة من قبل',
                ],
                'chapter_id' => [
                    'required' => 'من فضلك إختر الدرس',
                ],
            ],
        ],
        'videos' => [
            'routes' => [
                'update' => 'تعديل فيديو',
                'create' => 'إضافة فيديو',
                'index' => 'الفيديوهات',
            ],
            'tabs' => [
                'general' => 'البيانات العامه',
                'questions' => 'الفيديوهات',
            ],
            'form' => [
                'tabs' => [
                    'general' => 'البيانات العامه',
                ],
                'title' => 'العنوان',
                'description' => 'التفاصيل',
                'chapter' => 'الدرس',
                'voice' => 'التسجيل',
                'order' => 'ترتيب الظهور',
                'course' => 'الكورس',
                'image' => 'الصورة',
                'status' => 'الحالة',
                'restore' => 'إستعادة',
            ],
            'datatable' => [
                'image' => 'الصورة',
                'title' => 'العنوان',
                'status' => 'الحالة',
                'created_at' => 'تاريخ الإضافة',
                'options' => 'الخيارات',
                'course' => 'الكورس',
            ],
            'validation' => [
                'description' => [
                    'required' => 'من فضلك ادخل الوصف ',
                ],
                'title' => [
                    'required' => 'من فضلك ادخل العنوان ',
                    'unique' => 'هذا العنوان تم ادخالة من قبل',
                ],
                'chapter_id' => [
                    'required' => 'من فضلك إختر الدرس',
                ],
            ],
        ],
    ],
];