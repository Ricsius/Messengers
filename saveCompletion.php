<?php
    require 'common.php';

    $userId = $_SESSION['loggedInUserId'];
    $taskId = $_GET['id'];
    $i = 0;

    while($i < count($completions) && $completions[$i]['userId'] != $userId && $completions[$i]['taskId'] != $taskId) {
        ++$i;
    }

    if($i < count($completions)) {
        exit;
    }

    $completion = [];
    $completion['id'] = count($completions);
    $completion['userId'] = $userId;
    $completion['taskId'] = $taskId;

    $completions[] = $completion;

    $completionsString = json_encode($completions);

    file_put_contents($completionsFile, $completionsString);
?>