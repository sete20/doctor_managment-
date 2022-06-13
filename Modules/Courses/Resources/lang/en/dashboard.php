<?php
return [
    'courses' => [
        'routes' => [
            'update' => 'Update',
            'create' => 'Create',
            'index' => 'Courses',
        ],
        'tabs' => [
            'general' => 'General Information'
        ],
        'form' => [
            'tabs' => [
                'general' => 'General Information'
            ],
            'title' => 'Title',
            'description' => 'Description',
            'note' => 'note',
            'price' => 'price',
            'offer_price' => 'offer_price',
            'category' => 'category',
            'doctor' => 'doctor',
            'image' => 'image',
            'is_offered' => 'Is offered',
            'status' => 'Status',
            'restore' => 'Restore',
        ],
        'datatable' => [
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created at',
            'options' => 'Options',
            'category' => 'Category',
            'doctor' => 'Doctor',
            'price' => 'Price',
            'is_offered' => 'Is offered',
        ],
    ],
    'clientcourses' => [
        'routes' => [
            'update' => 'Update',
            'create' => 'Create',
            'index' => 'Client Courses',
        ],
        'tabs' => [
            'general' => 'General Information'
        ],
        'form' => [
            'tabs' => [
                'general' => 'General Information'
            ],
            'title' => 'Title',
            'description' => 'Description',
            'note' => 'note',
            'price' => 'price',
            'offer_price' => 'offer_price',
            'category' => 'category',
            'doctor' => 'doctor',
            'image' => 'image',
            'is_offered' => 'Is offered',
            'status' => 'Status',
            'restore' => 'Restore',
        ],
        'datatable' => [
            'course' => 'Course',
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created at',
            'options' => 'Options',
            'category' => 'Category',
            'client' => 'Student',
            'price' => 'Price',
            'offer_price' => 'Offer Price',
            'is_offered' => 'Is offered',
        ],
    ],
    'chapters' => [
        'routes' => [
            'update' => 'Update',
            'create' => 'Create',
            'index' => 'Chapters',
        ],
        'tabs' => [
            'general' => 'General Information'
        ],
        'form' => [
            'tabs' => [
                'general' => 'General Information'
            ],
            'title' => 'Title',
            'order' => 'Order',
            'course' => 'Course',
            'image' => 'image',
            'status' => 'Status',
            'restore' => 'Restore',
        ],
        'datatable' => [
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created at',
            'options' => 'Options',
            'category' => 'Category',
            'course' => 'course',
            'price' => 'Price',
            'is_offered' => 'Is offered',
        ],
    ],
    'contents' => [
        'routes' => [
            'update' => 'Update',
            'create' => 'Create',
            'index' => 'Lessons',
        ],
        'tabs' => [
            'general' => 'General Information',
        ],
        'form' => [
            'tabs' => [
                'general' => 'General Information',
            ],
            'title' => 'title',
            'description' => 'description',
            'chapter' => 'chapter',
            'voice' => 'voice',
            'status' => 'status',
            'restore' => 'restore',
            'order' => 'Order',
            'course' => 'Course',
            'add_other_question' => 'Add other Question',
            'answer' => 'Answer',
            'is_true_answer' => 'True Answer',
            'btn_add_more' => 'Add Answer',
        ],
        'datatable' => [
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created at',
            'options' => 'Options',
            'chapter_id' => 'Chapter',
            'course' => 'course',
            'price' => 'Price',
            'is_offered' => 'Is offered',
        ],
        'cards' => [
            'routes' => [
                'update' => 'Update',
                'create' => 'Create',
                'index' => 'Cards',
            ],
            'tabs' => [
                'general' => 'General Information'
            ],
            'form' => [
                'tabs' => [
                    'general' => 'General Information'
                ],
                'title' => 'title',
                'description' => 'description',
                'chapter' => 'chapter',
                'voice' => 'voice',
                'status' => 'status',
                'restore' => 'restore',
                'order' => 'Order',
                'course' => 'Course',
                'image' => 'image',
            ],
            'datatable' => [
                'image' => 'Image',
                'title' => 'Title',
                'description' => 'Description',
                'status' => 'Status',
                'created_at' => 'Created at',
                'options' => 'Options',
                'category' => 'Category',
                'course' => 'course',
                'price' => 'Price',
                'is_offered' => 'Is offered',
            ],
            'validation' => [
                'description' => [
                    'required' => 'Please enter the description',
                ],
                'title' => [
                    'required' => 'Please enter the title',
                    'unique' => 'This title is taken before',
                ],
                'chapter_id' => [
                    'required' => 'Please Chose the chapter',
                ],
            ],
        ],
        'quiz' => [
            'routes' => [
                'update' => 'Update',
                'create' => 'Create',
                'index' => 'Quiz',
            ],
            'tabs' => [
                'general' => 'General Information',
                'questions' => 'Questions',
            ],
            'form' => [
                'tabs' => [
                    'general' => 'General Information',
                'questions' => 'Questions',
                ],
                'title' => 'title',
                'description' => 'description',
                'chapter' => 'chapter',
                'voice' => 'voice',
                'status' => 'status',
                'restore' => 'restore',
                'order' => 'Order',
                'course' => 'Course',
                'add_other_question' => 'Add other Question',
                'answer' => 'Answer',
                'is_true_answer' => 'True Answer',
                'btn_add_more' => 'Add Answer',
            ],
            'datatable' => [
                'image' => 'Image',
                'title' => 'Title',
                'description' => 'Description',
                'status' => 'Status',
                'created_at' => 'Created at',
                'options' => 'Options',
                'category' => 'Category',
                'course' => 'course',
                'price' => 'Price',
                'is_offered' => 'Is offered',
            ],
            'validation' => [
                'description' => [
                    'required' => 'Please enter the description',
                ],
                'title' => [
                    'required' => 'Please enter the title',
                    'unique' => 'This title is taken before',
                ],
                'chapter_id' => [
                    'required' => 'Please Chose the chapter',
                ],
            ],
        ],
    ],
];