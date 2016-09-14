<?php
$min = [0, 'logout'];
return [
    'default' => 0,     // default page
    'levels' => [0, 'BEG', 'INT', 'ADV'],
    'pages'  => [0 => 'sorry', 'logout' => 'logout', 'login' => 'auth',
                 1 => 'page1', 2 => 'page2', 3 => 'page3',
                 4 => 'page4', 5 => 'page5', 6 => 'page6',
                 7 => 'page7', 8 => 'page8', 9 => 'page9'],
    'allowed' => [
        // status => ['inherits' => xxx, 'pages' => [level => [pages allowed],level => [pages allowed]]]
        0 => ['inherits' => FALSE,
              'pages' => [
                '*' => $min,
                'BEG' => $min,
                'INT' => $min,
                'ADV' => $min]
        ],
        1 => ['inherits' => FALSE,
              'pages' => [
                  '*' => ['logout'],
                  'BEG' => [1, 'logout'],
                  'INT' => [1,2, 'logout'],
                  'ADV' => [1,2,3, 'logout']]
        ],
        2 => ['inherits' => 1,
              'pages' => [
                'BEG' => [4],
                'INT' => [4,5],
                'ADV' => [4,5,6]],
        ],
        3 => ['inherits' => 2,
              'pages' => [
                'BEG' => [7],
                'INT' => [7,8],
                'ADV' => [7,8,9]],
        ]
    ]
];
