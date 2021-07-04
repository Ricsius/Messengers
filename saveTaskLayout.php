<?php
    require 'common.php';

    $save = json_decode(file_get_contents("php://input"));
    $save->id = count($saves);
    $save->userId = $_SESSION['loggedInUserId'];
    $save->date = date("Y/m/d H:i");
    
    $saves[] = $save;

    $saveString = json_encode($saves);

    file_put_contents($savesFile, $saveString);
?>