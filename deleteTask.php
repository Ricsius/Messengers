<?php
    require 'common.php';

    $id = $_GET['id'];
    $list = [];

    for($i = 0; $i < count($tasks); ++$i) {
        if($tasks[$i]['id'] != $id) {
            $list[] = $tasks[$i];
        }
    }

    $string = json_encode($list);
    
    file_put_contents($tasksFile, $string);

    header('Location: taskList.php')
?>