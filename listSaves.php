<?php
    require 'common.php';

    $userId = $_SESSION['loggedInUserId'];
    $taskId = $_GET['id'];
    
    print json_encode(createSavesList($userId, $taskId));

    function createSavesList($userId, $taskId){
        $savesFile = 'data/saves.json';
        $saves = json_decode(file_get_contents($savesFile), true);

        $ret = [];
        
        for($i = 0; $i < count($saves); ++$i) {
            if($saves[$i]['taskId'] == $taskId && $saves[$i]['userId'] == $userId) {
                $obj = new stdClass();
                $obj->id = $saves[$i]['id'];
                $obj->date = $saves[$i]['date'];
                $ret[] = $obj;
            }
        }


        return $ret;
    }
?>