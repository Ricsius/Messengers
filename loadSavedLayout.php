<?php
    require 'common.php';

    $id = $_GET['id'];
    $i = 0;
        
    while($saves[$i]['id'] != $id) {
         ++$i;
    }

    print json_encode($saves[$i]);
?>