<?php
return [
    'requests' => [
        'messages' => [
            'you_are_already_booked_this_course' => 'You are already booked this course',
            'course_requested_successfully' => 'Course requested successfully',
            'you_must_book_the_course_first' => 'You must book the course first',
            'your_request_done_wait_for_admin_response' => 'your request stile pending wait for admin response',
            'chapter_not_found' => 'Chapter not found',
            'course_not_found' => 'Course not found',
            'lesson_not_found' => 'Lesson not found',
            'quiz_not_found' => 'Quiz not found',
            'answers_not_enough' => 'Answers not enough',
            'wrong_answer' => 'Wrong answer',
            'question_not_found' => 'Question not found',
            'quiz_already_answered' => 'Quiz already answered',
        ],
    ],
    'validations' => [
        'create' => [
            'tournament_not_found' => 'tournament not found',
            'team_already_exists_in_tournament' => 'team already exists in tournament',
            'player_already_exists_in_tournament' => 'player already exists in tournament',
        ],
        'course_id' => [
            'required' => 'Please select course',
        ],
        'chapter_id' => [
            'required' => 'Please select Chapter',
        ],
        'quiz_id' => [
            'required' => 'Please select Quiz',
        ],
    ],

];