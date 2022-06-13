<?php

return [
    'requests' => [
        'messages' => [
            'you_are_already_booked_this_course' => 'لقد قمت بحجز هذا الكورس بالفعل',
            'course_requested_successfully' => 'تم حجز الكورس بنجاح',
            'you_must_book_the_course_first' => 'يجب عليك حجز الكورس أولا',
            'your_request_done_wait_for_admin_response' => 'مازال طلبك قيد الانتظار برجاء انتظار موافقة الإدارة',
            'chapter_not_found' => 'لم تم العثور علي الدرس',
            'course_not_found' => 'لم تم العثور علي الكورس',
            'lesson_not_found' => 'لم تم العثور علي الدرس',
            'quiz_not_found' => 'لم تم العثور علي الإختبار',
            'answers_not_enough' => 'الإجابات غير كافية',
            'wrong_answer' => 'الإجابه غير صحيحه',
            'question_not_found' => 'اجابة السؤال غير موجوده',
            'quiz_already_answered' => 'تم إجابة الإختبار سابقا',
        ],
    ],
    'validations' => [
        'create' => [
            'tournament_not_found' => 'لم يتم العثور علي البطوله',
            'team_already_exists_in_tournament' => 'الفريق مجود بالفعل في البطوله',
            'player_already_exists_in_tournament' => 'تم تسجيل الاعب من قبل في احد فرق البطوله',
        ],
        'course_id' => [
            'required' => 'course id مطلوب',
        ],
        'chapter_id' => [
            'required' => 'chapter id مطلوب',
        ],
        'quiz_id' => [
            'required' => 'quiz id مطلوب',
        ],
    ],
];