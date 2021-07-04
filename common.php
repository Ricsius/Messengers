<?php
    session_start();

    $usersFile = 'data/users.json';
    $tasksFile = 'data/tasks.json';
    $savesFile = 'data/saves.json';
    $completionsFile = 'data/completions.json';
    $users = json_decode(file_get_contents($usersFile), true);
    $tasks = json_decode(file_get_contents($tasksFile), true);
    $saves = json_decode(file_get_contents($savesFile), true);
    $completions = json_decode(file_get_contents($completionsFile), true);
?>