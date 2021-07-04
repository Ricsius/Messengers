<?php
    require 'common.php';

    $easyTask = [];
    $easyTask['id'] = 0;
    $easyTask['name'] = 'Easy demo task';
    $easyTask['difficulty'] = 1;
    $easyTask['layout'] = [
        [0, 0, 0, 2, 0],
        [0, 1, 0, 0, 0],
        [0, 0, 2, 0, 0],
        [3, 0, 0, 3, 0],
        [1, 0, 0, 0, 0]
    ];
    
    $mediumTask = [];
    $mediumTask['id'] = 1;
    $mediumTask['name'] = 'Medium demo task';
    $mediumTask['difficulty'] = 2;
    $mediumTask['layout'] = [
        [2 , 0 , 0 , 9 , 0 , 0 , 0 , 5 , 0],
        [1 , 0 , 0 , 8 , 0 , 11, 0 , 0 , 5],
        [0 , 2 , 0 , 0 , 6 , 0 , 7 , 0 , 0],
        [0 , 0 , 0 , 0 , 0 , 11, 0 , 10, 0],
        [0 , 0 , 0 , 7 , 0 , 0 , 0 , 0 , 0],
        [0 , 0 , 0 , 4 , 0 , 0 , 0 , 0 , 0],
        [0 , 0 , 0 , 0 , 0 , 0 , 0 , 3 , 6],
        [0 , 9 , 0 , 4 , 8 , 0 , 0 , 0 , 0],
        [0 , 1 , 0 , 0 , 0 , 0 , 0 , 10, 3]
    ];
    
    $hardTask = [];
    $hardTask['id'] = 2;
    $hardTask['name'] = 'Hard demo task';
    $hardTask['difficulty'] = 3;
    $hardTask['layout'] = [
        [1, 0, 0, 0, 3, 0, 5, 0, 2],
        [0, 0, 0, 0, 0, 0, 8, 5, 0],
        [7, 4, 0, 6, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 1, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 2],
        [0, 0, 4, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 7, 0, 0, 0, 0, 3, 0, 0],
        [0, 0, 0, 6, 0, 0, 0, 0, 8]
    ];

    $tasks = [];
    $tasks[] = $easyTask;
    $tasks[] = $mediumTask;
    $tasks[] = $hardTask;
    $tasksString = json_encode($tasks);
    file_put_contents($tasksFile, $tasksString);
?>