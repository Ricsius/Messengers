<?php
    require 'common.php';

    if(!isset($_POST['taskName']) || strlen($_POST['taskName']) == 0 ) {
        $_SESSION['taskUploadError'] .= 'No name was given.<br>';
    }

    if(!isset($_POST['taskDifficulty'])) {
        $_SESSION['taskUploadError'] .= 'No difficulty was given.<br>';
    }

    if(!isset($_POST['taskLayout']) || strlen($_POST['taskName']) == 0 ) {
        $_SESSION['taskUploadError'] .= 'No name was given.<br>';
    }

    print $_SESSION['taskUploadError'];

    if(strlen($_SESSION['taskUploadError']) > 0) {
        header('Location: newTask.php');
        exit;
    }

    $task = [];
    $task['id'] = count($tasks);
    $task['name'] = $_POST['taskName'];
    $task['difficulty'] = $_POST['taskDifficulty'];
    $task['layout'] = json_decode($_POST['taskLayout'], true);

    $tasks[] = $task;

    $tasksString = json_encode($tasks);
    file_put_contents($tasksFile, $tasksString);

    header('Location: taskList.php');
?>