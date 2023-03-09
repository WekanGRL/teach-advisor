<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, null, null, false, false, null]],
        '/api/lesson' => [[['_route' => 'api_lessonget_all_lessons', '_controller' => 'App\\Controller\\Api\\LessonController::list'], null, ['GET' => 0], null, true, false, null]],
        '/api/lesson/date' => [[['_route' => 'api_lessonget_date', '_controller' => 'App\\Controller\\Api\\LessonController::date_week'], null, ['POST' => 0], null, false, false, null]],
        '/api/room' => [[['_route' => 'api_roomget_all_room', '_controller' => 'App\\Controller\\Api\\RoomController::list'], null, ['GET' => 0], null, true, false, null]],
        '/api/teacher' => [[['_route' => 'api_teacher_list', '_controller' => 'App\\Controller\\Api\\TeacherController::list'], null, ['GET' => 0], null, false, false, null]],
        '/teacher' => [[['_route' => 'teacher_list', '_controller' => 'App\\Controller\\TeacherController::list'], null, ['GET' => 0], null, false, false, null]],
        '/teacher/create' => [[['_route' => 'teacher_create', '_controller' => 'App\\Controller\\TeacherController::create'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/teacher/calendar/day' => [[['_route' => 'teacher_show_calendar', '_controller' => 'App\\Controller\\TeacherController::showCalendar'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|review/([^/]++)(?'
                        .'|(*:68)'
                    .')'
                    .'|teacher/([^/]++)(?'
                        .'|(*:95)'
                        .'|/reviews(?'
                            .'|(*:113)'
                        .')'
                    .')'
                .')'
                .'|/teacher/([^/]++)/(?'
                    .'|update(*:151)'
                    .'|delete(*:165)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        68 => [
            [['_route' => 'api_review_delete', '_controller' => 'App\\Controller\\Api\\ReviewController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_review_edit', '_controller' => 'App\\Controller\\Api\\ReviewController::edit'], ['id'], ['PATCH' => 0], null, false, true, null],
        ],
        95 => [[['_route' => 'api_teacher_findOne', '_controller' => 'App\\Controller\\Api\\TeacherController::findOne'], ['id'], ['GET' => 0], null, false, true, null]],
        113 => [
            [['_route' => 'api_teacher_findOnesReview', '_controller' => 'App\\Controller\\Api\\TeacherController::findOnesReview'], ['id'], ['GET' => 0], null, false, false, null],
            [['_route' => 'api_teacher_addReviews', '_controller' => 'App\\Controller\\Api\\TeacherController::addReviews'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null],
        ],
        151 => [[['_route' => 'teacher_update', '_controller' => 'App\\Controller\\TeacherController::update'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        165 => [
            [['_route' => 'teacher_delete', '_controller' => 'App\\Controller\\TeacherController::delete'], ['id'], ['GET' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
