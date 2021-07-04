<?php
    session_start();
    
    unset($_SESSION['loggedInUserId']);
    header('Location: index.php');
?>