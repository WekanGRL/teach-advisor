<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, null, null, false, false, null]],
        '/api/lesson' => [[['_route' => 'api_lessonget_all_lessons', '_controller' => 'App\\Controller\\Api\\LessonController::list'], null, ['GET' => 0], null, true, false, null]],
        '/api/lesson/date/day' => [[['_route' => 'api_lessonget_date_day', '_controller' => 'App\\Controller\\Api\\LessonController::date'], null, ['POST' => 0], null, false, false, null]],
        '/api/lesson/date/week' => [[['_route' => 'api_lessonget_date_week', '_controller' => 'App\\Controller\\Api\\LessonController::date_week'], null, ['POST' => 0], null, false, false, null]],
        '/api/room' => [[['_route' => 'api_roomget_all_room', '_controller' => 'App\\Controller\\Api\\RoomController::list'], null, ['GET' => 0], null, true, false, null]],
        '/api/teacher' => [[['_route' => 'api_teacher_list', '_controller' => 'App\\Controller\\Api\\TeacherController::list'], null, ['GET' => 0], null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\LoginController::index'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\LoginController::logout'], null, ['GET' => 0], null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\ProfAdvisorController::redirection'], null, null, null, false, false, null]],
        '/schedule' => [[['_route' => 'calendar', '_controller' => 'App\\Controller\\ProfAdvisorController::index'], null, ['GET' => 0], null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\RegistrationController::register'], null, null, null, false, false, null]],
        '/teacher' => [[['_route' => 'teacher_list', '_controller' => 'App\\Controller\\TeacherController::list'], null, ['GET' => 0], null, false, false, null]],
        '/teacher/create' => [[['_route' => 'teacher_create', '_controller' => 'App\\Controller\\TeacherController::create'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/api/(?'
                    .'|review/([^/]++)(?'
                        .'|(*:195)'
                    .')'
                    .'|teacher/([^/]++)(?'
                        .'|(*:223)'
                        .'|/reviews(?'
                            .'|(*:242)'
                        .')'
                    .')'
                .')'
                .'|/teacher/([^/]++)/(?'
                    .'|update(*:280)'
                    .'|delete(*:294)'
                    .'|reviews(*:309)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        195 => [
            [['_route' => 'api_review_delete', '_controller' => 'App\\Controller\\Api\\ReviewController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_review_edit', '_controller' => 'App\\Controller\\Api\\ReviewController::edit'], ['id'], ['PATCH' => 0], null, false, true, null],
        ],
        223 => [[['_route' => 'api_teacher_findOne', '_controller' => 'App\\Controller\\Api\\TeacherController::findOne'], ['id'], ['GET' => 0], null, false, true, null]],
        242 => [
            [['_route' => 'api_teacher_findOnesReview', '_controller' => 'App\\Controller\\Api\\TeacherController::findOnesReview'], ['id'], ['GET' => 0], null, false, false, null],
            [['_route' => 'api_teacher_addReviews', '_controller' => 'App\\Controller\\Api\\TeacherController::addReviews'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null],
        ],
        280 => [[['_route' => 'teacher_update', '_controller' => 'App\\Controller\\TeacherController::update'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        294 => [[['_route' => 'teacher_delete', '_controller' => 'App\\Controller\\TeacherController::delete'], ['id'], ['GET' => 0], null, false, false, null]],
        309 => [
            [['_route' => 'teacher_dashboard', '_controller' => 'App\\Controller\\TeacherController::listReviews'], ['id'], ['GET' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
