<?php
    require 'common.php';

    $i = 0;
        
    while($tasks[$i]['id'] != $_GET['id']) {
        ++$i;
    }

    $task = $tasks[$i];

    $layoutJSON = json_encode($task['layout']);
    print $layoutJSON;
?>