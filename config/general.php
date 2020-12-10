<?php

return [  

    "ROLES" => ['TEACHER' => 'TEACHER','STUDENT' => 'STUDENT', 'ADMIN' => 'ADMIN'],    

    "STATUS" =>['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE'],

    "GENDER" => [ "MALE" => 'MALE', "FEMALE" => 'FEMALE'],

    'RESULT_TYPE' => ['MARKS' => 'MARKS', 'GRADES' => 'GRADES'],

    'MEDIUM' => ['SINHALA' => 'SINHALA', 'ENGLISH' => 'ENGLISH', 'TAMIL' => 'TAMIL'],

    "CLASSROOM_TYPES" => ['THEORY' => 'THEORY', 'PRACTICAL' => 'PRACTICAL'],

    "LESSON_TYPE" => [
        'VIDEO' => 'VIDEO',
        'QUIZ' => 'QUIZ', 
        'QUESTION'  => 'QUESTION',
        'ASSIGNMENT'  => 'ASSIGNMENT',
        'DOCUMENT' => 'DOCUMENT'
        ],

    "LIMIT"  => 10,

    'DATE_FORMAT_OUT' => 'd/m/Y',
    'DATE_FORMAT_IN' => 'd-m-Y',

    "PROFILE_UPLOAD_PATH" => '/profile/',
    "PROFILE_THUMB__UPLOAD_PATH" => '/profile/thumbnail/',
    "ASSIGNMENT_UPLOAD_PATH" => '/assignments/',
    "DOCUMENT_UPLOAD_PATH" => '/documents/',
    "QUESTION_UPLOAD_PATH" => '/questions/',
];