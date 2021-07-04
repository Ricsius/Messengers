<?php
   require 'common.php';

   $user = [];
   $user['emailAddress'] = $_POST['emailAddress'];
   $user['password'] = $_POST['password'];

   $i = 0;

   while($i < count($users) && 
   $users[$i]['emailAddress'] != $_POST['emailAddress'] && 
   $users[$i]['password'] != $_POST['password']) {
      ++$i;
   }

   if($i < count($users)){
      $_SESSION['loggedInUserId'] = $users[$i]['id'];
      header('Location: taskList.php');
   }
   else{
      $_SESSION['loginError'] = 'Either the email address or the password is incorrect.';
      header('Location: index.php');
   }
?>
