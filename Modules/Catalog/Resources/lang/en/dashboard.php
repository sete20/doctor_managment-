<?php

return [
    'nationalities' => [
        'form'  => [
            'description'       => 'Description',
            'restore'           => 'Restore from trash',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'Status',
            'title'             => 'Title',
            'type'              => 'In footer',
            'tabs'  => [
                'general'           => 'General Info.',
                'seo'               => 'SEO',
            ]
        ],
        'datatable' => [
            'created_at'    => 'Created At',
            'date_range'    => 'Search By Dates',
            'options'       => 'Options',
            'status'        => 'Status',
            'title'         => 'Title',
        ],
        'routes'     => [
            'create' => 'Create nationalities',
            'index' => 'nationalities',
            'update' => 'Update nationality',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'Please enter the description of nationality',
            ],
            'title'         => [
                'required'  => 'Please enter the title of nationality',
                'unique'    => 'This title nationality is taken before',
            ],
        ],
    ],
    'work_times' => [
        'all_week_days' => 'All week days',
        'availabilities' => [
            'days' => [
                'sat' => 'Saturday',
                'sun' => 'Sunday',
                'mon' => 'Monday',
                'tue' => 'Tuesday',
                'wed' => 'Wednesday',
                'thu' => 'Thursday',
                'fri' => 'Friday',
            ],
        ],
        'days' => [
            'sat' => 'Saturday',
            'sun' => 'Sunday',
            'mon' => 'Monday',
            'tue' => 'Tuesday',
            'wed' => 'Wednesday',
            'thu' => 'Thursday',
            'fri' => 'Friday',
        ],
        'form' => [
            'time_from' => 'Time From',
            'time_to' => 'Time To',
            'time' => 'Time',
            'day' => 'Day',
            'for_day' => 'For Day',
            'time_status' => 'Time Status',
            'full_time' => 'Open 24 Hour',
            'custom_time' => 'Custom Time',
            'max_orders' => 'max orders count',
        ],
        'btn' => [
            'btn_add_more' => 'Add More',
        ],
        'validations' => [
            'at_least_one_element' => 'At Least One Element Is Required !!',
            'greater_than' => 'is greater than',
            'contain_duplicated_values' => 'Contains duplicate times',
            'days_status' => [
                'min' => 'At least one item must be selected',
                'required' => 'Ordering Days must be entered',
                'array' => 'An array of timings must be selected',
            ],
            'time' => [
                'required' => 'Time "from" must be greater than time "to"',
            ],
        ],
    ],
    'notifications' => [
        'form' => [
            'title' => 'Title',
            'body' => 'Body',
            'image' => 'Image',
            'clients' => 'Client',
        ],
        'routes' => [
            'send' => 'Send Notification',
        ],
        'validation' => [
            'title' => [
                'required' => 'Please Enter value'
            ],
            'clients' => [
                'required' => 'Please Select value',
                'exists' => 'Please Select a valid value',
            ],
        ],
    ],
];
